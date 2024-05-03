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



.box {
  max-width: 1300px;
  margin: 100px auto;
  border-radius: 5px;
  padding: 50px;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
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
  text-align: center;
  margin-top: 20px;
}

.button-container button {
  padding: 10px 50px;
  justify-content: center;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  transition: background-color 0.3s;
  margin: 0 auto;
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
  margin-top: 15px;
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

    <!---------------------===========DATABASE PHP===================--------------->
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

 
    $name = isset($_POST['name']) ? sanitize_input($conn, $_POST['name']) : '';
    $address = isset($_POST['address']) ? sanitize_input($conn, $_POST['address']) : '';
    $start = isset($_POST['start']) ? sanitize_input($conn, $_POST['start']) : '';
    $expire = isset($_POST['expire']) ? sanitize_input($conn, $_POST['expire']) : '';
    $Status = isset($_POST['Status']) ? sanitize_input($conn, $_POST['Status']) : '';
    $Inactive = isset($_POST['Inactive']) ? sanitize_input($conn, $_POST['Inactive']) : '';
    $bank_name = isset($_POST['bank_name']) ? sanitize_input($conn, $_POST['bank_name']) : '';
    $branch = isset($_POST['branch']) ? sanitize_input($conn, $_POST['branch']) : '';
    $accountname = isset($_POST['accountname']) ? sanitize_input($conn, $_POST['accountname']) : '';
    $accountnumber = isset($_POST['accountnumber']) ? sanitize_input($conn, $_POST['accountnumber']) : '';
    $accounttype = isset($_POST['accounttype']) ? sanitize_input($conn, $_POST['accounttype']) : '';
    $ifsc_code = isset($_POST['ifsc_code']) ? sanitize_input($conn, $_POST['ifsc_code']) : '';
    $ownerdesig = isset($_POST['ownerdesig']) ? sanitize_input($conn, $_POST['ownerdesig']) : '';
    $ownername = isset($_POST['ownername']) ? sanitize_input($conn, $_POST['ownername']) : '';
    $ownercontact = isset($_POST['ownercontact']) ? sanitize_input($conn, $_POST['ownercontact']) : '';
    $owneremail = isset($_POST['owneremail']) ? sanitize_input($conn, $_POST['owneremail']) : '';
    $accountdesig = isset($_POST['accountdesig']) ? sanitize_input($conn, $_POST['accountdesig']) : '';
    $account_name = isset($_POST['account_name']) ? sanitize_input($conn, $_POST['account_name']) : '';
    $accountcontact = isset($_POST['accountcontact']) ? sanitize_input($conn, $_POST['accountcontact']) : '';
    $accountemail = isset($_POST['accountemail']) ? sanitize_input($conn, $_POST['accountemail']) : '';
    $fielddesig = isset($_POST['fielddesig']) ? sanitize_input($conn, $_POST['fielddesig']) : '';
    $fieldname = isset($_POST['fieldname']) ? sanitize_input($conn, $_POST['fieldname']) : '';
    $fieldcontact = isset($_POST['fieldcontact']) ? sanitize_input($conn, $_POST['fieldcontact']) : '';
    $fieldemail = isset($_POST['fieldemail']) ? sanitize_input($conn, $_POST['fieldemail']) : '';
    $desig = isset($_POST['desig']) ? sanitize_input($conn, $_POST['desig']) : '';
    $nam = isset($_POST['nam']) ? sanitize_input($conn, $_POST['nam']) : '';
    $contact = isset($_POST['contact']) ? sanitize_input($conn, $_POST['contact']) : '';
    $email = isset($_POST['email']) ? sanitize_input($conn, $_POST['email']) : '';
    $totalGst = isset($_POST['totalGst']) ? sanitize_input($conn, $_POST['totalGst']) : '';

    // file Uploads
    $agreementPath = isset($_FILES['agreement']) ? uploadFile($_FILES['agreement']) : '';
    $othersPath = isset($_FILES['others']) ? uploadFile($_FILES['others']) : '';
    $gst1Path = isset($_FILES['gst1']) ? uploadFile($_FILES['gst1']) : '';
    $gst2Path = isset($_FILES['gst2']) ? uploadFile($_FILES['gst2']) : '';
    $gst3Path = isset($_FILES['gst3']) ? uploadFile($_FILES['gst3']) : '';
    $cancel_chequePath = isset($_FILES['cancel_cheque']) ? uploadFile($_FILES['cancel_cheque']) : '';
    $coiPath = isset($_FILES['coi']) ? uploadFile($_FILES['coi']) : '';
    $panPath = isset($_FILES['pan']) ? uploadFile($_FILES['pan']) : '';
    $licensePath = isset($_FILES['license']) ? uploadFile($_FILES['license']) : '';
    $otherPath = isset($_FILES['other']) ? uploadFile($_FILES['other']) : '';

    // Prepare SQL statement
    $sql = "INSERT INTO customers (name, address, start, expire, Status, Inactive, bank_name, branch, accountname, accountnumber, accounttype, ifsc_code, ownerdesig, ownername, ownercontact, owneremail, accountdesig, account_name, accountcontact, accountemail, fielddesig, fieldname, fieldcontact, fieldemail, desig, nam, contact, email, totalGst, agreement, others, cancel_cheque, gst1, gst2, gst3, coi, pan, license, other) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters and execute statement
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssss", 
        $name, $address, $start, $expire, $Status, $Inactive, $bank_name, $branch, $accountname, $accountnumber, $accounttype, $ifsc_code, $ownerdesig, $ownername, $ownercontact, $owneremail, $accountdesig, $account_name, $accountcontact, $accountemail, $fielddesig, $fieldname, $fieldcontact, $fieldemail, $desig, $nam, $contact, $email, $totalGst, $agreementPath, $othersPath, $cancel_chequePath, $gst1Path, $gst2Path, $gst3Path, $coiPath, $panPath, $licensePath, $otherPath);

        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>Upload successful</div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
    }
}
?>




 
  <!---------------------===========DATABASE PHP END===================--------------->

  <h1>Customer Form</h1>

<div class="grid-container">
  <div class="grid-item">
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required>
  </div>
  <div class="grid-item">
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
  </div>
  <div class="grid-item">
    <label for="agreement">Agreement:</label>
    <input type="file" id="agreement" name="agreement" accept=".pdf, .doc, .docx" required>
  </div>
  <div class="grid-item">
      <label for="others">Others:</label>
      <input type="file" id="others" name="others" accept=".pdf, .doc, .docx" >
    </div>
  <div class="grid-item">
    <label for="start">Agreement Start Date:</label>
    <input type="date" id="start" name="start" required>
  </div>
  <div class="grid-item">
    <label for="expire">Agreement Expire Date:</label>
    <input type="date" id="expire" name="expire" required>
  </div>
  <div class="grid-item">
  <label for="Status">Status</label>
<select id="Status" name="Status" onchange="toggleForm()">
  <option value="none" selected disabled hidden>Choose Status</option>
  <option value="active">Active</option>
  <option value="inactive">Inactive</option>
</select>
    </div>
    <div class="grid-item">
    <label for="Inactive">Disconnection Date:</label>
    <input type="date" id="Inactive" name="Inactive" >
  </div>

</div>

<!-- ===================ACCOUNT FORM -==================----------- -->
<div class="account-section">
  <h3> Account Details</h3>
  <div class="grid-container">
  <div class="grid-item">
      <label for="bank_name">Bank Name:</label>
      <input type="text" id="bank_name" name="bank_name" required>
    </div>
    <div class="grid-item">
      <label for="branch">Branch:</label>
      <input type="text" id="branch" name="branch" required>
    </div>
    <div class="grid-item">
      <label for="accountname">Account Name:</label>
      <input type="text" id="accountname" name="accountname" required>
    </div>
    <div class="grid-item">
      <label for="accountnumber">Account Number:</label>
      <input type="text" id="accountnumber" name="accountnumber" required>
    </div>
    <div class="grid-item">
    <label for="accounttype">Account Type</label>
    <div class="account-type-btn-group">
    <input type="radio" id="current" name="accounttype" value="current" placeholder ="Current">
    <label for="accounttype">Current</label>
     <br>      
    <input type="radio" id="saving" name="accounttype" value="saving" placeholder ="Saving" >
    <label for="accounttype">Saving</label>
    </div>
    </div>
    <div class="grid-item">
      <label for="cancel_cheque">Cancel Cheque</label> <!-- corrected name -->
      <input type="file" id="cancel_cheque" name="cancel_cheque" accept=".pdf, .doc, .docx" required> <!-- corrected name -->
  
    </div>
    <div class="grid-item">
      <label for="ifsc_code">IFSC Code</label> <!-- corrected name -->
      <input type="text" id="ifsc_code" name="ifsc_code" required> <!-- corrected name -->
    </div>
  </div>
</div>

<!-- ====================================KYC FORM -==================----------- -->
<div class="account-section">
  <h3> KYC Details</h3>
  <div class="grid-container">
<div class="grid-item">
      <label for="totalGst">Total GST</label>
      <input type="number" id="totalGst" name="totalGst">
    </div>
    <div class="grid-item">
      <label for="gst1">GST1</label>
      <input type="file" id="gst1" name="gst1" accept=".pdf, .doc, .docx" >
    </div>
    <div class="grid-item">
      <label for="gst2">GST2</label>
      <input type="file" id="gst2" name="gst2" accept=".pdf, .doc, .docx" >
    </div>
    <div class="grid-item">
      <label for="gst3">GST3</label>
      <input type="file" id="gst3" name="gst3" accept=".pdf, .doc, .docx" >
    </div>
    <div class="grid-item">
      <label for="coi">COI</label>
      <input type="file" id="coi" name="coi" accept=".pdf, .doc, .docx" required>
    </div>
    <div class="grid-item">
      <label for="pan">PAN:</label>
      <input type="file" id="pan" name="pan" accept=".pdf, .doc, .docx" required>
    </div>
    <div class="grid-item">
      <label for="license">License:</label>
      <input type="file" id="license" name="license" accept=".pdf, .doc, .docx" required>
    </div>
    <div class="grid-item">
      <label for="other">Others:</label>
      <input type="file" id="other" name="other" accept=".pdf, .doc, .docx" >
    </div>
  </div>
</div>

<!--------==================CONTACT Details=====================================-->    
<div class="contact-section">
<h3> Contact Details</h3>
<div class="grid-container">
<div class="grid-item">
  <label for="ownerdesig">Owner:</label>
  <input type="text" id="ownername" name="ownername" placeholder="Name" required>
</div>
<div class="grid-item">
  <input type="text" id="ownercontact" name="ownercontact" placeholder="Contact" required>
</div>
<div class="grid-item">
  <input type="text" id="owneremail" name="owneremail" placeholder="email" required>
</div>

<div class="grid-item">
  <label for="accountdesig">Account:</label>
  <input type="text" id="account_name" name="account_name" placeholder="Name" required>
</div>
<div class="grid-item">
  <input type="text" id="accountcontact" name="accountcontact" placeholder="Contact" required>
</div>
<div class="grid-item">
  <input type="text" id="accountemail" name="accountemail" placeholder="email" required>
</div>
<div class="grid-item">
  <label for="fielddesig">Feild Team:</label>
  <input type="text" id="fieldname" name="fieldname" placeholder="Name" required>
</div>
<div class="grid-item">
  <input type="text" id="fieldcontact" name="fieldcontact" placeholder="Contact" required>
</div>
<div class="grid-item">
  <input type="text" id="fieldemail" name="fieldemail" placeholder="email" required>
</div>
<div class="grid-item">
  <label for="desig">Others:</label>
  <input type="text" id="nam" name="nam" placeholder="Name" required>
</div>
<div class="grid-item">
  <input type="text" id="contact" name="contact" placeholder="Contact" required>
</div>
<div class="grid-item">
  <input type="text" id="email" name="email" placeholder="email" required>
</div>

<div class = "database">
<a href="data.php">Customer Database</a>
</div>

<div class="button-container">
  <button type="submit" name="submit">Submit</button>
</div>
</form>
</div>
</body>
</html>
