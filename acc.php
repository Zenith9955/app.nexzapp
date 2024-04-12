<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit(); // Add exit() after redirection to stop further execution
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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    require_once "masterdatabase.php";

    // Text inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $accountname = mysqli_real_escape_string($conn, $_POST['accountname']);
    $accountnumber = mysqli_real_escape_string($conn, $_POST['account_number']); // corrected name
    $accounttype = mysqli_real_escape_string($conn, $_POST['accounttype']);
    $ifsccode = mysqli_real_escape_string($conn, $_POST['ifsc_code']); // corrected name

    $cancelcheque = $_FILES['cancel_cheque']; // corrected name

    // and return the path to the stored file or false on failure.
    $cancelchequePath = uploadFile($cancelcheque); // corrected variable name

    if ($cancelchequePath !== false) {
        $sql = "INSERT INTO accounts (name, branch, accountname, accountnumber, accounttype, Cancelcheque, ifsccode) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $branch, $accountname, $accountnumber, $accounttype, $cancelchequePath, $ifsccode); // corrected variable name
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
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate file type here if needed
    // Move the file to your server
    if(move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $targetFilePath; // Return the path where the file is saved
    }

    return false; // Return false if upload failed
}
?>


    <label for="name">Bank Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="branch">Branch</label>
    <input type="text" id="branch" name="branch" required>

    <label for="accountname">Account Name</label>
    <input type="text" id="accountname" name="accountname" required>

    <label for="accountnumber">Account Number</label>
    <input type="text" id="accountnumber" name="account_number" required>

    <label for="accounttype">Account Type</label>
    <select id="accounttype" name="accounttype" onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose Account Type</option>
        <option value="current">Current</option>
        <option value="saving">Saving</option>
    </select>

    <label for="cancel_cheque">Cancel Cheque</label> <!-- corrected name -->
    <input type="file" id="cancel_cheque" name="cancel_cheque" accept=".pdf, .doc, .docx" required> <!-- corrected name -->

    <label for="ifsc_code">IFSC Code</label> <!-- corrected name -->
    <input type="text" id="ifsc_code" name="ifsc_code" required> <!-- corrected name -->

    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>