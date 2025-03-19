<?php
require_once "db_config.php";
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Статистика</h2>
        
        <?php
        // Скільки всього записів у таблиці Listing_Types
        $query = "SELECT COUNT(*) as total FROM Listing_Types";
        $result = mysqli_query($conn, $query);
        $total_listing_types = mysqli_fetch_assoc($result)['total'];
        
        // Скільки всього записів у таблиці Listings
        $query = "SELECT COUNT(*) as total FROM Listings";
        $result = mysqli_query($conn, $query);
        $total_listings = mysqli_fetch_assoc($result)['total'];
        
        // Скільки записів за останній місяць у таблиці Listing_Types
        $query = "SELECT COUNT(*) as total FROM Listing_Types WHERE created_at >= NOW() - INTERVAL 1 MONTH";
        $result = mysqli_query($conn, $query);
        $listing_types_last_month = mysqli_fetch_assoc($result)['total'];
        
        // Скільки записів за останній місяць у таблиці Listings
        $query = "SELECT COUNT(*) as total FROM Listings WHERE created_at >= NOW() - INTERVAL 1 MONTH";
        $result = mysqli_query($conn, $query);
        $listings_last_month = mysqli_fetch_assoc($result)['total'];
        
        // Останній запис у таблиці Listings
        $query = "SELECT id, description, created_at FROM Listings ORDER BY created_at DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
        $last_listing = mysqli_fetch_assoc($result);
        
        // Тип оголошення з найбільшою кількістю пов’язаних оголошень
        $query = "SELECT lt.id, lt.name, COUNT(l.id) as count 
                  FROM Listing_Types lt 
                  LEFT JOIN Listings l ON lt.id = l.listing_type_id 
                  GROUP BY lt.id, lt.name 
                  ORDER BY count DESC 
                  LIMIT 1";
        $result = mysqli_query($conn, $query);
        $most_popular_type = mysqli_fetch_assoc($result);
        ?>
        
        <p><strong>Загальна кількість типів оголошень:</strong> <?php echo $total_listing_types; ?></p>
        <p><strong>Загальна кількість оголошень:</strong> <?php echo $total_listings; ?></p>
        <p><strong>Типів оголошень за останній місяць:</strong> <?php echo $listing_types_last_month; ?></p>
        <p><strong>Оголошень за останній місяць:</strong> <?php echo $listings_last_month; ?></p>
        <p><strong>Останнє додане оголошення:</strong> <?php echo $last_listing['description'] . " (ID: " . $last_listing['id'] . ", Дата: " . $last_listing['created_at'] . ")"; ?></p>
        <p><strong>Найпопулярніший тип оголошень:</strong> <?php echo $most_popular_type['name'] . " (ID: " . $most_popular_type['id'] . ", Кількість: " . $most_popular_type['count'] . ")"; ?></p>
        
        <a href="index.php" class="btn btn-secondary">Повернутися на головну</a>
    </div>
</body>
</html>