<?php
require_once "header.php";

$host = 'mysql_db';
$username = 'root';
$password = 'root';
$conn = mysqli_connect($host, $username, $password);

$db_name = 'ListingDB';

$query = "CREATE DATABASE IF NOT EXISTS $db_name";
if (mysqli_query($conn, $query)) {
    if (basename($_SERVER['PHP_SELF']) === 'db_config.php') { echo "Database '$db_name' is ready.<br>"; }
} else {
    die("Database creation failed: " . mysqli_error($conn));
}

mysqli_select_db($conn, $db_name);

if (basename($_SERVER['PHP_SELF']) === 'db_config.php') {
    $admin_user = 'admin';
    $admin_password = 'admin';
    
    $query = "CREATE USER IF NOT EXISTS '$admin_user'@'localhost' IDENTIFIED BY '$admin_password'";
    if (mysqli_query($conn, $query)) {
        echo "User '$admin_user' is created.<br>";
    } else {
        echo "User creation skipped or failed.<br>";
    }
    
    $query = "GRANT ALL PRIVILEGES ON *.* TO '$admin_user'@'localhost' WITH GRANT OPTION";
    if (mysqli_query($conn, $query)) {
        echo "User '$admin_user' is now privileged<br>";
    } else {
        echo "Granting privileges skipped or failed<br>";
    }
    
    function tableExists($conn, $table) {
        $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
        return mysqli_num_rows($check) > 0;
    }
    
    $tables = [
        "Users" => "CREATE TABLE Users (
            id VARCHAR(36) PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            username VARCHAR(100) NOT NULL,
            registration_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "Listing_Types" => "CREATE TABLE Listing_Types (
            id VARCHAR(36) PRIMARY KEY,
            name VARCHAR(100) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "Adresses" => "CREATE TABLE Adresses (
            id VARCHAR(36) PRIMARY KEY,
            city VARCHAR(100) NOT NULL,
            district VARCHAR(100),
            street VARCHAR(100) NOT NULL,
            building_number VARCHAR(20) NOT NULL,
            apartment_number VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "Listings" => "CREATE TABLE Listings (
            id VARCHAR(36) PRIMARY KEY,
            description VARCHAR(255),
            room_count INT,
            area DECIMAL(15,2),
            price DECIMAL(15,2),
            listing_date DATE,
            user_id VARCHAR(36),
            adress_id VARCHAR(36),
            listing_type_id VARCHAR(36),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    ];
    
    foreach ($tables as $name => $sql) {
        if (!tableExists($conn, $name)) {
            if (mysqli_query($conn, $sql)) {
                echo "Table '$name' created.<br>";
            } else {
                echo "Error creating '$name': " . mysqli_error($conn) . "<br>";
            }
        } else {
            echo "Table '$name' already exists.<br>";
        }
    }
}
?>