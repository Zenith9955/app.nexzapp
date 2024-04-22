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
 background-color: #f5f5f5;
}

.box {
  max-width: 1300px;
  margin: 150px auto;
  border-radius: 5px;
  padding: 30px;
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
  text-align: center;
  margin-top: 20px;
}

.button-container button {
  padding: 10px 50px;
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
    $cancel_chequePath = isset($_FILES['cancel_cheque']) ? uploadFile($_FILES['cancel_cheque']) : '';
    $gst1Path = isset($_FILES['gst1']) ? uploadFile($_FILES['gst1']) : '';
    $gst2Path = isset($_FILES['gst2']) ? uploadFile($_FILES['gst2']) : '';
    $gst3Path = isset($_FILES['gst3']) ? uploadFile($_FILES['gst3']) : '';
    $coiPath = isset($_FILES['coi']) ? uploadFile($_FILES['coi']) : '';
    $panPath = isset($_FILES['pan']) ? uploadFile($_FILES['pan']) : '';
    $licensePath = isset($_FILES['license']) ? uploadFile($_FILES['license']) : '';
    $otherPath = isset($_FILES['other']) ? uploadFile($_FILES['other']) : '';
    

    if ($agreementPath !== false && $othersPath !== false && $cancel_chequePath !== false && $gst1Path !== false && $gst2Path !== false && $gst3Path !== false && $coiPath !== false && $panPath !== false && $licensePath !== false && $otherPath !== false && $name !== '' && $address !== '' /* Add conditions for other required fields */) {
      // Prepare SQL statement
      $sql = "INSERT INTO vendor (name, address, start, expire, bank_name, branch, accountname, accountnumber, accounttype, ifsc_code, ownerdesig, ownername, ownercontact, owneremail, accountdesig, account_name, accountcontact, accountemail, fielddesig, fieldname, fieldcontact, fieldemail, desig, nam, contact, email, totalGst, agreement, others, cancel_cheque, gst1, gst2, gst3, coi, pan, license, other) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
  
      if (mysqli_stmt_prepare($stmt, $sql)) {
          // Bind parameters and execute statement
          mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssss", 
          $name, $address, $start, $expire, $bank_name, $branch, $accountname, $accountnumber, $accounttype, $ifsc_code, $ownerdesig, $ownername, $ownercontact, $owneremail, $accountdesig, $account_name, $accountcontact, $accountemail, $fielddesig, $fieldname, $fieldcontact, $fieldemail, $desig, $nam, $contact, $email, $totalGst, $agreementPath, $othersPath, $cancel_chequePath, $gst1Path, $gst2Path, $gst3Path, $coiPath, $panPath, $licensePath, $otherPath);
          
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'>Upload successful</div>";
      } else {
          echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
      }
  } else {
      echo "<div class='alert alert-danger'>File upload failed or required fields were not filled.</div>";
  }
}
?>  



  <!---------------------===========DATABASE PHP END===================--------------->

      <h1>Vendor Form</h1>

      <div class="grid-container">
        <div class="grid-item">
          <label for="name">Vendor Name:</label>
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
            <input type="file" id="others" name="others" accept=".pdf, .doc, .docx" required>
          </div>
        <div class="grid-item">
          <label for="start">Agreement Start Date:</label>
          <input type="date" id="start" name="start" required>
        </div>
        <div class="grid-item">
          <label for="expire">Agreement Expire Date:</label>
          <input type="date" id="expire" name="expire" required>
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
    <select id="accounttype" name="accounttype" onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose Account Type</option>
        <option value="current">Current</option>
        <option value="saving">Saving</option>
    </select>
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
    <div class="kyc-section">
        <h3> KYC Details</h3>
        <div class="grid-container">
        <div class="grid-item">
            <label for="totalGst">GST:</label>
      <select id="totalGst" name="totalGst" onchange="showGstInputs()">
          <option value="0">Select Total GST Users</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <!-- Add more options as needed -->
      </select>
      <div id="gstInputsContainer"></div>
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
            <input type="file" id="other" name="other" accept=".pdf, .doc, .docx" required>
          </div>
        </div>
    </div>
    <!------=======================Script JAVE=============================--->

    <script>


        function showGstInputs() {
            var totalGst = document.getElementById("totalGst").value;
            var gstInputsContainer = document.getElementById("gstInputsContainer");
        
            // Clear existing inputs
            gstInputsContainer.innerHTML = "";
        
            // Add GST input fields based on totalGst selection
            for (var i = 1; i <= totalGst; i++) {
                var label = document.createElement("label");
                label.textContent = "GST " + i + ":";
        
                var input = document.createElement("input");
                input.type = "file";
                input.name = "gst_user_" + i;
                input.accept = ".pdf, .doc, .docx"; // specify accepted file types
                input.required = true;
        
                gstInputsContainer.appendChild(label);
                gstInputsContainer.appendChild(input);
                gstInputsContainer.appendChild(document.createElement("br"));
            }
        }
        </script>
  <!------=======================Script JAVE END=============================--->

<!--------==================CONTACT Details=====================================-->    
<div class="contact-section">
    <h3> Contact Details</h3>
    <div class="grid-container">
    <div class="grid-item">
        <label for="ownerdesig">Owner:</label>
        <input type="text" id="ownerdesig" name="ownerdesig" placeholder ="Designation" required>
      </div>
      <div class="grid-item">
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
        <input type="text" id="accountdesig" name="accountdesig" placeholder ="Designation" required>
      </div>
      <div class="grid-item">
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
        <input type="text" id="fielddesig" name="fielddesig" placeholder ="Designation" required>
      </div>
      <div class="grid-item">
        <input type="text" id="fieldname" name="fieldname" placeholder="Name" required>
      </div>
      <div class="grid-item">
        <input type="text" id="fieldcontact" name="fieldcontact" placeholder="Contact" required>
      </div>
      <div class="grid-item">
        <input type="text" id="fieldemail" name="fieldemail" placeholder="email" required>
      </div>
      <div class="grid-item">
        <label for="desig">Owner:</label>
        <input type="text" id="desig" name="desig" placeholder ="Designation" required>
      </div>
      <div class="grid-item">
        <input type="text" id="nam" name="nam" placeholder="Name" required>
      </div>
      <div class="grid-item">
        <input type="text" id="contact" name="contact" placeholder="Contact" required>
      </div>
      <div class="grid-item">
        <input type="text" id="email" name="email" placeholder="email" required>
      </div>
      
      <div class = "database">
      <a href="vendordata.php">Vendor Database</a>
      </div>
      <div class="button-container">
        <button type="submit" name="submit">Submit</button>
        
      </div>
    </form>
  </div>
</body>
</html>
