<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Database</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        main {
            max-width: 100%;
            margin: 120px auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4b4b4b;
            text-align: left;
            font-size: 20px;
            margin-bottom: 0px;
        }

        form {
            display: flex;
            justify-content: left; /* or space-around */
            padding: 15px; /* Decreased padding */
        }

        table {
            width: 100%;
            margin: 9px auto;
            border-collapse: collapse;
            overflow: hidden; /* Ensuring borders are consistent */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 2px; /* Adding border radius for a softer look */
            border: 5px solid #ccc; /* Adding a subtle shadow for depth */
            font-size: 15px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
        }

        table th {
            background-color: #87CEFA;
            color: #656565; /* Text color for table headers */
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9; /* Lighter shade for even rows */
        }

        table tr:hover {
            background-color: #e6e6e6; /* Darker shade on hover for better feedback */
        }

        /* Styling for form elements */
        input[type="text"] {
            padding: 15px; /* Making input and button sizes consistent */
            font-size: 12px;
            border-radius: 2px; /* Adding border radius for a softer look */
            border: 1px solid #ccc; /* Adding a light border for input fields */
        }

        button {
            padding: 10px 10px;
            cursor: pointer;
            background-color: #007bff; /* Adding a primary color for buttons */
            color: #fff; /* Making button text white for better contrast */
            border: none;
            transition: background-color 0.3s ease; /* Adding smooth transition on hover */
        }

        button:hover {
            background-color: #0056b3; /* Darkening button color on hover */
        }

        /* Styling for links */
        a {
            text-decoration: none;
            color: #007bff; /* Using the primary color for links */
        }
 


 .button-container {
            display: flex;
            justify-content: flex-end; /* Aligns button to the right within the container */
        }

        .add-button:hover {
            background-color: #ababab;
            color: white;
        } 
        .grid-container {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.vendor-box,
.po-box, 
.pending-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
}

.status,
.count {
    display: inline-block; /* Ensures elements appear in line */
    padding: 5px; /* Adjust padding as needed */
    /* Optionally add margin, if desired */
    margin-right: 10px;
}

.status {
    color: black;
    font-size: 15px;
}

.count {
    color: blue;
    font-weight: bold;
    font-size: 30px;
}


    </style>
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
            <a href="Darkfiber.php">Dark Fiber</a>
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
          <a href="linkdata.php">New-Links</a>
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
<main>
<?php
// Include database connection
require_once "masterdatabase.php";

// Initialize SQL queries
$sql_feasibility_count = "SELECT COUNT(feasibilityID) AS total_feasibility FROM darkfiber";
$sql_no_status_count = "SELECT COUNT(Status) AS no_status FROM darkfiber WHERE Status = 'No'";
$sql_yes_postatus_count = "SELECT COUNT(postatus) AS yes_postatus FROM darkfiber WHERE postatus = 'Yes'";

// Execute queries
$result_feasibility_count = $conn->query($sql_feasibility_count);
$result_no_status_count = $conn->query($sql_no_status_count);
$result_yes_postatus_count = $conn->query($sql_yes_postatus_count);

// Fetch counts
$row_feasibility_count = $result_feasibility_count->fetch_assoc();
$row_no_status_count = $result_no_status_count->fetch_assoc();
$row_yes_postatus_count = $result_yes_postatus_count->fetch_assoc();

// Display counts
$total_feasibility = $row_feasibility_count['total_feasibility'];
$no_status_count = $row_no_status_count['no_status'];
$yes_postatus_count = $row_yes_postatus_count['yes_postatus'];

$result_feasibility_count->free_result();
$result_no_status_count->free_result();
$result_yes_postatus_count->free_result();

?>
<div class="grid-container">
    <div class="vendor-box">
        <span class="status">FeasibilityIDs</span>
        <span class="count"><?php echo $total_feasibility; ?></span>
    </div>
    <div class="po-box">
        <span class="status">Pending</span>
        <span class="count"><?php echo $no_status_count; ?></span>
    </div>
    <div class="pending-box">
        <span class="status">Po Recived</span>
        <span class="count"><?php echo $yes_postatus_count; ?></span>
    </div>
</div>
<form method="get">
    <input type="text" name="search" placeholder="Search by feasibility ID">
    <button type="submit">Search</button>
</form>

<div class="button-container">
    <a href="darkfiber.php"><button>Add New</button></a>
</div>

<table>
    <tr>
        <th>Feasibility ID</th>
        <th>Date</th>
        <th>Name</th>
        <th>Contact Name</th>
        <th>Contact Number</th>
        <th>Contact Email</th>
        <th>Fiber-Type</th>
        <th>End-A</th>
        <th>End-A Latlong</th>
        <th>End-B</th>
        <th>End-B Latlong</th>
        <th>Partner Name</th>
        <th>Partner Number</th>
        <th>Partner Email</th>
        <th>Status</th>
        <th>Po Status</th>
        <th>Po Number</th>
    </tr>
<?php
// Include database connection
require_once "masterdatabase.php";

// Initialize SQL query
$sql = "SELECT * FROM darkfiber";

// Check if search parameter is set
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $_GET['search'];
    // Use prepared statement to prevent SQL injection
    $sql .= " WHERE feasibilityID LIKE ?";
    $stmt = $conn->prepare($sql);
    // Bind parameter
    $stmt->bind_param("s", $search);
    // Execute query
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Execute query without search parameter
    $result = $conn->query($sql);
}

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["feasibilityID"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["contactname"]."</td>";
        echo "<td>".$row["contactnub"]."</td>";
        echo "<td>".$row["contactmail"]."</td>";
        echo "<td>".$row["fibertype"]."</td>";
        echo "<td>".$row["endA"]."</td>";
        echo "<td>".$row["endAlatlong"]."</td>";
        echo "<td>".$row["endB"]."</td>";
        echo "<td>".$row["endBlatlong"]."</td>";
        echo "<td>".$row["partnername"]."</td>";
        echo "<td>".$row["partnernumber"]."</td>";
        echo "<td>".$row["partnermail"]."</td>";
        echo "<td>".$row["Status"]."</td>";
        echo "<td>".$row["postatus"]."</td>";
        echo "<td>".$row["po"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='17'>No results found</td></tr>";
}

// Close statement if it was prepared
if(isset($stmt)) $stmt->close();

// Close connection
$conn->close();
?>
</table>
</main>
</body>
</html>
