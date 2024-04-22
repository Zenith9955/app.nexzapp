<?php
// Database connection
require_once "masterdatabase.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Check if file name is provided in the URL
if(isset($_GET['file'])) {
    $fileName = sanitize_input($_GET['file']);
    $filePath = 'uploads/' . $fileName;

    // Check if the file exists
    if(file_exists($filePath)) {
        // Set headers to force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    } else {
        // File not found
        echo "File not found.";
    }
} else {
    // No file name provided, display database contents with grouped download links
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="UTF-8">
        <title>File Download</title>
        <style>

form {
  display: flex;
  justify-content: center;
  margin-top: 100px;
}
      

h2{
        color:#4b4b4b;
        text-align: center;
        font-weight: bold;
      }

table {
    width: 100%;
    margin : 10px auto;
    border-collapse: collapse;
    overflow: hidden; /* Ensuring borders are consistent */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 5px solid #ccc; /* Adding a subtle shadow for depth */
    font-size: 15px
}

table th, table td {
    padding: 10px; /* Increasing padding for better spacing */
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f9f9f9; /* Slightly lighter shade for even rows */
}

table tr:hover {
    background-color: #e6e6e6; /* Darker shade on hover for better feedback */
}

/* Styling for form elements */

input[type="text"],
button {
    
    padding: 15px; /* Making input and button sizes consistent */
    font-size: 15px;
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 2px solid #ccc; /* Adding a light border for input fields */
}

button {
    cursor: pointer;
    background-color: #007bff; /* Adding a primary color for buttons */
    color: #fff; /* Making button text white for better contrast */
    border: none;
    transition: background-color 0.3s ease; /* Adding smooth transition on hover */
}

button:hover {
    background-color: #0056b3; /* Darkening button color on hover */
}
a {
    text-decoration: none;
    color: #007bff; /* Using the primary color for links */
}
a:hover {
    color: #0056b3; /* Darkening link color on hover */
}

</style>
    
<!-----------------------=+===========CSS END=======================---------->

</head>
    <header>
    <div class="logo">
      <img src="css/logo.jpg" alt="Logo">
    </div>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="index.php">Master &#9662;</a>
          <div class="dropdown-content">
            <a href="vendor.php">Vendor</a>
            <a href="cust.php">Customer</a>
            <a href="#">State</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#">Service &#9662;</a>
          <div class="dropdown-content">
            <a href="#">Fiber</a>
            <a href="#">Bandwidth</a>
            <a href="#">Managed Fiber</a>
            <a href="#">Infra Solution</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#">Feasibility &#9662;</a>
          <div class="dropdown-content">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#">Customer Database &#9662;</a>
          <div class="dropdown-content">
            <a href="#">Manage Services</a>
            <a href="#">Fiber Services</a>
            <a href="#">Port Fiber</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#">Tracker &#9662;</a>
          <div class="dropdown-content">
            <a href="tracker1.php">Tracker 1 </a>
            <a href="#">Tracker 2</a>
            <a href="#">Tracker 3</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#">Profile &#9662;</a>
          <div class="dropdown-content">
          <a href="logout.php">Sign Out</a>
          <a href="search.php">Search</a>
        </div>
        </li>
      </ul>
    </nav>
  </header>
    <body>
        <h2>Documents</h2>
        <form method="get">
            <label for="search"></label>
            <input type="text" id="search" name="search" placeholder = "Search">
            <button type="submit">Search</button>
        </form>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Download Links</th>
            </tr>
            <!-- Fetch fields from the customers table based on search -->
            <?php
            $sql = "SELECT name, agreement, others, cancel_cheque, coi, pan, license, other FROM customers"; 

            // Check if search parameter is provided
            if(isset($_GET['search']) && !empty($_GET['search'])) {
                $search = sanitize_input($_GET['search']);
                $sql .= " WHERE name LIKE '%$search%'";
            }

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $filesByCustomer = array();
                while($row = mysqli_fetch_assoc($result)) {
                    // Group files by customer name
                    $customerName = $row['name'];
                    $filesByCustomer[$customerName] = array();
                    foreach ($row as $key => $value) {
                        if ($key !== 'name' && !empty($value)) {
                            $fileName = basename($value);
                            $fileUrl = 'download.php?file=' . urlencode($fileName);
                            $filesByCustomer[$customerName][$key] = '<a href="' . $fileUrl . '">Download ' . $key . '</a>';
                        }
                    }
                }

                // Output the grouped files with download links
                foreach ($filesByCustomer as $customerName => $files) {
                    echo '<tr>';
                    echo '<td>' . $customerName . '</td>';
                    echo '<td>' . implode(', ', $files) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="2">No files found in the database.</td></tr>';
            }

            mysqli_close($conn);
            ?>
        </table>
    </body>
    </html>
    <?php
}
?>