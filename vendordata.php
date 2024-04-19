<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$host = 'localhost';  // Adjust according to your database host
$username = 'root';   // Your database username
$password = '';       // Your database password
$database = 'master';  // Your database name
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Assuming you have a function to safely fetch and verify the file names before deleting
    $stmt = $conn->prepare("SELECT agreement, others, cancel_cheque, coi, pan, license, other FROM vendor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        @unlink('uploads/' . basename($row['agreement']));
        @unlink('uploads/' . basename($row['others']));
        @unlink('uploads/' . basename($row['cancel_cheque']));
        @unlink('uploads/' . basename($row['coi']));
        @unlink('uploads/' . basename($row['pan']));
        @unlink('uploads/' . basename($row['license']));
        @unlink('uploads/' . basename($row['other']));

    }
    $stmt->close();

    // Delete the record
    $stmt = $conn->prepare("DELETE FROM vendor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: vendordata.php"); // Prevent form resubmission pattern
    exit;
}

// Search functionality
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM vendor WHERE name LIKE ?");
    $searchTerm = "%{$search}%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM vendor");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Database</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Make sure to link to the correct CSS file -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 10px;
    background-color: #fff;
     /* Adding a light background color */
}

/* Styling for tables */

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden; /* Ensuring borders are consistent */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 5px solid #ccc; /* Adding a subtle shadow for depth */
}

table th, table td {
    padding: 1px; /* Increasing padding for better spacing */
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f9f9f9; /* Slightly lighter shade for even rows */
}

table tr:hover {
    background-color: #e6e6e6; /* Darker shade on hover for better feedback */
}

/* Styling for form elements */

input[type="text"],
button {
    padding: 10px; /* Making input and button sizes consistent */
    font-size: 12px;
    border-radius: 8px; /* Adding border radius for a softer look */
    border: 1px solid #ccc; /* Adding a light border for input fields */
}

button {
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

a:hover {
    text-decoration: underline; /* Underlining links on hover for better feedback */
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


<form action="" method="get">
    <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
   

</form>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Documents</th>
        <th>Start Date</th>
        <th>Expire Date</th>
        <th>Bank Name</th>
        <th>Branch</th>
        <th>Account Name</th>
        <th>Account Number</th>
        <th>Account Type</th>
        <th>IFSC Code</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td>
                <a href="?uploads/<?= urlencode($row['agreement']) ?>" download="<?= htmlspecialchars($row['agreement']) ?>">Download Agreement</a><br>
                <a href="?uploads/<?= urlencode($row['others']) ?>" download="<?= htmlspecialchars($row['others']) ?>">Download Others</a><br>
                <a href="?uploads/<?= urlencode($row['cancel_cheque']) ?>" download="<?= htmlspecialchars($row['cancel_cheque']) ?>">Download Cancel Cheque</a><br>
                <a href="?uploads/<?= urlencode($row['coi']) ?>" download="<?= htmlspecialchars($row['coi']) ?>">Download COI</a><br>
                <a href="?uploads/<?= urlencode($row['pan']) ?>" download="<?= htmlspecialchars($row['pan']) ?>">Download PAN</a><br>
                <a href="?uploads/<?= urlencode($row['license']) ?>" download="<?= htmlspecialchars($row['license']) ?>">Download License </a><br>   
                <a href ="?uploads/<?= urlencode($row['other']) ?>" download="<?= htmlspecialchars($row['other']) ?>">Download Others</a>
              
              </td>

            <td><?= htmlspecialchars($row['start']) ?></td>
            <td><?= htmlspecialchars($row['expire']) ?></td>
            <td><?= htmlspecialchars($row['bank_name']) ?></td>
            <td><?= htmlspecialchars($row['branch']) ?></td>
            <td><?= htmlspecialchars($row['accountname']) ?></td>
            <td><?= htmlspecialchars($row['accountnumber']) ?></td>
            <td><?= htmlspecialchars($row['accounttype']) ?></td>
            <td><?= htmlspecialchars($row['ifsc_code']) ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
<?php
$conn->close();
 ?>
