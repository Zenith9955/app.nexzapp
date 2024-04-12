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
 
  <h1>Contact Form</h1>
  
    <h4>Owner</h4>
    <input type="text"  name="designation" placeholder ="Designation" required>
    <input type="text"  name="Name" placeholder ="Name"required>
    <input type="text"  name="contact" placeholder ="Contact Number"required>
    <input type="text"  name="email" placeholder ="Email" required>

    <h4>Account</h4>
    <input type="text"  name="designation" placeholder ="Designation" required>
    <input type="text"  name="Name" placeholder ="Name"required>
    <input type="text"  name="contact" placeholder ="Contact Number"required>
    <input type="text"  name="email" placeholder ="Email" required>

    <h4>Feild Team</h4>
    <input type="text"  name="designation" placeholder ="Designation" required>
    <input type="text"  name="Name" placeholder ="Name"required>
    <input type="text"  name="contact" placeholder ="Contact Number"required>
    <input type="text"  name="email" placeholder ="Email" required>

    <h4>?</h4>
    <input type="text"  name="designation" placeholder ="Designation" required>
    <input type="text"  name="Name" placeholder ="Name"required>
    <input type="text"  name="contact" placeholder ="Contact Number"required>
    <input type="text"  name="email" placeholder ="Email" required>

    <button type="submit" name="submit">Submit</button>
</form>


</body>
</html>
