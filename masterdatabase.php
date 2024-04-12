<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "master";
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
if(!$conn){
    die("Connection failed");
}
?>

