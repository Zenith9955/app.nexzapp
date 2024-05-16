<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Database</title>
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
main {
    max-width: 100%;
    margin: 120px auto;
    background-color: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #4b4b4b;
    text-align: left;
    font-size: 20px;
    margin-bottom: 0px;
}

form {
    display: flex;
    justify-content: left; /* Align form elements to the left */
    padding: 15px; /* Add padding to form */
}

table {
    width: 100%;
    margin: 9px auto;
    border-collapse: collapse;
    overflow: hidden; /* Ensuring borders are consistent */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 5px solid #ccc; /* Adding a subtle shadow for depth */
    font-size: 15px;
}

table th, table td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
}

table th {
    background-color: #87CEFA;
    color: #656565; /* Text color for table headers */
}

table tr:nth-child(even) {
    background-color: #f9f9f9; /* Lighter shade for even rows */
}

table tr:hover {
    background-color: #e6e6e6; /* Darker shade on hover for better feedback */
}

/* Styling for form elements */
input[type="text"] {
    padding: 15px; /* Making input and button sizes consistent */
    font-size: 12px;
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 1px solid #ccc; /* Adding a light border for input fields */
}

button {
    padding: 10px 10px;
    cursor: pointer;
    background-color: #007bff; /* Adding a primary color for buttons */
    color: #fff; /* Making button text white for better contrast */
    border: none;
    transition: background-color 0.3s ease; /* Adding smooth transition on hover */
}

button:hover {
    background-color: #0056b3; /* Darkening button color on hover */
}

/* Styling for links */
a {
    text-decoration: none;
    color: #007bff; /* Using the primary color for links */
}

.button-container {
    display: flex;
    justify-content: flex-end; /* Align button container to the right */
}

.add-button:hover {
    background-color: #ababab;
    color: white;
} 

.grid-container {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.vendor-box,
.po-box, 
.pending-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
}
.status-box {
    text-align: center;
    padding: 10px;
}

.count {
    font-size: 26px; /* Adjust font size as needed */
    font-weight: bold; /* Make the count bold */
    display: block; /* Display the count as a block element */
    color: #0056b3;
}

.status {
    font-size: 16px; /* Adjust font size as needed */
}

.multiid {
    margin-top: 50px;
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
            <a href="Darkfiber.php">Dark Fiber</a>
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
<?php
// Include database connection
require_once "masterdatabase.php";
$delivery_statuses = [
    "complete" => "Complete Projects",
    "acceptancepending" => "Acceptance Pending",
    "billingpending" => "Billing Pending",
    "wip" => "Work in Progress"
];

// Initialize an array to hold the counts
$delivery_status_counts = [];

// Loop through each delivery status and execute the corresponding SQL query
foreach ($delivery_statuses as $status => $label) {
    $sql = "SELECT COUNT(*) AS total FROM projects WHERE deliverystatus = '$status'";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $delivery_status_counts[$label] = $row['total'];
        $result->free_result();
    } else {
        // Handle query error
        $delivery_status_counts[$label] = "Error";
    }
}

?>
<div class="grid-container">
    <?php foreach ($delivery_status_counts as $label => $count): ?>
        <div class="status-box">
            <span class="count"><?php echo $count; ?></span>
            <span class="status"><?php echo $label; ?></span>
        </div>
    <?php endforeach; ?>
</div>


<form method="get">
    <input type="text" name="search" placeholder="Search by Name">
    <button type="submit">Search</button>
</form>
<div class="button-container">
    <a href="project.php"><button>Add New</button></a>
</div>

<table>
    <tr>
        <th>Customer Name</th>
        <th>Feasibility ID</th>
        <th>Po Number</th>
        <th>Po Date</th>
        <th>Po Expire Date</th>
        <th>Po Distance(In Km)</th>
        <th>Contact Name</th>
        <th>Contact Number</th>
        <th>Contact Mail</th>
        <th>Fiber Type</th>
        <th>End A</th>
        <th>End A Latlong</th>
        <th>End B</th>
        <th>End B Latlong</th>
        <th>Partner Name</th>
        <th>Partner Number</th>
        <th>Partner Email</th>
        <th>Delivery Status</th>
        <th>OTDR DLS</th>
        <th>OTDR Length</th>
        <th>Handover To</th>
        <th>Handover By</th>
        <th>Handover Date</th>
        <th>Recurring Charges</th>
        <th>Project End Date</th>
        <th>Ageing Days</th>
        <th>Acceptance Date</th>
        <th>Remarks</th>
    </tr>
<?php
// Include database connection
require_once "masterdatabase.php";

// Initialize SQL query
$sql = "SELECT * FROM projects";

// Check if search parameter is set
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $_GET['search'];
    // Use prepared statement to prevent SQL injection
    $sql .= " WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    // Bind parameter
    $stmt->bind_param("s", $search);
    // Execute query
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Execute query without search parameter
    $result = $conn->query($sql);
}

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["feasibilityID"]."</td>";
        echo "<td>".$row["po"]."</td>";
        echo "<td>".$row["podate"]."</td>";
        echo "<td>".$row["expire"]."</td>";
        echo "<td>".$row["podis"]."</td>";
        echo "<td>".$row["contactname"]."</td>";
        echo "<td>".$row["contactnub"]."</td>";
        echo "<td>".$row["contactmail"]."</td>";
        echo "<td>".$row["fibertype"]."</td>";
        echo "<td>".$row["endA"]."</td>";
        echo "<td>".$row["endAlatlong"]."</td>";
        echo "<td>".$row["endB"]."</td>";
        echo "<td>".$row["endBlatlong"]."</td>";
        echo "<td>".$row["partnername"]."</td>";
        echo "<td>".$row["partnernumber"]."</td>";
        echo "<td>".$row["partnermail"]."</td>";
        echo "<td>".$row["deliverystatus"]."</td>";
        echo "<td>".$row["otdrdls"]."</td>";
        echo "<td>".$row["otdr"]."</td>";
        echo "<td>".$row["handoverto"]."</td>";
        echo "<td>".$row["handoverby"]."</td>";
        echo "<td>".$row["handover"]."</td>";
        echo "<td>".$row["recurring"]."</td>";
        echo "<td>".$row["projectend"]."</td>";
        echo "<td>".$row["ageingdays"]."</td>";
        echo "<td>".$row["acceptancedate"]."</td>";
        echo "<td>".$row["remarks"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='17'>No results found</td></tr>";
}

// Close statement if it was prepared
if(isset($stmt)) $stmt->close();

// Close connection
?>
</table>
</main>
</body>
</html>
