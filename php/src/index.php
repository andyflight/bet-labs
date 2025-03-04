<?php

require_once "header.php";
require_once "db_config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>

</head>
<body>
    <div class="container">

        <?php

        if (basename($_SERVER['PHP_SELF']) === 'index.php') {
            

            echo "Hello World!<br><br>";

            if ($conn) {
                echo "Connection established<br>";
            } else {
                echo "Connection not established<br>";
            }
        }

        ?>
    </div>
</body>
</html>