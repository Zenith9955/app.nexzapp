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
            <a href="">Vendor</a>
            <a href="custform.php">Customer</a>
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

  <!---========================VENDOR FORMS============================================-->
    
  <form action="/venform/" method="post">
    <h1>Vendor Form</h1>
    <label for="Name">Name:</label>
    <input type="text" id="Name" name="Name" required>
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
    <br>
    <label for="Others">Others:</label>
    <input type="file" id="Others" name="Others" accept=".pdf, .doc, .docx" required>
    <br>
    
    <button type="submit">Submit</button>
</form>


</body>
</html>
