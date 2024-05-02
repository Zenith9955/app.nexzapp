<?php
// Establish a database connection (you'll need your actual database credentials here)
require_once "masterdatabase.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve feasibility ID from the AJAX request
$feasibilityID = $_GET['feasibilityID'];

// SQL query to fetch customer name based on feasibility ID
$sql = "SELECT name FROM darkfiber WHERE feasibilityID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $feasibilityID);
$stmt->execute();
$stmt->store_result();

// Check if a record was found
if ($stmt->num_rows > 0) {
    $stmt->bind_result($name);
    $stmt->fetch();
    // Return customer name as response
    echo $name;
} else {
    echo "Customer name not found"; // You can customize this message as needed
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
