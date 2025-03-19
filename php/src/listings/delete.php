<!DOCTYPE html>
<html lang="en">
<body>
    <?php

    $listing_id = mysqli_real_escape_string($conn, $id);

    $query = "
    DELETE FROM Listings 
    WHERE id='$listing_id'
    ";

    if (mysqli_query($conn, $query)) {
        echo "Listing with id $id was successfully deleted!";
    } else {
        echo "Oopss.. Something went wrong, please try again ...";
    }

    ?>
        <a href="listings.php">Go back to Listings</a>
    </body>
</html>