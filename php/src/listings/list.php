<!DOCTYPE html>
<html lang="en">
    <body>
    <?php

        $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'listing_date';
        $sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

        $valid_columns = ['id', 'city', 'street', 'building_number', 'area', 'room_count', 'price', 'listing_type'];
        if (!in_array($sort_column, $valid_columns)) {
            $sort_column = 'listing_date';
        }

        $query = "
        SELECT 
            l.id, 
            a.city, 
            a.street, 
            a.building_number, 
            l.area, 
            l.room_count, 
            l.price, 
            lt.name AS listing_type 
        FROM Listings l
        JOIN Adresses a ON l.adress_id = a.id
        JOIN Listing_Types lt ON l.listing_type_id = lt.id
        ORDER BY $sort_column $sort_order";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("<p class='error-message'>Query failed: " . mysqli_error($conn) . "</p>");
        }

        echo "<table class='listings-table'>
            <tr>
                <th><a href='?sort=id&order=" . ($sort_column === 'id' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>ID</a></th>
                <th><a href='?sort=city&order=" . ($sort_column === 'city' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>City</a></th>
                <th><a href='?sort=street&order=" . ($sort_column === 'street' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>Street</a></th>
                <th><a href='?sort=building_number&order=" . ($sort_column === 'building_number' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>House Number</a></th>
                <th><a href='?sort=area&order=" . ($sort_column === 'area' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>Area (m²)</a></th>
                <th><a href='?sort=room_count&order=" . ($sort_column === 'room_count' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>Rooms</a></th>
                <th><a href='?sort=price&order=" . ($sort_column === 'price' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>Price ($)</a></th>
                <th><a href='?sort=listing_type&order=" . ($sort_column === 'listing_type' && $sort_order === 'ASC' ? 'desc' : 'asc') . "'>Listing Type</a></th>
                <th>Action 1</th>
                <th>Action 2</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td><a href='listings.php?id=" . $row['id'] . "'>" . $row['id'] . "</a></td>
                <td>{$row['city']}</td>
                <td>{$row['street']}</td>
                <td>{$row['building_number']}</td>
                <td>{$row['area']}</td>
                <td>{$row['room_count']}</td>
                <td>{$row['price']}</td>
                <td>{$row['listing_type']}</td>
                <td><a href='listings.php?action=edit&id=" . $row['id'] . "'>" . "Edit" . "</a></td>
                <td><a href='listings.php?action=delete&id=" . $row['id'] . "'>" . "Delete" . "</a></td>
            </tr>";
        }

        echo "</table>";

    ?>

    <a href="listings.php?action=create">
        <button class="styled-button">Add new listing</button>
    </a>
    </body>
</html>