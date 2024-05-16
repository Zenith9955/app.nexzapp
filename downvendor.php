<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>
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
        <meta charset="UTF-8">
        <title>File Download</title>
        <style>
          body {
  background-color: #fff1;
  background-size: cover;
  background-position: center;
  margin: 0;
  font-family: Arial, sans-serif; 
}
h1,h2,h3,h4,h5,h6{
color: #4b4b4b;
}
h1{
font-size: 35px;
margin: 40px;
padding: 10px;

}
header {
background-color: #ffffff;
color: #333; /* Dark gray */
padding: 10px;
display: flex;
align-items: center;
justify-content: space-between;
width: 100%;
position: fixed;
top: 0;
z-index: 1000; /* Ensure header is above other content */
transition: top 0.3s; /* Smooth transition when scrolling */
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow */
}

.logo img {
height: 90px; /* Adjusted logo size */
}

/* Main content padding to prevent content from being hidden behind fixed header */
main {
padding-top: 90px; /* Adjust to match header height */

}

/* Navigation styles */
nav ul {
list-style: none;
padding: 0;
margin: 0;
}

nav ul li {
display: inline-block;
}

nav ul li a {
color: #333; /* Dark gray */
text-decoration: none;
padding: 15px 25px; /* Reduced padding */
display: block;
transition: background-color 0.3s; /* Smooth hover effect */
}

nav ul li a:hover {
background-color: #e0e0e0; /* Lighter gray on hover */
}

/* Dropdown styles */
.dropdown:hover .dropdown-content {
display: block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9; /* Light gray */
min-width: 200px;
z-index: 1;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
/* 3D Scroll Effect */
transform: translateZ(0);
perspective: 1000px;
overflow-y: auto;
max-height: 200px; /* Adjust as needed */
}

.dropdown-content a {
color: #333; /* Dark gray */
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {
background-color: #e0e0e0; /* Lighter gray on hover */
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown button {
background-color: #ababab; /* Green background */
color: white; /* White text color */
border: none; /* No border */
padding: 5px 10px; /* Padding */
text-align: center; /* Center text */
text-decoration: none; /* No underline */
display: inline-block;
font-size: 14px; /* Font size */
cursor: pointer; /* Cursor on hover */
border-radius: 4px; /* Rounded corners */
}

.dropdown button:hover {
background-color: #333; /* Darker green background on hover */
}

/* CSS for the Sign Out link */
a.signout-link {
color: #333; /* Dark gray text color */
text-decoration: none; /* Remove underline */
padding: 10px 20px; /* Add padding */
border: 1px solid #333; /* Add border */
border-radius: 4px; /* Add rounded corners */
background-color: #fff; /* White background */
}

a.signout-link:hover {
background-color: #e0e0e0; /* Light gray background on hover */
color: #000; /* Darken text color on hover */
}
/* Add a class for when the header is scrolled */
header.scrolled {
top: -90px; /* Negative header height to hide */
}



form {
  display: flex;
  justify-content: ;
  margin-top: 100px;
  padding: 10px;
}
      

h2{
        color:#4b4b4b;
        text-align: none;
        font-weight: bold;
      }

table {
    width: 90%;
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
    background-color: #fff;
}

table tr:nth-child(even) {
    background-color: #f9f9f9; /* Slightly lighter shade for even rows */
}

table tr:hover {
    background-color: #f6f6f6; /* Darker shade on hover for better feedback */
}

/* Styling for form elements */

input[type="text"],
button {
    
    padding: 10px; /* Making input and button sizes consistent */
    font-size: 12px;
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
            <a href="vendordata.php">Vendor</a>
            <a href="data.php">Customer</a>
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
          <a href="darkfiberdata.php">Dark Fiber</a>
            <a href="#">Internet</a>
            <a href="#">Bandwidth</a>
            <a href="#">Leased Line</a>
            <a href="#">Infra</a>
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
          <a href="projectdata.php">Project Tracker</a>
          <a href="linkdata.php">Implement Tracker</a>
            <a href="tracker1.php">Tracker 1</a>
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
        <<form method="get">
            <label for="search"></label>
            <input type="text" id="search" name="search" placeholder = "Search">
            <button type="submit">Search</button>
        </form>
        <table>
            <tr>
                <th>Vendor Name</th>
                <th>Download Links</th>
            </tr>
            <?php
            $sql = "SELECT name, agreement, others, cancel_cheque, coi, pan, gst1, gst2, gst3, license, other FROM vendor"; 

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
