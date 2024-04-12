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
  
  
  <form action = "" method="post" >
      <label for="totalGst">GST:</label>
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
      <label for="liscence">Liscence:</label>
      <input type="file" id="liscence" name="liscence" accept=".pdf, .doc, .docx" required>

    <label for="others">Others:</label>
      <input type="file" id="others" name="others" accept=".pdf, .doc, .docx" required>
    <button type="submit" name = "submit">Submit</button>
</form>


</body>
</html>

<!----------====================SCRIPT+==========================-->
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
