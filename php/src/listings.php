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
        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;

        if ($action) {
            $action = htmlspecialchars($action);
        }

        if ($id) {
            $id = htmlspecialchars($id);
        }

        switch ($action) {
            case 'create':
                require_once 'listings/create.php';
                break;
            case 'edit':
                if ($id) {
                    require_once 'listings/edit.php';
                } else {
                    echo "Invalid ID";
                }
                break;
            case 'delete':
                if ($id) {
                    require_once 'listings/delete.php';
                } else {
                    echo "Invalid ID";
                }
                break;
            default:
                if ($id) {
                    require_once 'listings/view.php';
                } else {
                    require_once 'listings/list.php';
                }
                break;
        }
        ?>
    </div>
</body>
</html>