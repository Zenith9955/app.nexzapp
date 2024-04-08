<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "admin";
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
if(!$conn){
    die("Connection failed");
}
?>