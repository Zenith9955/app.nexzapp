<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$host = 'localhost';  // Adjust according to your database host
$username = 'root';   // Your database username
$password = '';       // Your database password
$database = 'master';  // Your database name
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Assuming you have a function to safely fetch and verify the file names before deleting
    $stmt = $conn->prepare("SELECT agreement, others FROM vendor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        @unlink('uploads/' . basename($row['agreement']));
        @unlink('uploads/' . basename($row['others']));
    }
    $stmt->close();

    // Delete the record
    $stmt = $conn->prepare("DELETE FROM vendor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: vendordata.php"); // Prevent form resubmission pattern
    exit;
}

// Search functionality
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM vendor WHERE name LIKE ?");
    $searchTerm = "%{$search}%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM vendor");
}

$stmt->execute();
$result = $stmt->get_result();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch active vendors
$sqlActive = "SELECT name FROM vendor WHERE status = 'Active'";
$resultActive = $conn->query($sqlActive);

// Fetch inactive vendors
$sqlInactive = "SELECT name, Inactive FROM vendor WHERE status = 'Inactive'";
$resultInactive = $conn->query($sqlInactive);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Database</title>
</head>
<style>
body {
     font-family: Arial, sans-serif;
     background-color: #fff;
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

 h3 {
     color: #4b4b4b;
     text-align: left;
 }

 form {
 display: flex;
 justify-content: left; /* or space-around */
 padding: 15px;
 margin-top:15px;
}


 table {
     width: 100%;
     margin: 8px auto;
     border-collapse: collapse;
     overflow: hidden; /* Ensuring borders are consistent */
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
     border-radius: 2px; /* Adding border radius for a softer look */
     border: 5px solid #ccc; /* Adding a subtle shadow for depth */
     font-size: 15px;
 }

 table th, table td {
     padding: 2px;
     text-align: center;
     border-bottom: 1px solid #ccc;
     border-right: 1px solid #ccc;
 }

 table th {
     background-color:#87CEFA;
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
 .Combined-Vendors {
    display: flex;
    justify-content: center;
    gap: 20%; /* Adjust this value for the desired space between vendor boxes */
    width: 100%;
}

/* Style for vendor boxes */
.vendor-box {
    padding: 10px;
    background-color: #fff;
    /* margin: 5px; Remove margin to reduce space */
    width: 80px; /* Initial width */
    height: 0;
    padding-bottom: 80px; /* Same as width to make it square */
    position: relative;
}

/* Status text style */
.status {
    font-size: 18px;
    color: #333;
    text-align: center;
}

/* Count text style */
.count {
    font-size: 36px;
    font-weight: bold;
    color: #007bff;
    margin-top: 10px;
    text-align: center;
}

.button-container {
    display: flex;
    justify-content: flex-end; /* Aligns button to the right within the container */
}

.add-button:hover {
    background-color: #ababab;
    color: white;
}



</style>
<!-----------------------=+===========CSS END=======================---------->
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
          <a href="linkdata.php">New-Links</a>
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
// Assuming $resultActive and $resultInactive are defined and contain data
$totalActive = ($resultActive->num_rows > 0) ? $resultActive->num_rows : 0;
$totalInactive = ($resultInactive->num_rows > 0) ? $resultInactive->num_rows : 0;
?>
  
    <div class="grid-container">
    <div class="Combined-Vendors">
        <div class="vendor-box active">
            <div class="status">ACTIVE</div>
            <div class="count"><?= $totalActive ?></div>
        </div>
        <div class="vendor-box inactive">
            <div class="status">INACTIVE</div>
            <div class="count"><?= $totalInactive ?></div>
        </div>
    </div>
</div>

<form action="" method="get">
    <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>
<div class="button-container">
    <a href="vendor.php"><button>Add New</button></a>
</div>

<table border="1">
    <tr>
        <th>Vendor</th>
        <th>Address</th>
        <th> Download Documents</th>
        <th>Start Date</th>
        <th>Expire Date</th>
        <th>Status</th>
        <th>Inactive Date</th>
        <th>Owner</th>
        <th>Account</th>
        <th>Field Team</th>
        <th>Others</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>

            <td>
            <a href="downvendor.php?id=<?= $row['id'] ?>">Download</a>
            </td>

            <td><?= htmlspecialchars($row['start']) ?></td>
            <td><?= htmlspecialchars($row['expire']) ?></td>
            <td><?= htmlspecialchars($row['Status']) ?></td>
            <td><?= htmlspecialchars($row['Inactive']) ?></td>
          
            <td>
             <?= htmlspecialchars($row['ownerdesig']) ?><br>
             <?= htmlspecialchars($row['ownername']) ?><br>
             <?= htmlspecialchars($row['owneremail']) ?><br>
             <?= htmlspecialchars($row['ownercontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['accountdesig']) ?><br>
             <?= htmlspecialchars($row['accountname']) ?><br>
             <?= htmlspecialchars($row['accountemail']) ?><br>
             <?= htmlspecialchars($row['accountcontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['fielddesig']) ?><br>
             <?= htmlspecialchars($row['fieldname']) ?><br>
             <?= htmlspecialchars($row['fieldemail']) ?><br>
             <?= htmlspecialchars($row['fieldcontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['desig']) ?><br>
             <?= htmlspecialchars($row['name']) ?><br>
             <?= htmlspecialchars($row['email']) ?><br>
             <?= htmlspecialchars($row['contact']) ?><br>
            </td>
            
                <td>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</main>
</body>
</html>
<?php
$conn->close();
 ?>
