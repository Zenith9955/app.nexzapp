<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "admin";

// Establishing a connection to the database
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

// Checking if the connection was successful
if (!$conn) {
    die("Connection failed");
}
?>
