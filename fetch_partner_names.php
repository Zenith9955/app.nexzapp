<?php
require_once "masterdatabase.php";

header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'name' parameter is set in the POST request
    if (isset($_POST['feasibilityID'])) {
        // Assign feasibilityID from POST data
        $feasibilityID = $_POST['feasibilityID'];

        // Initialize an empty array to store partner names
        $partners = [];

        // SQL query to get distinct partner names for the selected feasibilityID
        $sql = "SELECT DISTINCT partnername1, partnername2, partnername3, partnername4, partnername5 FROM darkfiber WHERE feasibilityID = ?";
        $stmt = $conn->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("s", $feasibilityID);
            $stmt->execute();

            // Get the result set from the executed statement
            $result = $stmt->get_result();

            // Loop through the result set and extract partner names
            while ($row = $result->fetch_assoc()) {
                // Loop through each partnername field and add its value to $partners array
                foreach ($row as $partner) {
                    if (!empty($partner)) {
                        $partners[] = $partner;
                    }
                }
            }

            // Close the statement
            $stmt->close();
        } else {
            // If the statement preparation failed, return an error
            echo json_encode(["error" => "Failed to prepare statement"]);
            exit;
        }

        // Close the database connection
        $conn->close();

        // Remove duplicate partner names
        $partners = array_unique($partners);

        // Return results as JSON
        echo json_encode($partners);
    } else {
        // If 'name' parameter is not set in the POST request, return an error
        echo json_encode(["error" => "'name' parameter is missing in the POST request"]);
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(["error" => "Only POST requests are allowed"]);
}
?>
