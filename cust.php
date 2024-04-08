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
            <a href="cust.php" >Customer</a>
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
            <a href="vtl.html">Fiber Services</a>
            <a href="#">Port Fiber</a>
          </div>
        </li>
        <a href="logout.php">Sign Out</a>
      </ul>
    </nav>
  </header>

  <!---========================CUSTOMER FORMS============================================-->
  
  
  <form action = "" method="post" >
  <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $agreement = $_POST['agreement'];
        $start = $_POST['start'];
        $expire = $_POST['expire'];
        $others = $_POST['others'];
        
        // Assuming $conn is your database connection
        require_once "masterdatabase.php";
        $sql = "INSERT INTO customer (name, address, agreement, start, expire, others) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $address, $agreement, $start, $expire, $others);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Upload successfully</div>";   
        } else {
            echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
        }
    }
?>

    <h1>Customer Form</h1>
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <br>

  <br>
  <label for="agreement">Agreement:</label>
  <input type="file" id="agreement" name="agreement" accept=".pdf, .doc, .docx" required>
  <br>
  <br>
  <label for="start">Agreement Start Date:</label>
  <input type="date" id="start" name="start" required>
  <br>  <br>
  <label for="expire">Agreement Expire Date:</label>
  <input type="date" id="expire" name="expire" required>
  <br>

    <label for="others">Others:</label>
      <input type="file" id="others" name="others" accept=".pdf, .doc, .docx" required>
    <button type="submit" name = "submit"s>Submit</button>
</form>


</body>
</html>


<!----------====================SCRIPT+==========================-->
<script>
  function toggleForm() {
      var fileType = document.getElementById("FileType").value;
      var kycForm = document.getElementById("kyc-form");
      var billingForm = document.getElementById("billing-form");
      var contactform = document.getElementById("contact-Form");

      if (fileType === "kyc") {
          kycForm.style.display = "block";
          billingForm.style.display = "none";
          contactform.style.display = "none";
      } else if (fileType === "billing") {
          kycForm.style.display = "none";
          billingForm.style.display = "block";
          contactform.style.display = "none";
      } else if (fileType === "contact") {
          kycForm.style.display = "none";
          billingForm.style.display = "none";
          contactform.style.display = "block";
      } else {
          kycForm.style.display = "none";
          billingForm.style.display = "none";
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
          label.textContent = "GST User " + i + ":";

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






  