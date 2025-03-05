<!DOCTYPE html>
<html lang="en">
    <body>
    <?php
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
        ORDER BY l.listing_date DESC";

        $result = mysqli_query($conn, $query);

        if (!$result) {
        die("<p class='error-message'>Query failed: " . mysqli_error($conn) . "</p>");
        }

        echo "<table class='listings-table'>
            <tr>
                <th>ID</th>
                <th>City</th>
                <th>Street</th>
                <th>House Number</th>
                <th>Area (m²)</th>
                <th>Rooms</th>
                <th>Price ($)</th>
                <th>Listing Type</th>
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