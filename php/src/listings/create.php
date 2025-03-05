
<!DOCTYPE html>
<html lang="en">

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
                $stmt = $conn->prepare("INSERT INTO Listings (id, description, room_count, area, price, listing_date, user_id, adress_id, listing_type_id) VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bind_param("siddssss", $description, $room_count, $area, $price, $listing_date, $user_id, $address_id, $listing_type_id);

                if ($stmt->execute()) {
                   echo "<script>alert('Row was added successfully')</script>";     
                } else {
                   echo "<script>alert('Something went wrong')</script>";     

                }

                $stmt->close();
                echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "?action=create';</script>";      

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
                <input type="text" name="description" id="description" placeholder="Введіть опис" required>
            </div>
            <div class="form-group">
                <label for="room_count">Кількість кімнат</label>
                <input type="number" name="room_count" id="room_count" min="1" placeholder="Введіть кількість кімнат" required>
            </div>
            <div class="form-group">
                <label for="area">Площа (м²)</label>
                <input type="number" step="0.01" name="area" id="area" placeholder="Введіть площу" required>
            </div>
            <div class="form-group">
                <label for="price">Ціна ($)</label>
                <input type="number" step="0.01" name="price" id="price" placeholder="Введіть ціну" required>
            </div>
            <div class="form-group">
                <label for="listing_date">Дата оголошення</label>
                <input type="date" name="listing_date" id="listing_date" required>
            </div>
            <div class="form-group">
                <label for="user_id">Користувач</label>
                <select name="user_id" id="user_id" required>
                    <option value="">-- Виберіть користувача --</option>
                    <?php foreach ($address_ids as $id): ?>
                        <option value="<?= $id ?>"><?= $id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="address_id">Адреса</label>
                <select name="address_id" id="address_id" required>
                <option value="">-- Виберіть адресу --</option>
                    <?php foreach ($address_ids as $id): ?>
                        <option value="<?= $id ?>"><?= $id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="listing_type_id">Тип оголошення</label>
                <select name="listing_type_id" id="listing_type_id" required>
                <option value="">-- Виберіть тип оголошення --</option>
                    <?php foreach ($address_ids as $id): ?>
                        <option value="<?= $id ?>"><?= $id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Додати</button>
                <a href="listings.php" class="btn btn-secondary">Назад</a>
            </div>
        </form>

    </body>
</html>