<?php
echo "Hello World!";

$host = 'mysql_db';
$username = 'root';
$password = 'root';


$connetiontoserver = mysqli_connect($host, $username, $password);
if($connetiontoserver){
echo "Connection established \n";
}
else{
echo "Connection not established";
}

?>
