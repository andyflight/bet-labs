<?php

require_once "db_config.php";
require_once "header.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listings</title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>

        <div class="container">
        <?php
        if (isset($_GET['listing'])) {
            $listing_id = mysqli_real_escape_string($conn, $_GET['listing']);

            echo $_GET['listing'];

            $details_query = "
                SELECT 
                    l.description, 
                    l.room_count, 
                    l.area, 
                    l.price, 
                    l.listing_date, 
                    u.username, 
                    u.email,
                    a.city, 
                    a.district, 
                    a.street, 
                    a.building_number, 
                    a.apartment_number,
                    lt.name AS listing_type
                FROM Listings l
                JOIN Users u ON l.user_id = u.id
                JOIN Adresses a ON l.adress_id = a.id
                JOIN Listing_Types lt ON l.listing_type_id = lt.id
                WHERE l.id = '$listing_id'
            ";

            $details_result = mysqli_query($conn, $details_query);

            if ($details_result && mysqli_num_rows($details_result) > 0) {
                $listing = mysqli_fetch_assoc($details_result);
                echo "<div class='listing-details'>
                        <h2>Listing Details</h2>
                        <p><strong>Description:</strong> {$listing['description']}</p>
                        <p><strong>Rooms:</strong> {$listing['room_count']}</p>
                        <p><strong>Area:</strong> {$listing['area']} m²</p>
                        <p><strong>Price:</strong> \${$listing['price']}</p>
                        <p><strong>Listing Date:</strong> {$listing['listing_date']}</p>
                        <p><strong>Listing Type:</strong> {$listing['listing_type']}</p>
                        <p><strong>Location:</strong> {$listing['city']}, {$listing['district']}, {$listing['street']}, {$listing['building_number']} {$listing['apartment_number']}</p>
                        <p><strong>Posted by:</strong> {$listing['username']} ({$listing['email']})</p>
                        <a href='listings.php' class='back-link'>← Back to Listings</a>
                    </div>";
            } else {
                echo "<p class='error-message'>Listing not found.</p>";
            }
        } else {
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
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td><a href='listings.php?listing=" . $row['id'] . "'>" . $row['id'] . "</a></td>
                        <td>{$row['city']}</td>
                        <td>{$row['street']}</td>
                        <td>{$row['building_number']}</td>
                        <td>{$row['area']}</td>
                        <td>{$row['room_count']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['listing_type']}</td>
                    </tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
    </body>
</html>


