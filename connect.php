<?php
$hostname = "localhost"; //local server name default localhost
$username = "kerala_congress1";  //mysql username default is root.
$password = "kerala_congress";       //blank if no password is set for mysql.
$database = "kerala_congress";  //database name which you created

$con = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die('Connection Failed: ' . $con->connect_error);
}
?>
