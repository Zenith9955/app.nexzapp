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
</head>
<!-------------------CSS START----------------------------------------->
<style>
     body {
 background-color: #fff;
 margin: 0;
 font-family: Arial, sans-serif; 
}
h1,h2,h3,h4,h5,h6{
color: #4b4b4b;
}
h1{
font-size: 35px;
margin: 40px;
padding: 10px;

}
  header {
background-color: #ffffff;
color: #333; /* Dark gray */
padding: 10px;
display: flex;
align-items: center;
justify-content: space-between;
width: 100%;
position: fixed;
top: 0;
z-index: 1000; /* Ensure header is above other content */
transition: top 0.3s; /* Smooth transition when scrolling */
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow */
}

.logo img {
height: 90px; /* Adjusted logo size */
}

/* Main content padding to prevent content from being hidden behind fixed header */
main {
padding-top: 90px; /* Adjust to match header height */

}

/* Navigation styles */
nav ul {
list-style: none;
padding: 0;
margin: 0;
}

nav ul li {
display: inline-block;
}

nav ul li a {
color: #333; /* Dark gray */
text-decoration: none;
padding: 15px 25px; /* Reduced padding */
display: block;
transition: background-color 0.3s; /* Smooth hover effect */
}

nav ul li a:hover {
background-color: #e0e0e0; /* Lighter gray on hover */
}

/* Dropdown styles */
.dropdown:hover .dropdown-content {
display: block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9; /* Light gray */
min-width: 200px;
z-index: 1;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
/* 3D Scroll Effect */
transform: translateZ(0);
perspective: 1000px;
overflow-y: auto;
max-height: 200px; /* Adjust as needed */
}

.dropdown-content a {
color: #333; /* Dark gray */
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {
background-color: #e0e0e0; /* Lighter gray on hover */
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown button {
background-color: #ababab; /* Green background */
color: white; /* White text color */
border: none; /* No border */
padding: 5px 10px; /* Padding */
text-align: center; /* Center text */
text-decoration: none; /* No underline */
display: inline-block;
font-size: 14px; /* Font size */
cursor: pointer; /* Cursor on hover */
border-radius: 4px; /* Rounded corners */
}

.dropdown button:hover {
background-color: #333; /* Darker green background on hover */
}

/* CSS for the Sign Out link */
a.signout-link {
color: #333; /* Dark gray text color */
text-decoration: none; /* Remove underline */
padding: 10px 20px; /* Add padding */
border: 1px solid #333; /* Add border */
border-radius: 4px; /* Add rounded corners */
background-color: #fff; /* White background */
}

a.signout-link:hover {
background-color: #e0e0e0; /* Light gray background on hover */
color: #000; /* Darken text color on hover */
}

/* Add a class for when the header is scrolled */
header.scrolled {
top: -90px; /* Negative header height to hide */
}


  
    .box {
        max-width: 1300px;
        margin: 150px auto; /* Add space around the container */
        box-shadow: 0px 5px 2px rgba(0, 0, 0, 0.2); /* Adding box shadow */
        border-radius: 5px; /* Adding border radius for rounded corners */
        padding: 30px; 
        /* Adding padding inside the box */
      }
      
      .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px; /* Add space between grid items */
      }
      
      .grid-item {
        display: flex;
        flex-direction: row; /* Display label and input in a row */
        align-items: center; /* Align items vertically */
      }
  
      /* Apply styles to form labels */
      label {
        margin-right: 10px; /* Add space between label and input */
      }
      
      /* Apply styles to form inputs */
      input[type="text"],
    input[type="date"],
    select,
    input[type="file"] {
      width: 100%;
      padding: 5px; /* Increase padding for better spacing */
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 0px;
    }
      /* Button styling */
      .button-container {
        text-align: center; /* Center the button horizontally */
        margin-top: 20px;
        padding: 5px 30px 10px 200px;/* Add space between form fields and button */
    }
    
    .button-container button {
        padding: 10px 50px; /* Add padding to the button */ 
        background-color: #007bff; /* Blue color for button */
        color: #fff; /* White text color */
        border: none; /* Remove button border */
        border-radius: 30px; /* Rounded corners */
        cursor: pointer; /* Cursor style on hover */
        transition: background-color 0.3s; /* Smooth transition for background color */
        margin: 0 auto; /* Center the button horizontally */
    }
    .button-container button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

      /* Add space between sections */
      .account-section {
        margin-top: 30px;
      }
      .kyc-section{
        margin-top: 30px;
      }
      .contact-section {
        margin-top: 30px; /* Add space between sections */
    }
  

    .database {
  padding: 2px; /* Padding */
  border-radius: 5px; /* Rounded corners */
  display: inline-block; /* Display as inline block */
}

.database a {
  text-decoration: none; /* Remove underline */
  color: #777; /* Dark gray text color */
  font-weight: bold; /* Bold text */
}

.database a:hover {
  color: #333; 
}
h1{
  text-align: center;
  margin-top: 15px;
  padding: 0px;
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
          <a href="darkfiberdata.php">Dark Fiber</a>
            <a href="#">Internet</a>
            <a href="#">Bandwidth</a>
            <a href="#">Leased Line</a>
            <a href="#">Infra</a>
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
          <a href="projectdata.php">Project Tracker</a>
          <a href="linkdata.php">Implement Tracker</a>
            <a href="tracker1.php">Tracker 1</a>
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

        <h1>Tracker 1</h1>

        <div class="grid-container">
            <div class="grid-item">
                <label for="name">Customer Name:</label>
                <select id="name" name="name" required>
                    <option value="" selected disabled>Select Customer Name</option>
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
                <label for="endA">End A:</label>
                <input type="text" id="endA" name="endA" required>
            </div>
            <div class="grid-item">
                <label for="endB">End B:</label>
                <input type="text" id="endB" name="endB" required>
            </div>
            <div class="grid-item">
                <label for="po">Po Number</label>
                <input type="text" id="po" name="po" required>
            </div>
            <div class="grid-item">
                <label for="podate">Po Date:</label>
                <input type="date" id="podate" name="podate" required>
            </div>
            <div class="grid-item">
                <label for="podis">Po Distance(In Km):</label>
                <input type="text" id="podis" name="podis" required>
            </div>
            <div class="grid-item">
                <label for="fibertype">Fiber Type</label>
                <select id="fibertype" name="fibertype" required>
                    <option value="none" selected disabled hidden>Choose Fiber Type</option>
                    <option value="single">Single Core</option>
                    <option value="pair">Pair</option>
                </select>
            </div>
            <div class="grid-item">
                <label for="otdr">OTDR Length:</label>
                <input type="text" id="otdr" name="otdr" required>
            </div>
            <div class="grid-item">
                <label for="overall">Overall Losses:</label>
                <input type="text" id="overall" name="overall" required>
            </div>
            <div class="grid-item">
                <label for="handover">Handover Date:</label>
                <input type="date" id="handover" name="handover" required>
            </div>
            <div class="grid-item">
                <label for="recurring">Recurring Charges:</label>
                <input type="text" id="recurring" name="recurring" required>
            </div>
            <div class="grid-item">
                <label for="monthly">Monthly Charges:</label>
                <input type="text" id="monthly" name="monthly" required>
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
                <label for="remarks">Remarks:</label>
                <input type="text" id="remarks" name="remarks" required>
            </div>
        </div>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>

<?php
if (isset($_POST["submit"])) {
    // Establish a database connection
    require_once "masterdatabase.php";

    $name = $_POST["name"];
    $endA = $_POST["endA"];
    $endB = $_POST["endB"];
    $po = $_POST["po"];
    $podate = $_POST["podate"];
    $podis = $_POST["podis"];
    $fibertype = $_POST["fibertype"];
    $otdr = $_POST["otdr"];
    $overall = $_POST["overall"];
    $handover = $_POST["handover"];
    $recurring = $_POST["recurring"];
    $monthly = $_POST["monthly"];
    $status = $_POST["status"];
    $disconnection = isset($_POST["disconnection"]) ? $_POST["disconnection"] : null;
    $remarks = $_POST["remarks"];

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO tracker1 (name, endA, endB, po, podate, podis, fibertype, otdr, overall, handover, recurring, monthly, status, disconnection, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssss", $name, $endA, $endB, $po, $podate, $podis, $fibertype, $otdr, $overall, $handover, $recurring, $monthly, $status, $disconnection, $remarks);

    // Check if the statement executed successfully
    if ($stmt->execute()) {
        echo "<script>alert('Data Inserted Successfully')</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

  </div>
</body>
</html>
