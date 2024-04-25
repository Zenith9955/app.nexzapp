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
 background-color: #fff;
}

.box {
  max-width: 1300px;
  margin: 100px auto;
  border-radius: 5px;
  padding: 50px;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
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
  text-align: right;
  margin-top: 20px;
  margin-bottom: 20px;
}

.button-container button {
  padding: 10px 50px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  transition: background-color 0.3s;
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
  margin-top: 5px;
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
            <a href="implement.php">New-Links</a>
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

    $customername = isset($_POST['customername']) ? sanitize_input($conn, $_POST['customername']) : '';
    $feasibility = isset($_POST['feasibility']) ? sanitize_input($conn, $_POST['feasibility']) : '';
    $status = isset($_POST['status']) ? sanitize_input($conn, $_POST['status']) : '';
    $disconnection = isset($_POST['disconnection']) ? sanitize_input($conn, $_POST['disconnection']) : '';
    $podate = isset($_POST['podate']) ? sanitize_input($conn, $_POST['podate']) : '';
    $ponumber = isset($_POST['ponumber']) ? sanitize_input($conn, $_POST['ponumber']) : '';
    $expire = isset($_POST['expire']) ? sanitize_input($conn, $_POST['expire']) : '';
    $contactname = isset($_POST['contactname']) ? sanitize_input($conn, $_POST['contactname']) : '';
    $contactnub = isset($_POST['contactnub']) ? sanitize_input($conn, $_POST['contactnub']) : '';
    $contactmail = isset($_POST['contactmail']) ? sanitize_input($conn, $_POST['contactmail']) : '';
    $fibertype = isset($_POST['fibertype']) ? sanitize_input($conn, $_POST['fibertype']) : '';
    $endA = isset($_POST['endA']) ? sanitize_input($conn, $_POST['endA']) : '';
    $endAlatlong = isset($_POST['endAlatlong']) ? sanitize_input($conn, $_POST['endAlatlong']) : '';
    $endB = isset($_POST['endB']) ? sanitize_input($conn, $_POST['endB']) : '';
    $endBlatlong = isset($_POST['endBlatlong']) ? sanitize_input($conn, $_POST['endBlatlong']) : '';
    $podistance = isset($_POST['podistance']) ? sanitize_input($conn, $_POST['podistance']) : '';
    $vendorname = isset($_POST['vendorname']) ? sanitize_input($conn, $_POST['vendorname']) : '';
    $partnername = isset($_POST['partnername']) ? sanitize_input($conn, $_POST['partnername']) : '';
    $partnernumber = isset($_POST['partnernumber']) ? sanitize_input($conn, $_POST['partnernumber']) : '';
    $partnermail = isset($_POST['partnermail']) ? sanitize_input($conn, $_POST['partnermail']) : '';
    $handoverto = isset($_POST['handoverto']) ? sanitize_input($conn, $_POST['handoverto']) : '';
    $handoverby = isset($_POST['handoverby']) ? sanitize_input($conn, $_POST['handoverby']) : '';
    $deliverystatus = isset($_POST['deliverystatus']) ? sanitize_input($conn, $_POST['deliverystatus']) : '';
    $projectend = isset($_POST['projectend']) ? sanitize_input($conn, $_POST['projectend']) : '';
    $ageingdays = isset($_POST['ageingdays']) ? sanitize_input($conn, $_POST['ageingdays']) : '';
    $acceptancedate = isset($_POST['acceptancedate']) ? sanitize_input($conn, $_POST['acceptancedate']) : '';
    $remarks = isset($_POST['remarks']) ? sanitize_input($conn, $_POST['remarks']) : '';




    // file Uploads
    $otdrdlsPath = isset($_FILES['otdrdls']) ? uploadFile($_FILES['otdrdls']) : '';

    // Prepare SQL statement
    $sql = "INSERT INTO Implementation (customername, feasibility, status, disconnection, podate, ponumber, expire, contactname, contactnub, contactmail, fibertype, endA, endAlatlong, endB, endBlatlong, podistance, vendorname, partnername, partnernumber, partnermail, otdrdls, handoverto, handoverby, deliverystatus, projectend, ageingdays, acceptancedate, remarks)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters and execute statement
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssss", 
        $customername, $feasibility, $status, $disconnection, $podate, $ponumber,  $expire, $contactname, $contactnub, $contactmail, $fibertype, $endA, $endAlatlong, $endB, $endBlatlong, $podistance, $vendorname, $partnername, $partnernumber, $partnermail, $otdrdlsPath, $handoverto, $handoverby, $deliverystatus, $projectend, $ageingdays, $acceptancedate, $remarks);

        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>Upload successful</div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
    }
}
?>
  <!---------------------===========DATABASE PHP END===================--------------->

      <h1>Implementation Form</h1>

      <div class="grid-container">
            <div class="grid-item">
                <label for="customername">Customer Name:</label>
                <select id="customername" name="customername" required>
                    <option value="" selected disabled>Select Customers Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM customers";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
            </div>
            <div class="grid-item">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="none" selected disabled hidden>Choose Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="grid-item">
                <label for="disconnection">Disconnection Date</label>
                <input type="date" id="disconnection" name="disconnection">
            </div>
        <div class="grid-item">
          <label for="feasibility">Feasibility ID:</label>
          <input type="text" id="feasibility" name="feasibility" required>
        </div>
        <div class="grid-item">
          <label for="ponumber">Po Number:</label>
          <input type="text" id="ponumber" name="ponumber" required>
        </div>
        <div class="grid-item">
          <label for="podate">PO Date:</label>
          <input type="date" id="podate" name="podate" required>
        </div>
        <div class="grid-item">
            <label for="expire">Po Expire Date:</label>
            <input type="date" id="expire" name="expire" >
          </div>
        <div class="grid-item">
          <label for="contactname">Contact Name:</label>
          <input type="text" id="contactname" name="contactname" required>
        </div>
        <div class="grid-item">
          <label for="contactnub">Contact Number:</label>
          <input type="text" id="contactnub" name="contactnub" required>
        </div>
        <div class="grid-item">
          <label for="Contactmail">Contact Mail:</label>
          <input type="text" id="Contactmail" name="contactmail" required >
        </div>
        <div class="grid-item">
        <label for="fibertype">Fiber Type</label>
    <select id="fibertype" name="fibertype" onchange="toggleForm()">
        <option value="none" selected disabled hidden>Choose fiber type</option>
        <option value="Single">Single</option>
        <option value="Pair">Pair</option>
    </select>
          </div>
          <div class="grid-item">
          <label for="endA">End A:</label>
          <input type="text" id="endA" name="endA" required>
        </div>
        <div class="grid-item">
          <label for="endAlatlong">End A Latlong:</label>
         <input type="text" id="endAlatlong" name="endAlatlong" required>
        </div>
        <div class="grid-item">
          <label for="endB">End B:</label>
          <input type="text" id="endB" name="endB" required>
        </div>
        <div class="grid-item">
          <label for="endBlatlong">End B Latlong:</label>
          <input type="text" id="endBlatlong" name="endBlatlong" required>
        </div>
        <div class="grid-item">
          <label for="podistance">Po Distance:</label>
          <input type="text" id="podistance" name="podistance" required>
        </div>
            <div class="grid-item">
                <label for="vendorname">Partner:</label>
                <select id="vendorname" name="vendorname" required>
                    <option value="" selected disabled>Select Vendor Name</option>
                    <?php
                    // Establish a database connection (you'll need your actual database credentials here)
                    require_once "masterdatabase.php";
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get customer names
                    $sql = "SELECT name FROM vendor";
                    $result = $conn->query($sql);

                    // Loop through results and create options for the dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    }

                    // Close customer name query
                    $result->close();
                    ?>
                </select>
            </div>
        <div class="grid-item">
          <label for="partnername">Partner Name:</label>
          <input type="text" id="partnername" name="partnername" required>
        </div>
        <div class="grid-item">
          <label for="partnernumber">Partner Number:</label>
          <input type="text" id="partnernumber" name="partnernumber" required>
        </div>
        <div class="grid-item">
          <label for="partnermail">Partner Mail:</label>
          <input type="text" id="partnermail" name="partnermail" required>
        </div>
        <div class="grid-item">
          <label for="otdrdls">OTDR DLS:</label>
          <input type="file" id="otdrdls" name="otdrdls" accept=".pdf, .doc, .docx" >
        </div>
        <div class="grid-item">
          <label for="otdr">OTDR Length:</label>
          <input type="text" id="otdr" name="otdr" required >
        </div>
        <div class="grid-item">
          <label for="handoverto">Handover To:</label>
          <input type="text" id="handoverto" name="handoverto" required>
        </div>
        <div class="grid-item">
          <label for="handoverby">Handover By:</label>
          <input type="text" id="handoverby" name="handoverby" required>
        </div>
        <div class="grid-item">
  <label for="deliverystatus">Delivery Status</label>
  <select id="deliverystatus" name="deliverystatus" onchange="toggleForm()">
    <option value="none" selected disabled hidden>Choose delivery status</option>
    <option value="wip">WIP</option>
    <option value="acceptancepending">Acceptance Pending</option>
    <option value="billingpending">Billing Pending</option>
    <option value="complete">Complete</option>
  </select>
</div>
<div class="grid-item" id="projectEndDateDiv" style="display: none;">
  <label for="projectend">Project End Date:</label>
  <input type="Date" id="projectend" name="projectend">
</div>
<div class="grid-item" id="ageingDaysDiv" style="display: none;">
  <label for="ageingdays">Ageing Days:</label>
  <input type="Date" id="ageingdays" name="ageingdays">
</div>
<div class="grid-item" id="acceptanceDateDiv" style="display: none;">
  <label for="acceptancedate">Acceptance Date:</label>
  <input type="Date" id="acceptancedate" name="acceptancedate" >
</div>

<script>
function toggleForm() {
  var deliverystatus = document.getElementById("deliverystatus").value;
  var projectEndDateDiv = document.getElementById("projectEndDateDiv");
  var ageingDaysDiv = document.getElementById("ageingDaysDiv");
  var acceptanceDateDiv = document.getElementById("acceptanceDateDiv");

  if (deliverystatus === "wip") {
    projectEndDateDiv.style.display = "block";
    ageingDaysDiv.style.display = "block";
    acceptanceDateDiv.style.display = "none";
  } else if (deliverystatus === "acceptancepending") {
    projectEndDateDiv.style.display = "none";
    ageingDaysDiv.style.display = "none";
    acceptanceDateDiv.style.display = "block";
  } else {
    projectEndDateDiv.style.display = "none";
    ageingDaysDiv.style.display = "none";
    acceptanceDateDiv.style.display = "block";
  }
}
</script>

        <div class="grid-item">
          <label for="remarks">Remarks:</label>
          <input type="text" id="remarks" name="remarks" >
        </div>
        <div class="button-container">
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>
