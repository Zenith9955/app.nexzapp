<?php
// Establish a database connection
require_once "masterdatabase.php";

// Check if the 'name' parameter is set and not empty
if(isset($_POST['feasibilityID']) && !empty($_POST['feasibilityID'])) {
    $feasibilityID = $_POST['feasibilityID'];

    // Prepare a SQL statement to fetch project details based on the selected customer name
    $sql = "SELECT * FROM darkfiber WHERE feasibilityID = ?";
    
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $feasibilityID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Return project details as JSON
    } else {
        echo json_encode(array('error' => 'No project found for the selected customer.'));
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo json_encode(array('error' => 'Name parameter not provided.'));
}
?>
