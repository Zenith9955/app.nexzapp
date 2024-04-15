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
    $stmt = $conn->prepare("SELECT agreement, others FROM customer WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        @unlink('uploads/' . basename($row['agreement']));
        @unlink('uploads/' . basename($row['others']));
    }
    $stmt->close();

    // Delete the record
    $stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: data.php"); // Prevent form resubmission pattern
    exit;
}

// Search functionality
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM customer WHERE name LIKE ?");
    $searchTerm = "%{$search}%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM customer");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Database</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Make sure to link to the correct CSS file -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}


table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #ddd;
}

input[type="text"],
button {
    padding: 6px;
    font-size: 16px;
 }

button {
    cursor: pointer;
}

a {
    text-decoration: none;
    color: blue;
}

a:hover {
    text-decoration:;
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
        <th>Uploads</th>
        <th>Start Date</th>
        <th>Expire Date</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            
            <td>
                <a href="?uploads/<?= urlencode($row['agreement']) ?>" download="<?= htmlspecialchars($row['agreement']) ?>">Download Agreement</a><br>
                <a href="?uploads/<?= urlencode($row['others']) ?>" download="<?= htmlspecialchars($row['others']) ?>">Download Others</a>
            </td>
            <td><?= htmlspecialchars($row['start']) ?></td>
            <td><?= htmlspecialchars($row['expire']) ?></td>
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
