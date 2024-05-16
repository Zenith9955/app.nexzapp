<?php
// Establish a database connection (you'll need your actual database credentials here)
require_once "masterdatabase.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'name' parameter is set and not empty
if(isset($_POST['name']) && !empty($_POST['name'])) {
    // Prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    
    // SQL query to fetch feasibility IDs based on the selected customer name and postatus 'yes'
    $sql = "SELECT feasibilityID FROM darkfiber WHERE name = '$name' AND postatus = 'yes'";
    $result = $conn->query($sql);

    // Array to store feasibility IDs
    $feasibilityID = array();

    // Check if there are results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add feasibility ID to the array
            $feasibilityID[] = $row['feasibilityID'];
        }
    }

    // Close query
    $result->close();

    // Return JSON response
    echo json_encode($feasibilityID);
} else {
    // If 'name' parameter is not set or empty, return an empty JSON array
    echo json_encode(array());
}

// Close database connection
$conn->close();
?>
