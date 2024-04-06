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
          <a href="#">Master &#9662;</a>
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
            <a href="vtl.html">Fiber Services</a>
            <a href="#">Port Fiber</a>
          </div>
        </li>
        <a href="logout.php">Sign Out</a>
      </ul>
    </nav>
  </header>
<!------=======================HEADER END==========================================-->


<!--------------===============FORM Master===========================================-->

<form action="/venform/" method="post">
  <h1>Master Form</h1>
  <label for="Name">Name:</label>
  <input type="text" id="Name" name="Name" required>
  <br>
  <label for="gst">GST:</label>
  <input type="file" id="gst" name="gst" accept=".pdf, .doc, .docx" required>
  <br>
  <label for="coi">COI:</label>
  <input type="file" id="coi" name="coi" accept=".pdf, .doc, .docx" required>
  <br>
  <label for="pan">Pan:</label>
  <input type="file" id="coi" name="coi" accept=".pdf, .doc, .docx" required>
  <br>
  <label for="agreement">Agreement:</label>
  <input type="file" id="coi" name="coi" accept=".pdf, .doc, .docx" required>
  <br>
  <br>
  <label for="ExpireDate">Agreement Start Date:</label>
  <input type="date" id="ExpireDate" name="ExpireDate" required>
  <br>  <br>
  <label for="ExpireDate">Agreement Expire Date:</label>
  <input type="date" id="ExpireDate" name="ExpireDate" required>
  <br>
  <br>
  <label for="Others">Others:</label>
  <input type="file" id="Others" name="Others" accept=".pdf, .doc, .docx" required>
  <br>
  
  <a href="#" onclick="toggleForm()">Contact Form &#9662;</a>

  <div id="additionalForm" style="display: none;">
    <h4>Owner</h4>
    <label for="designation">Designation:</label>
    <input type="text" id="designation" name="designation" required>
    <br>
    <label for="contact">Contact No.:</label>
    <input type="text" id="contact" name="contact" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
  </div>
  
  <button type="submit">Submit</button>
</form>

<script>
  function toggleForm() {
    var additionalForm = document.getElementById('additionalForm');
    additionalForm.style.display = (additionalForm.style.display === 'none') ? 'block' : 'none';
  }
</script>
</body>
</html>
