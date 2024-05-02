<?php
session_start();
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
  <link rel="stylesheet" href="css/style.css">
</head>
<!-------------------CSS START----------------------------------------->
<style>
   body {
 background-color: #fff;
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



  <!---========================CUSTOMER FORMS============================================-->
  
  
  <div class="box"> <!-- Enclosing the content in a box -->
  <?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  require_once "masterdatabase.php";
    function sanitize_input($conn, $data) {
        return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
    }

    // Sanitize input data
    $feasibilityID = sanitize_input($conn, $_POST['feasibilityID']);
    $date = sanitize_input($conn, $_POST['date']);
    $name = sanitize_input($conn, $_POST['name']);
    $contactname = sanitize_input($conn, $_POST['contactname']);
    $contactnub = sanitize_input($conn, $_POST['contactnub']);
    $contactmail = sanitize_input($conn, $_POST['contactmail']);
    $fibertype = sanitize_input($conn, $_POST['fibertype']);
    $endA = sanitize_input($conn, $_POST['endA']);
    $endAlatlong = sanitize_input($conn, $_POST['endAlatlong']);
    $endB = sanitize_input($conn, $_POST['endB']);
    $endBlatlong = sanitize_input($conn, $_POST['endBlatlong']);
    $partnername = sanitize_input($conn, $_POST['partnername']);
    $partnernumber = sanitize_input($conn, $_POST['partnernumber']);
    $partnermail = sanitize_input($conn, $_POST['partnermail']);
    $Status = sanitize_input($conn, $_POST['Status']);
    $postatus = sanitize_input($conn, $_POST['postatus']);
    $po = sanitize_input($conn, $_POST['po']);

    // Other input sanitization here...

    // SQL query to insert data into database using prepared statements
    $sql = "INSERT INTO darkfiber (feasibilityID, date, name, contactname, contactnub, contactmail, fibertype, endA, endAlatlong, endB, endBlatlong, partnername, partnernumber, partnermail, Status, postatus, po) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $feasibilityID, $date, $name, $contactname, $contactnub, $contactmail, $fibertype, $endA, $endAlatlong, $endB, $endBlatlong, $partnername, $partnernumber, $partnermail, $Status, $postatus, $po);
        mysqli_stmt_execute($stmt);
        
        // Check if the insertion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<div class='alert alert-success'>Upload successful</div>";
        } else {
            echo "<div class='alert alert-danger'>Insertion failed</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
    }
}
?>
 <!---------------------------DATABASE PHP END------------------------------>
  <?php
require_once "masterdatabase.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current month
$currentMonth = date('m');

// SQL query to get the maximum serial number for the current month
$sql = "SELECT MAX(SUBSTRING(feasibilityID, 9)) AS max_serial FROM Darkfiber WHERE SUBSTRING(feasibilityID, 4, 2) = '$currentMonth'";
$result = $conn->query($sql);
$maxSerial = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['max_serial'] != null) {
        $maxSerial = intval($row['max_serial']);
    }
}

// Increment the serial number
$newSerial = $maxSerial + 1;

// Pad the serial number with leading zeros if necessary
$serialNumber = str_pad($newSerial, 4, '0', STR_PAD_LEFT);

// Construct the feasibility ID
$feasibilityID = "OR/$currentMonth/$serialNumber";

?>
    <form action="" method="post" enctype="multipart/form-data">
      <h1>Darkfiber Form</h1>

      <div class="grid-container">
            <div class="grid-item">
                <label for="feasibilityID">Feasibility ID</label>
                <input type="text" id="feasibilityID" name="feasibilityID" value="<?php echo $feasibilityID; ?>" readonly>
            </div>

            <div class="grid-item">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
       
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
         <input type="text" id="endAlatlong" name="endAlatlong" required>
        </div>
        <div class="grid-item">
                <label for="endB">End B</label>
                <input type="text" id="endB" name="endB" required>
            </div>
        <div class="grid-item">
          <label for="endBlatlong">End B Latlong</label>
          <input type="text" id="endBlatlong" name="endBlatlong" required>
        </div>
       
        <div class="grid-item">
          <label for="partnername">Partner Name</label>
          <input type="text" id="partnername" name="partnername" required>
        </div>
        <div class="grid-item">
          <label for="partnernumber">Partner Number</label>
          <input type="text" id="partnernumber" name="partnernumber" required>
        </div>
        <div class="grid-item">
          <label for="partnermail">Partner Mail</label>
          <input type="text" id="partnermail" name="partnermail" required>
        </div>
        <div class="grid-item">
           <label for="Status">Feasibility Status</label>
           <select id="Status" name="Status" onchange="toggleForm()">
            <option value="none" selected disabled hidden>Choose Status</option>
           <option value="yes">Yes</option>
           <option value="no">No</option>
            </select>
        </div>   
        <div class="grid-item">
    <label for="postatus">Po Status</label>
    <select id="postatus" name="postatus" onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose Status</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
</div>
<div class="grid-item" id="ponumberdiv" style="display: none;">
    <label for="po">Po Number</label>
    <input type="text" id="po" name="po">
</div>

<script>
    function toggleForm() {
        var postatus = document.getElementById("postatus").value;
        var ponumberdiv = document.getElementById("ponumberdiv");

        if (postatus === "yes") {
            ponumberdiv.style.display = "block";
        } else {
            ponumberdiv.style.display = "none";
        }
      }    
</script>
      <div class="button-container">
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
  
</body>
</html>
