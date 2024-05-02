<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
require_once "masterdatabase.php";
// Search functionality
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM implement WHERE name LIKE ?");
    $searchTerm = "%{$search}%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM implement");
}

$stmt->execute();
$result = $stmt->get_result();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch active vendors
$sqlActive = "SELECT name FROM implement WHERE status = 'active'";
$resultActive = $conn->query($sqlActive);

// Fetch inactive vendors
$sqlInactive = "SELECT name FROM implement WHERE status = 'inactive'";
$resultInactive = $conn->query($sqlInactive);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Database</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Make sure to link to the correct CSS file -->
</head>
<style>
body {
     font-family: Arial, sans-serif;
     background-color: #fff;
     }

 main {
     max-width: 150%;
     margin: 120px auto;
     background-color: #fff;
     padding: 10px;
     border-radius: 8px;
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
   padding: 5px; /* Decreased padding */
}


table {
    width: 100%;
    max-width: 100%; /* Set maximum width to 100% of the parent container */
    margin: 3px auto;
    border-collapse: collapse;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    border: 5px solid #ccc;
    font-size: 15px;
}

 table th, table td {
     padding: 2px;
     text-align: center;
     border-bottom: 1px solid #ccc;
     border-right: 1px solid #ccc;
 }

 table th {
     background-color:#87CEFA;
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
     font-size: 15px;
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
 .Combined-Vendors {
    display: flex;
    justify-content: center;
    gap: 20%; /* Adjust this value for the desired space between vendor boxes */
    width: 100%;
}

/* Style for vendor boxes */
.vendor-box {
    padding: 10px;
    background-color: #fff;
    /* margin: 5px; Remove margin to reduce space */
    width: 80px; /* Initial width */
    height: 0;
    padding-bottom: 80px; /* Same as width to make it square */
    position: relative;
}

/* Status text style */
.status {
    font-size: 18px;
    color: #333;
    text-align: center;
}

/* Count text style */
.count {
    font-size: 36px;
    font-weight: bold;
    color: #007bff;
    margin-top: 10px;
    text-align: center;
}

.button-container {
    display: flex;
    justify-content: flex-end; /* Aligns button to the right within the container */
}

.add-button:hover {
    background-color: #ababab;
    color: white;
}



</style>
<!-----------------------=+===========CSS END=======================---------->
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
// Assuming $resultActive and $resultInactive are defined and contain data
$totalActive = ($resultActive->num_rows > 0) ? $resultActive->num_rows : 0;
$totalInactive = ($resultInactive->num_rows > 0) ? $resultInactive->num_rows : 0;
?>
  
    <div class="grid-container">
    <div class="Combined-Vendors">
        <div class="vendor-box active">
            <div class="status">Active</div>
            <div class="count"><?= $totalActive ?></div>
        </div>
        <div class="vendor-box inactive">
            <div class="status">Inactive</div>
            <div class="count"><?= $totalInactive ?></div>
        </div>
    </div>
</div>

<form action="" method="get">
    <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>
<div class="button-container">
    <a href="implement.php"><button>Add New</button></a>
</div>

<table border="1">
    <tr>
        <th>FeasibilityIDs</th>
        <th>Name</th>
        <th>Status</th>
        <th>Disconnection</th>
        <th>Po number</th>
        <th>Po Date</th>
        <th>Expire</th>
        <th>Contact name</th>
        <th>Contact Number</th>
        <th>Contact mail</th>
        <th>Fiber Type</th>
        <th>End A</th>
        <th>End A Latlongs</th>
        <th>End B</th>
        <th>End B Latlongs</th>
        <th>Partner Name</th>
        <th>Partner Number</th>
        <th>Partner mail</th>
        <th>OtdrDls</th>
        <th>Otdr</th>
        <th>Overall</th>
        <th>handover to</th>
        <th>handover by</th>
        <th>handover date</th>
        <th>Recurring</th>
        <th>project end</th>
        <th>ageing Days</th>
        <th>acceptance Date</th>
        <th>Remarks</th>



    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['feasibilityID']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= htmlspecialchars($row['disconnection']) ?></td>
            <td><?= htmlspecialchars($row['po']) ?></td>
            <td><?= htmlspecialchars($row['podate']) ?></td>
            <td><?= htmlspecialchars($row['expire']) ?></td>
            <td> <?= htmlspecialchars($row['contactname']) ?></td>
            <td> <?= htmlspecialchars($row['contactnub']) ?></td>
            <td><?= htmlspecialchars($row['Contactmail']) ?></td>
            <td><?= htmlspecialchars($row['fibertype']) ?></td>
            <td><?= htmlspecialchars($row['endA']) ?></td>
            <td><?= htmlspecialchars($row['endAlatlong']) ?></td>
            <td><?= htmlspecialchars($row['endB']) ?></td>
            <td><?= htmlspecialchars($row['endBlatlong']) ?></td>
              <td><?= htmlspecialchars($row['partnername']) ?></td>
              <td><?= htmlspecialchars($row['partnernumber']) ?></td>
             <td> <?= htmlspecialchars($row['partnermail']) ?></td>
             <td><a href="linkdownload.php?id=<?= $row['id'] ?>">Download</a></td>
              <td><?= htmlspecialchars($row['otdr']) ?></td>
              <td><?= htmlspecialchars($row['overall']) ?></td>
              <td><?= htmlspecialchars($row['handoverto']) ?></td>
              <td><?= htmlspecialchars($row['handoverby']) ?></td>
              <td><?= htmlspecialchars($row['handover']) ?></td>
              <td><?= htmlspecialchars($row['recurring']) ?></td>
              <td><?= htmlspecialchars($row['projectend']) ?></td>
              <td><?= htmlspecialchars($row['ageingdays']) ?></td>
              <td><?= htmlspecialchars($row['acceptancedate']) ?></td>
              <td><?= htmlspecialchars($row['remarks']) ?></td>
                
        </tr>
    <?php endwhile; ?>
</table>
</main>
</body>
</html>
<?php
$conn->close();
 ?>
