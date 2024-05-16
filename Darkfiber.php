<?php
session_start();
require_once "masterdatabase.php";

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Onremote inhouse software</title>
</head>
<!-------------------CSS START----------------------------------------->
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



.box {
  max-width: 1300px;
  margin: 100px auto;
  border-radius: 5px;
  padding: 50px;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 40px;
}

.grid-item {
  display: flex;
  flex-direction: row;
  align-items: center;
}

label {
  margin-right: 10px;
}

input[type="text"],
input[type="date"],
select,
input[type="file"] {
  width: 100%;
  padding: 5px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-bottom: 10px; /* Changed to 10px for some space */
}

.button-container {
  text-align: right;
  margin-top: 20px;
  margin-bottom: 20px;
}

.button-container button {
  padding: 10px 50px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.button-container button:hover {
  background-color: #0056b3;
}

.account-section,
.kyc-section,
.contact-section {
  margin-top: 30px;
}

.database {
  padding: 2px;
  border-radius: 5px;
  display: inline-block;
}

.database a {
  text-decoration: none;
  color: #777;
  font-weight: bold;
}

.database a:hover {
  color: #333;
}

h1 {
  text-align: center;
  margin-top: 5px;
  padding: 0;
}

/* Override background for form elements */
form {
  background-color: #fff; /* Set background color for the form */
  padding: 20px; /* Add padding to the form */
  border-radius: 5px; /* Rounded corners for the form */
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1); /* Add shadow to the form */
}
  </style>
  
  <!-------------------CSS END----------------------------------------->

  
<!------=======================HEADER START==========================================-->

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



  <!---========================CUSTOMER FORMS============================================-->
  
  <div class="box"> 
  <form action="" method="post" enctype="multipart/form-data">
  <?php
require_once 'masterdatabase.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// SQL query to get the maximum serial number for all months
$sql = "SELECT MAX(CAST(SUBSTRING(df.feasibilityID, 12) AS UNSIGNED)) AS max_serial 
        FROM darkfiber df";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$maxSerial = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['max_serial'] !== null) {
        $maxSerial = intval($row['max_serial']);
    }
}

// Increment the serial number
$newSerial = $maxSerial + 1;

// Pad the serial number with leading zeros if necessary
$serialNumber = str_pad($newSerial, 3, '0', STR_PAD_LEFT);

// Construct the feasibility ID with the current month and year
$feasibilityID = "OR/{$currentMonth}/{$currentYear}/{$serialNumber}";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require_once "masterdatabase.php";

    function sanitize_input($conn, $data) {
        return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
    }

    $name = isset($_POST['name']) ? sanitize_input($conn, $_POST['name']) : '';
    $feasibilityID = isset($_POST['feasibilityID']) ? sanitize_input($conn, $_POST['feasibilityID']) : '';
    $date = isset($_POST['date']) ? sanitize_input($conn, $_POST['date']) : '';
    $contactname = isset($_POST['contactname']) ? sanitize_input($conn, $_POST['contactname']) : '';
    $contactnub = isset($_POST['contactnub']) ? sanitize_input($conn, $_POST['contactnub']) : '';
    $contactmail = isset($_POST['contactmail']) ? sanitize_input($conn, $_POST['contactmail']) : '';
    $fibertype = isset($_POST['fibertype']) ? sanitize_input($conn, $_POST['fibertype']) : '';
    $endA = isset($_POST['endA']) ? sanitize_input($conn, $_POST['endA']) : '';
    $endAlatlong = isset($_POST['endAlatlong']) ? sanitize_input($conn, $_POST['endAlatlong']) : '';
    $endB = isset($_POST['endB']) ? sanitize_input($conn, $_POST['endB']) : '';
    $endBlatlong = isset($_POST['endBlatlong']) ? sanitize_input($conn, $_POST['endBlatlong']) : '';
    $postatus = isset($_POST['postatus']) ? sanitize_input($conn, $_POST['postatus']) : '';
    $po = isset($_POST['po']) ? sanitize_input($conn, $_POST['po']) : '';
    $partner = isset($_POST['partner']) ? sanitize_input($conn, $_POST['partner']) : '';
    $partnername1 = isset($_POST['partnername1']) ? sanitize_input($conn, $_POST['partnername1']) : '';
    $partnernumber1 = isset($_POST['partnernumber1']) ? sanitize_input($conn, $_POST['partnernumber1']) : '';
    $partnermail1 = isset($_POST['partnermail1']) ? sanitize_input($conn, $_POST['partnermail1']) : '';
    $Status = isset($_POST['Status']) ? sanitize_input($conn, $_POST['Status']) : '';
    $distance = isset($_POST['distance']) ? sanitize_input($conn, $_POST['distance']) : '';
    $partnername2 = isset($_POST['partnername2']) ? sanitize_input($conn, $_POST['partnername2']) : '';
    $partnernumber2 = isset($_POST['partnernumber2']) ? sanitize_input($conn, $_POST['partnernumber2']) : '';
    $partnermail2 = isset($_POST['partnermail2']) ? sanitize_input($conn, $_POST['partnermail2']) : '';
    $Status2 = isset($_POST['Status2']) ? sanitize_input($conn, $_POST['Status2']) : '';
    $distance2 = isset($_POST['distance2']) ? sanitize_input($conn, $_POST['distance2']) : '';
    $partnername3 = isset($_POST['partnername3']) ? sanitize_input($conn, $_POST['partnername3']) : '';
    $partnernumber3 = isset($_POST['partnernumber3']) ? sanitize_input($conn, $_POST['partnernumber3']) : '';
    $partnermail3 = isset($_POST['partnermail3']) ? sanitize_input($conn, $_POST['partnermail3']) : '';
    $Status3 = isset($_POST['Status3']) ? sanitize_input($conn, $_POST['Status3']) : '';
    $distance3 = isset($_POST['distance3']) ? sanitize_input($conn, $_POST['distance3']) : '';
    $partnername4 = isset($_POST['partnername4']) ? sanitize_input($conn, $_POST['partnername4']) : '';
    $partnernumber4 = isset($_POST['partnernumber4']) ? sanitize_input($conn, $_POST['partnernumber4']) : '';
    $partnermail4 = isset($_POST['partnermail4']) ? sanitize_input($conn, $_POST['partnermail4']) : '';
    $Status4 = isset($_POST['Status4']) ? sanitize_input($conn, $_POST['Status4']) : '';
    $distance4 = isset($_POST['distance4']) ? sanitize_input($conn, $_POST['distance4']) : '';
    $partnername5 = isset($_POST['partnername5']) ? sanitize_input($conn, $_POST['partnername5']) : '';
    $partnernumber5 = isset($_POST['partnernumber5']) ? sanitize_input($conn, $_POST['partnernumber5']) : '';
    $partnermail5 = isset($_POST['partnermail5']) ? sanitize_input($conn, $_POST['partnermail5']) : '';
    $Status5 = isset($_POST['Status5']) ? sanitize_input($conn, $_POST['Status5']) : '';
    $distance5 = isset($_POST['distance5']) ? sanitize_input($conn, $_POST['distance5']) : '';

    // Prepare SQL statement
    $sql = "INSERT INTO darkfiber(feasibilityID, name, date, contactname, contactnub, contactmail, fibertype, endA, endAlatlong, endB, endBlatlong, postatus, po, partner, partnername1, partnernumber1, partnermail1, Status, distance, partnername2, partnernumber2, partnermail2, Status2, distance2, partnername3, partnernumber3, partnermail3, Status3, distance3, partnername4, partnernumber4, partnermail4, Status4, distance4, partnername5, partnernumber5, partnermail5, Status5, distance5) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters and execute statement
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssss",
            $feasibilityID, $name, $date, $contactname, $contactnub, $contactmail, $fibertype, $endA, $endAlatlong, $endB, $endBlatlong, $postatus, $po, $partner, $partnername1, $partnernumber1, $partnermail1, $Status, $distance, $partnername2, $partnernumber2, $partnermail2, $Status2, $distance2, $partnername3, $partnernumber3, $partnermail3, $Status3, $distance3, $partnername4, $partnernumber4, $partnermail4, $Status4, $distance4, $partnername5, $partnernumber5, $partnermail5, $Status5, $distance5);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>Upload successful</div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
    }
}
?>


    
      <h1>Darkfiber Form</h1>
      <div class="grid-container">
      <div class="grid-item">
                <label for="name">Customer Name</label>
                <select id="name" name="name" required>
                    <option value="" selected disabled>Select Customer Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM customers";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
            </div>

     
            <div class="grid-item">
                <label for="feasibilityID">Feasibility ID</label>
                <input type="text" id="feasibilityID" name="feasibilityID" value="<?php echo $feasibilityID; ?>" readonly>
            </div>

            <div class="grid-item">
    <label for="date">Date</label>
    <input type="date" id="date" name="date" required>
</div>

<script>
    // Get today's date
    var today = new Date().toISOString().split('T')[0];
    
    // Set the input value to today's date
    document.getElementById("date").value = today;
</script>

        <div class="grid-item">
          <label for="contactname">Contact Name</label>
          <input type="text" id="contactname" name="contactname" required>
        </div>
        <div class="grid-item">
          <label for="contactnub">Contact Number</label>
          <input type="text" id="contactnub" name="contactnub" required>
        </div>
        <div class="grid-item">
          <label for="contactmail">Contact Mail</label>
          <input type="text" id="contactmail" name="contactmail" required >
        </div>
        <div class="grid-item">
                <label for="fibertype">Fiber Type</label>
                <select id="fibertype" name="fibertype" required>
                    <option value="none" selected disabled hidden>Choose Fiber Type</option>
                    <option value="single">Single Core</option>
                    <option value="pair">Pair</option>
                </select>
            </div>
          <div class="grid-item">
                <label for="endA">End A</label>
                <input type="text" id="endA" name="endA" required>
            </div>
        <div class="grid-item">
          <label for="endAlatlong">End A Latlong</label>
         <input type="text" id="endAlatlong" name="endAlatlong">
        </div>
        <div class="grid-item">
                <label for="endB">End B</label>
                <input type="text" id="endB" name="endB" required>
            </div>
        <div class="grid-item">
          <label for="endBlatlong">End B Latlong</label>
          <input type="text" id="endBlatlong" name="endBlatlong">
        </div>
        <div class="grid-item">
    <label for="postatus">Po Status</label>
    <select id="postatus" name="postatus" onchange="toggleFormPo()">
        <option value="" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="ponumberdiv" style="display: none;">
    <label for="po">Po Number</label>
    <input type="text" id="po" name="po">
</div>
</div>

<div class="Partner-form">
      <a href="#" onclick="togglePartnerForm()"> <h3> Partners Details  &#9662;</h3></a>
      <div id="partnerForm" style="display: none;">
      <div class="grid-container">
      <div class="grid-item">
    <label for="partner">No. of Partner</label>
    <select id="partner" name="partner" required>
        <option value="" selected disabled>Select Partner Name</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</div>
    <div class="grid-item">
  <label for="partnername1">Partner Name</label>
                <select id="partnername1" name="partnername1" >
                    <option value="" selected disabled>Select Partner Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
                  </div>
  <div class="grid-item">
    <label for="partnernumber1">Partner Number</label>
    <input type="text" id="partnernumber1" name="partnernumber1">
  </div>
  <div class="grid-item">
    <label for="partnermail1">Partner Mail</label>
    <input type="text" id="partnermail1" name="partnermail1">
  </div>
  <div class="grid-item">
    <label for="Status">Feasibility Status</label>
    <select id="Status" name="Status" required onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="distancediv" style="display: none;">
    <label for="distance">Distance</label>
    <input type="text" id="distance" name="distance">
</div>
<script>
    function toggleForm() {
        var Status = document.getElementById("Status").value;
        var distancediv = document.getElementById("distancediv");
        if (Status === "yes") {
            distancediv.style.display = "block";
        } else {
            distancediv.style.display = "none";
        }
    }
</script>
    </div>
<br>
<div class="grid-container">
<div class="grid-item">
  <label for="partnername2">Partner Name</label>
                <select id="partnername2" name="partnername2" >
                    <option value="" selected disabled>Select Partner Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
                  </div>
  <div class="grid-item">
    <label for="partnernumber2">Partner Number</label>
    <input type="text" id="partnernumber2" name="partnernumber2">
  </div>
  <div class="grid-item">
    <label for="partnermail2">Partner Mail</label>
    <input type="text" id="partnermail2" name="partnermail2">
  </div>
  <div class="grid-item">
    <label for="Status2">Feasibility Status</label>
    <select id="Status2" name="Status2" required onchange="toggleForm2()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="distancediv2" style="display: none;">
    <label for="distance2">Distance</label>
    <input type="text" id="distance2" name="distance2">
</div>
<script>
    function toggleForm2() {
        var Status2 = document.getElementById("Status2").value;
        var distancediv2 = document.getElementById("distancediv2");
        if (Status2 === "yes") {
            distancediv2.style.display = "block";
        } else {
            distancediv2.style.display = "none";
        }
    }
</script>
    </div>
<br>
<div class="grid-container">
<div class="grid-item">
  <label for="partnername3">Partner Name</label>
                <select id="partnername3" name="partnername3" >
                    <option value="" selected disabled>Select Partner Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
                  </div>
  <div class="grid-item">
    <label for="partnernumber3">Partner Number</label>
    <input type="text" id="partnernumber3" name="partnernumber3">
  </div>
  <div class="grid-item">
    <label for="partnermail3">Partner Mail</label>
    <input type="text" id="partnermail3" name="partnermail3">
  </div>
  <div class="grid-item">
    <label for="Status3">Feasibility Status</label>
    <select id="Status3" name="Status3" required onchange="toggleForm3()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="distancediv3" style="display: none;">
    <label for="distance3">Distance</label>
    <input type="text" id="distance3" name="distance3">
</div>
<script>
    function toggleForm3() {
        var Status3 = document.getElementById("Status3").value;
        var distancediv3 = document.getElementById("distancediv3");
        if (Status3 === "yes") {
            distancediv3.style.display = "block";
        } else {
            distancediv3.style.display = "none";
        }
    }
</script>
    </div>
<br>
<div class="grid-container">
<div class="grid-item">
  <label for="partnername4">Partner Name</label>
                <select id="partnername4" name="partnername4" >
                    <option value="" selected disabled>Select Partner Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
                  </div>
  <div class="grid-item">
    <label for="partnernumber4">Partner Number</label>
    <input type="text" id="partnernumber4" name="partnernumber4">
  </div>
  <div class="grid-item">
    <label for="partnermail4">Partner Mail</label>
    <input type="text" id="partnermail4" name="partnermail4">
  </div>
  <div class="grid-item">
    <label for="Status4">Feasibility Status</label>
    <select id="Status4" name="Status4" required onchange="toggleForm4()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="distancediv4" style="display: none;">
    <label for="distance4">Distance</label>
    <input type="text" id="distance4" name="distance4">
</div>
<script>
    function toggleForm4() {
        var Status4 = document.getElementById("Status4").value;
        var distancediv4 = document.getElementById("distancediv4");
        if (Status4 === "yes") {
            distancediv4.style.display = "block";
        } else {
            distancediv4.style.display = "none";
        }
    }
</script>
    </div>
<br>
<div class="grid-container">
  <div class="grid-item">
  <label for="partnername5">Partner Name</label>
                <select id="partnername5" name="partnername5" >
                    <option value="" selected disabled>Select Partner Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
                  </div>
  <div class="grid-item">
    <label for="partnernumber5">Partner Number</label>
    <input type="text" id="partnernumber5" name="partnernumber5">
  </div>
  <div class="grid-item">
    <label for="partnermail5">Partner Mail</label>
    <input type="text" id="partnermail5" name="partnermail5">
  </div>
  <div class="grid-item">
    <label for="Status5">Feasibility Status</label>
    <select id="Status5" name="Status5" required onchange="toggleForm5()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="distancediv5" style="display: none;">
    <label for="distance5">Distance</label>
    <input type="text" id="distance5" name="distance5">
</div>
<script>
    function toggleForm5() {
        var Status5 = document.getElementById("Status5").value;
        var distancediv5 = document.getElementById("distancediv5");
        if (Status5 === "yes") {
            distancediv5.style.display = "block";
        } else {
            distancediv5.style.display = "none";
        }
    }
</script>
    </div>
</div>
<script>
    function toggleFormPo() {
        var postatus = document.getElementById("postatus").value;
        var ponumberdiv = document.getElementById("ponumberdiv");
        if (postatus === "yes") {
            ponumberdiv.style.display = "block";
        } else {
            ponumberdiv.style.display = "none";
        }
    }
</script>
  
<script>
    function togglePartnerForm() {
        var partnerForm = document.getElementById("partnerForm");
        if (partnerForm.style.display === "none" || partnerForm.style.display === "") {
            partnerForm.style.display = "block";
        } else {
            partnerForm.style.display = "none";
        }
    }
</script>

      <div class="button-container">
        <button type="submit" name="submit">Submit</button>
      </div>
      <div class = "database">
      <a href="darkfiberdata.php">Darkfiber   Database</a>
      </div>
    </form>
  </div>
  
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>