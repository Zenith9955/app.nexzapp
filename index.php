<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>
<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "master";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize variables
$tables = [];
$searchResults = null;

// Retrieve all table names from the database
$result = $connection->query("SHOW TABLES FROM $dbname");
if ($result) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
} else {
    echo "Error retrieving table names: " . $connection->error;
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database Tables</title>
    <style>
          body {
 background-color: #fff;
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
/*-----------------------------MAIN CSS--------------------------------*/

/* Adjust main padding to match header height */
main {
    padding-top: 120px;
}

/* Center headings and use dark grey color */
h2{
    text-align: center;
    color: #333;
    font-size: 35px;
}
h3{
   text-align: left;
   color: #4b4b4b;
   font-size: 20px;
}

/* Center buttons and add space between them */
.buttons {
    text-align: center;
    margin-bottom: 20px;
}
/* Style buttons with blue background and white text */
/* Style buttons with blue background and white text */
button {
    margin: 5px;
    padding: 12px 24px; /* Increased padding */
    background-color: #007bff; /* Blue */
    color: #fff;
    border: none;
    border-radius: 05px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease; /* Added transform property for animation */
    font-size: 15px;
}

/* Darken button background color and add pulse animation on hover */
button:hover {
    background-color: #0056b3; /* Darker blue */
    transform: scale(1.05); /* Scale the button slightly on hover */
    animation: pulse 0.5s infinite alternate; /* Apply pulse animation */
}


table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

/* Style table headers with dark grey background and white text */
th {
    background-color: #ababab;
    color: #fff;
    padding: 10px; /* Increased padding */
}

/* Style table cells with border and padding */
td {
    border: 1px solid #ddd;
    padding: 10px; /* Increased padding */
}

/* Alternate row colors for better readability */
tr:nth-child(even) {
    background-color: #f2f2f2; /* Light grey */
}

/* Center no-data message and use light grey color */
.no-data {
    text-align: center;
    color: #888;
}


</style>
</head>
<body>
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
  <main>

    <h2>Onremote Telecom</h2>
    <div class="buttons">
        <?php foreach ($tables as $table): ?>
            <form method="GET" style="display: inline;">
                <button type="submit" name="action" value="<?php echo $table; ?>"><?php echo $table; ?></button>
            </form>
        <?php endforeach; ?>
    </div>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
        $selectedTable = $_GET['action'];

        // Create connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Fetch column names dynamically
        $columnNames = [];
        $columns = $connection->query("SHOW COLUMNS FROM $selectedTable");
        if ($columns) {
            while ($row = $columns->fetch_array()) {
                $columnNames[] = $row[0];
            }
        } else {
            echo "Error retrieving column names for $selectedTable: " . $connection->error;
        }

        // Close connection
        $connection->close();

        // Display selected table data
        echo "<h3>Database: " . htmlspecialchars($selectedTable) . "</h3>";
        echo "<table>";
        echo "<tr>";
        foreach ($columnNames as $columnName) {
            echo "<th>" . htmlspecialchars($columnName) . "</th>";
        }
        echo "</tr>";

        // Fetch and display table data
        $connection = new mysqli($servername, $username, $password, $dbname);
        $result = $connection->query("SELECT * FROM $selectedTable");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($columnNames as $columnName) {
                    echo "<td>" . htmlspecialchars($row[$columnName]) . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='" . count($columnNames) . "' class='no-data'>No data available</td></tr>";
        }
        echo "</table>";

        // Close connection
        $connection->close();
    }
    ?>
    </main>
</body>
</html>
