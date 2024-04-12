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
<style>
   a {
    color: #333; 
    text-decoration: none; 
    padding: 5px 10px; 
    background-color: #fff; 
  }
  
  a:hover {
    background-color: #e0e0e0; 
    color: #000; 
  }
  </style>

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
  
  
  <form action="" method="post" enctype="multipart/form-data">
  <?php
if (isset($_POST['submit'])) {
    require_once "masterdatabase.php";

    // Text inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $expire = mysqli_real_escape_string($conn, $_POST['expire']);

    // File uploads
    $agreement = $_FILES['agreement'];
    $others = $_FILES['others'];

    // Assuming you have functions to handle file validation and upload:
    // uploadFile() should handle the actual upload process including validation
    // and return the path to the stored file or false on failure.
    $agreementPath = uploadFile($agreement);
    $othersPath = uploadFile($others);

    if ($agreementPath !== false && $othersPath !== false) {
        $sql = "INSERT INTO customer (name, address, agreement, start, expire, others) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $address, $agreementPath, $start, $expire, $othersPath);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Upload successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>File upload failed.</div>";
    }
}

function uploadFile($file) {
    $uploadDirectory = "uploads/"; // Ensure this directory exists and is writable
    $fileName = basename($file['name']);
    $targetFilePath = $uploadDirectory . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

    // Validate file type here if needed
    // Move the file to your server
    if(move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $targetFilePath; // Return the path where the file is saved
    }

    return false; // Return false if upload failed
}
?>

    <h1>Customer Form</h1>
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <br>
    <label for="FileType">Details</label>
    <select id="FileType" name="FileType" onchange="redirectToPage(this)">
        <option value="none" selected disabled hidden>Choose File Type</option>
        <option value="kyc.php">Kyc</option>
        <option value="acc.php">Account</option>
        <option value="contact.php">Contact</option>
    </select>

    <br>
    <label for="agreement">Agreement:</label>
    <input type="file" id="agreement" name="agreement" accept=".pdf, .doc, .docx" required>
    <br>
    <br>
    <label for="start">Agreement Start Date:</label>
    <input type="date" id="start" name="start" required>
    <br>  
    <br>
    <label for="expire">Agreement Expire Date:</label>
    <input type="date" id="expire" name="expire" required>
    <br>

    <label for="others">Others:</label>
    <input type="file" id="others" name="others" accept=".pdf, .doc, .docx" required>
    <button type="submit" name="submit">Submit</button>

    <a href="data.php">Customer Database</a>
</form>

</body>
</html>

<!----------====================SCRIPT+==========================-->
<script>
     function redirectToPage(select) {
            var selectedValue = select.value;
            if (selectedValue !== "none") {
                window.location.href = selectedValue;
            }
        }
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
