
<!DOCTYPE html>
<html lang="en">
    <head>


    </head>

    <body>
    <?php

        $query = "
        (SELECT id, 'address' AS source FROM Adresses)
        UNION ALL
        (SELECT id, 'listing_type' AS source FROM Listing_Types)
        UNION ALL
        (SELECT id, 'user' AS source FROM Users);
        ";

        $result = mysqli_query($conn, $query);

        $address_ids = [];
        $listing_type_ids = [];
        $user_ids = [];

        while ($row = $result->fetch_assoc()) {
            switch ($row['source']) {
                case 'address':
                    $address_ids[] = $row['id'];
                    break;
                case 'listing_type':
                    $listing_type_ids[] = $row['id'];
                    break;
                case 'user':
                    $user_ids[] = $row['id'];
                    break;
            }
        }


        $listing_id = mysqli_real_escape_string($conn, $id);

        $query = "
            SELECT description, room_count, area, price, user_id, adress_id, listing_type_id, listing_date
            FROM Listings
            WHERE id='$listing_id';
        ";



        $result = mysqli_query($conn, $query);

        $listing = mysqli_fetch_assoc($result);

        $old_description = $listing["description"];
        $old_room_count = $listing["room_count"];
        $old_area = $listing["area"];
        $old_price = $listing["price"];
        $old_user = $listing["user_id"];
        $old_type = $listing["listing_type_id"];
        $old_adress = $listing["adress_id"];
        $old_date = $listing["listing_date"];

        

        echo $old_description;


        $message = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $description = $_POST['description'] ?? '';
            $room_count = $_POST['room_count'] ?? '';
            $area = $_POST['area'] ?? '';
            $price = $_POST['price'] ?? '';
            $listing_date = $_POST['listing_date'] ?? '';
            $user_id = $_POST['user_id'] ?? '';
            $address_id = $_POST['address_id'] ?? '';
            $listing_type_id = $_POST['listing_type_id'] ?? '';
        
            if ($description && $room_count && $area && $price && $listing_date && $user_id && $address_id && $listing_type_id) {
                $user_id = mysqli_real_escape_string($conn, $user_id);
                $address_id = mysqli_real_escape_string($conn, $address_id);
                $listing_type_id = mysqli_real_escape_string($conn, $listing_type_id);

                $check_query = "SELECT id FROM Adresses WHERE id = ?";
                $check_stmt = $conn->prepare($check_query);
                $check_stmt->bind_param("s", $address_id);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
                
                if ($check_result->num_rows == 0) {
                    die("Помилка: Адреса з ID $address_id не існує в базі даних!");
                }

                $stmt = $conn->prepare("UPDATE Listings 
                SET description = ?, room_count = ?, area = ?, price = ?, listing_date = ?, user_id = ?, adress_id = ?, listing_type_id = ? 
                WHERE id = ?");
            
                $stmt->bind_param("siddsssss", $description, $room_count, $area, $price, $listing_date, $user_id, $address_id, $listing_type_id, $listing_id);
            
                if ($stmt->execute()) {
                   echo "<script>alert('Row was updated successfully')</script>";     
                } else {
                   echo "<script>alert('Something went wrong')</script>";     

                }

                $stmt->close();
                echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "?action=edit&id=$id';</script>";      

            } else {
                $message = "<p class='error-message'>Будь ласка, заповніть всі поля!</p>";
            }
        }

    ?>
        <h2>Додати оголошення</h2>
        <?php echo $message; ?>
        <form method="POST" class="form">
            <div class="form-group">
                <label for="description">Опис</label>
                <input type="text" name="description" id="description" placeholder="Введіть опис" value="<?= $old_description?>" required>
            </div>
            <div class="form-group">
                <label for="room_count">Кількість кімнат</label>
                <input type="number" name="room_count" id="room_count" min="1" placeholder="Введіть кількість кімнат" value="<?= $old_room_count?>" required>
            </div>
            <div class="form-group">
                <label for="area">Площа (м²)</label>
                <input type="number" step="0.01" name="area" id="area" placeholder="Введіть площу" value="<?= $old_area?>" required>
            </div>
            <div class="form-group">
                <label for="price">Ціна ($)</label>
                <input type="number" step="0.01" name="price" id="price" placeholder="Введіть ціну" value="<?= $old_price?>" required>
            </div>
            <div class="form-group">
                <label for="listing_date">Дата оголошення</label>
                <input type="date" name="listing_date" id="listing_date" value="<?= $old_date?>" required>
            </div>
            <div class="form-group">
                <label for="user_id">Користувач</label>
                <select name="user_id" id="user_id" required>
                <?php foreach ($user_ids as $id): ?>
                    <option value="<?= $id ?>" <?= ($id == ($old_user ?? '')) ? 'selected' : '' ?>><?= $id ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="address_id">Адреса</label>
                <select name="address_id" id="address_id" required>
                <?php foreach ($address_ids as $id): ?>
                    <option value="<?= $id ?>" <?= ($id == ($old_adress ?? '')) ? 'selected' : '' ?>><?= $id ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="listing_type_id">Тип оголошення</label>
                <select name="listing_type_id" id="listing_type_id" required>
                <?php foreach ($listing_type_ids as $id): ?>
                    <option value="<?= $id ?>" <?= ($id == ($old_type ?? '')) ? 'selected' : '' ?>><?= $id ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Оновити</button>
                <a href="listings.php" class="btn btn-secondary">Назад</a>
            </div>
        </form>

    </body>
</html>