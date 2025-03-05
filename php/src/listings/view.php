<!DOCTYPE html>
<html lang="en">
    <body>
    <?php
        $listing_id = mysqli_real_escape_string($conn, $id);

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

    ?>
    </body>
</html>