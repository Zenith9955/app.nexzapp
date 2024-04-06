<?php
session_start();
if (isset($_SESSION['user'])) {
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
  
  
  <form id="custform" method="post" >
    <h1>Customer Form</h1>
    <label for="CustomerName">Customer Name:</label>
    <input type="text" id="CustomerName" name="CustomerName" required>
    <br>
    <label for="Address">Address:</label>
    <input type="text" id="Address" name="Address" required>
    <br>
    <label for="Agreement">Agreement:</label>
    <input type="file" id="Agreement" name="Agreement" accept=".pdf, .doc, .docx" required>
    <br>
    <label for="AgreementDate">Agreement Date:</label>
    <input type="date" id="AgreementDate" name="AgreementDate" required>
    <br>
    <label for="ExpireDate">Agreement Expire Date:</label>
    <input type="date" id="ExpireDate" name="ExpireDate" required>
    <br>
    <label for="FileType">KYC/BILLING</label>
    <select id="FileType" name="FileType" onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose File Type</option>
        <option value="kyc">KYC</option>
        <option value="billing">Billing</option>
    </select>
    <br>
    <div id="kyc-form" style="display: none;">
      <label for="totalGst">Total GST:</label>
      <select id="totalGst" name="totalGst" onchange="showGstInputs()">
          <option value="0">Select Total GST Users</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <!-- Add more options as needed -->
      </select>
      <div id="gstInputsContainer"></div>
      

      <label for="coi">COI</label>
      <input type="file" id="coi" name="coi" accept=".pdf, .doc, .docx" required>

      <label for="pan">PAN:</label>
      <input type="file" id="pan" name="pan" accept=".pdf, .doc, .docx" required>
    </div>
    <div id="billing-form" style="display: none;">
        <!-- Billing Form Fields -->
        <!-- You can add your Billing form fields here -->
    </div>
    <button type="submit">Submit</button>
</form>


</body>
</html>


<!----------====================SCRIPT+==========================-->
<script>
  function toggleForm() {
      var fileType = document.getElementById("FileType").value;
      var kycForm = document.getElementById("kyc-form");
      var billingForm = document.getElementById("billing-form");

      if (fileType === "kyc") {
          kycForm.style.display = "block";
          billingForm.style.display = "none";
      } else if (fileType === "billing") {
          kycForm.style.display = "none";
          billingForm.style.display = "block";
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






  