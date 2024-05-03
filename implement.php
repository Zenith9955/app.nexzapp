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
  grid-template-columns: repeat(5, 1fr);
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
    <form action="" method="post" enctype="multipart/form-data">
   
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require_once "masterdatabase.php";

    // Function to sanitize input
    function sanitize_input($conn, $data) {
        return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
    }

    // Function to handle file uploads
    function uploadFile($file) {
        $uploadDirectory = "uploads/";
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDirectory . $fileName;

        // Check if file was uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Move the file to the upload directory
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $targetFilePath;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Get values from POST data and sanitize
    $name = sanitize_input($conn, $_POST['name']);
    $status = sanitize_input($conn, $_POST['status']);
    $disconnection = sanitize_input($conn, $_POST['disconnection']);
    $feasibilityID = sanitize_input($conn, $_POST['feasibilityID']);
    $po = sanitize_input($conn, $_POST['po']);
    $podate = sanitize_input($conn, $_POST['podate']);
    $expire = sanitize_input($conn, $_POST['expire']);
    $podis = sanitize_input($conn, $_POST['podis']);
    $contactname = sanitize_input($conn, $_POST['contactname']);
    $contactnub = sanitize_input($conn, $_POST['contactnub']);
    $contactmail = sanitize_input($conn, $_POST['contactmail']);
    $fibertype = sanitize_input($conn, $_POST['fibertype']);
    $endA = sanitize_input($conn, $_POST['endA']);
    $endAlatlong = sanitize_input($conn, $_POST['endAlatlong']);
    $endB = sanitize_input($conn, $_POST['endB']);
    $endBlatlong = sanitize_input($conn, $_POST['endBlatlong']);
    $vendorname = sanitize_input($conn, $_POST['vendorname']);
    $partnername = sanitize_input($conn, $_POST['partnername']);
    $partnernumber = sanitize_input($conn, $_POST['partnernumber']);
    $partnermail = sanitize_input($conn, $_POST['partnermail']); 
    $otdr = sanitize_input($conn, $_POST['otdr']);
    $overall = sanitize_input($conn, $_POST['overall']);
    $handoverto = sanitize_input($conn, $_POST['handoverto']);
    $handoverby = sanitize_input($conn, $_POST['handoverby']);
    $handover = sanitize_input($conn, $_POST['handover']);
    $recurring = sanitize_input($conn, $_POST['recurring']);
    $deliverystatus = sanitize_input($conn, $_POST['deliverystatus']);
    $projectend = sanitize_input($conn, $_POST['projectend']);
    $ageingdays = sanitize_input($conn, $_POST['ageingdays']);
    $acceptancedate = sanitize_input($conn, $_POST['acceptancedate']);
    $remarks = sanitize_input($conn, $_POST['remarks']);

    // File uploads
    $otdrdlsPath = isset($_FILES['otdrdls']) ? uploadFile($_FILES['otdrdls']) : '';

    // SQL DATABASE
    $sql = "INSERT INTO implement (name, status, disconnection, feasibilityID, po, podate, expire, podis, contactname, contactnub, contactmail, fibertype, endA, endAlatlong, endB, endBlatlong, vendorname, partnername, partnernumber, partnermail, otdr, overall, handoverto, handoverby, handover, recurring, deliverystatus, projectend, ageingdays, acceptancedate, remarks, otdrdls)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
   
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssss",
            $name, $status, $disconnection, $feasibilityID, $po, $podate, $expire, $podis, $contactname, $contactnub, $contactmail, $fibertype, $endA, $endAlatlong, $endB, $endBlatlong, $vendorname, $partnername, $partnernumber, $partnermail, $otdr, $overall, $handoverto, $handoverby, $handover, $recurring, $deliverystatus, $projectend, $ageingdays, $acceptancedate, $remarks, $otdrdlsPath);
        
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>Upload successful</div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
    }
  
}
?>
  <!---------------------===========DATABASE PHP END===================--------------->

      <h1>Implementation Form</h1>

      
      <div class="grid-container">
      <div class="grid-item">
    <label for="feasibilityID">Feasibility ID:</label>
    <select id="feasibilityID" name="feasibilityID" required onchange="fetchCustomerName()">
        <option value="" selected disabled>Select Feasibility ID</option>
        <?php
        // Establish a database connection (you'll need your actual database credentials here)
        require_once "masterdatabase.php";
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to get feasibility IDs
        $sql = "SELECT feasibilityID FROM darkfiber";
        $result = $conn->query($sql);

        // Loop through results and create options for the dropdown
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["feasibilityID"] . '">' . $row["feasibilityID"] . '</option>';
            }
        }

        // Close feasibility ID query
        $result->close();
        ?>
    </select>
</div>

<div class="grid-item">
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required readonly>
</div>

<script>
    function fetchCustomerName() {
        var feasibilityID = document.getElementById("feasibilityID").value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("name").value = this.responseText;
            }
        };
        xhr.open("GET", "fetch_customer_name.php?feasibilityID=" + feasibilityID, true);
        xhr.send();
    }
</script>
        <div class="grid-item">
                <label for="po">Po Number</label>
                <input type="text" id="po" name="po" required>
            </div>
            <div class="grid-item">
                <label for="podate">Po Date:</label>
                <input type="date" id="podate" name="podate" required>
            </div>
        <div class="grid-item">
            <label for="expire">Po Expire Date:</label>
            <input type="date" id="expire" name="expire" >
          </div>
          <div class="grid-item">
          <label for="podis">Po Distance(In Km):</label>
          <input type="text" id="podis" name="podis" required>
      </div>
        <div class="grid-item">
          <label for="contactname">Contact Name:</label>
          <input type="text" id="contactname" name="contactname" required>
        </div>
        <div class="grid-item">
          <label for="contactnub">Contact Number:</label>
          <input type="text" id="contactnub" name="contactnub" required>
        </div>
        <div class="grid-item">
          <label for="contactmail">Contact Mail:</label>
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
                <label for="endA">End A:</label>
                <input type="text" id="endA" name="endA" required>
            </div>
        <div class="grid-item">
          <label for="endAlatlong">End A Latlong:</label>
         <input type="text" id="endAlatlong" name="endAlatlong" required>
        </div>
        <div class="grid-item">
                <label for="endB">End B:</label>
                <input type="text" id="endB" name="endB" required>
            </div>
        <div class="grid-item">
          <label for="endBlatlong">End B Latlong:</label>
          <input type="text" id="endBlatlong" name="endBlatlong" required>
        </div>
       
            <div class="grid-item">
                <label for="vendorname">Partner:</label>
                <select id="vendorname" name="vendorname" required>
                    <option value="" selected disabled>Select Vendor Name</option>
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
          <label for="partnername">Partner Name:</label>
          <input type="text" id="partnername" name="partnername" required>
        </div>
        <div class="grid-item">
          <label for="partnernumber">Partner Number:</label>
          <input type="text" id="partnernumber" name="partnernumber" required>
        </div>
        <div class="grid-item">
          <label for="partnermail">Partner Mail:</label>
          <input type="text" id="partnermail" name="partnermail" required>
        </div>
        <div class="grid-item">
          <label for="otdrdls">OTDR DLS:</label>
          <input type="file" id="otdrdls" name="otdrdls" accept=".pdf, .doc, .docx" >
        </div>
        <div class="grid-item">
                <label for="otdr">OTDR Length:</label>
                <input type="text" id="otdr" name="otdr" required>
            </div>
        <div class="grid-item">
                <label for="overall">Overall Losses:</label>
                <input type="text" id="overall" name="overall" required>
            </div>
        <div class="grid-item">
          <label for="handoverto">Handover To:</label>
          <input type="text" id="handoverto" name="handoverto" required>
        </div>
        <div class="grid-item">
          <label for="handoverby">Handover By:</label>
          <input type="text" id="handoverby" name="handoverby" required>
        </div>
            <div class="grid-item">
                <label for="handover">Handover Date:</label>
                <input type="date" id="handover" name="handover" required>
            </div>
            <div class="grid-item">
                <label for="recurring">Recurring Charges:</label>
                <input type="text" id="recurring" name="recurring" required>
            </div>
        <div class="grid-item">
  <label for="deliverystatus">Delivery Status</label>
  <select id="deliverystatus" name="deliverystatus" onchange="toggleForm()">
    <option value="none" selected disabled hidden>Choose delivery status</option>
    <option value="wip">WIP</option>
    <option value="acceptancepending">Acceptance Pending</option>
    <option value="billingpending">Billing Pending</option>
    <option value="complete">Complete</option>
  </select>
</div>
<div class="grid-item" id="projectEndDateDiv" style="display: none;">
  <label for="projectend">Project End Date:</label>
  <input type="Date" id="projectend" name="projectend">
</div>
<div class="grid-item" id="ageingDaysDiv" style="display: none;">
  <label for="ageingdays">Ageing Days:</label>
  <input type="Date" id="ageingdays" name="ageingdays">
</div>
<div class="grid-item" id="acceptanceDateDiv" style="display: none;">
  <label for="acceptancedate">Acceptance Date:</label>
  <input type="Date" id="acceptancedate" name="acceptancedate" >
</div>

<script>
function toggleForm() {
  var deliverystatus = document.getElementById("deliverystatus").value;
  var projectEndDateDiv = document.getElementById("projectEndDateDiv");
  var ageingDaysDiv = document.getElementById("ageingDaysDiv");
  var acceptanceDateDiv = document.getElementById("acceptanceDateDiv");

  if (deliverystatus === "wip") {
    projectEndDateDiv.style.display = "block";
    ageingDaysDiv.style.display = "block";
    acceptanceDateDiv.style.display = "none";
  } else if (deliverystatus === "acceptancepending") {
    projectEndDateDiv.style.display = "none";
    ageingDaysDiv.style.display = "none";
    acceptanceDateDiv.style.display = "block";
  } else {
    projectEndDateDiv.style.display = "none";
    ageingDaysDiv.style.display = "none";
    acceptanceDateDiv.style.display = "block";
  }
}
</script>

<div class="grid-item">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="none" selected disabled hidden>Choose Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="grid-item">
                <label for="disconnection">Disconnection Date</label>
                <input type="date" id="disconnection" name="disconnection">
            </div>

            <div class="grid-item">
                <label for="remarks">Remarks:</label>
                <input type="text" id="remarks" name="remarks" required>
            </div>
        <div class="button-container">
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
  

</body>
</html>
