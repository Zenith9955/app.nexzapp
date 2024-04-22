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
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: data.php"); // Prevent form resubmission pattern
    exit;
}

// Search functionality
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM customers WHERE name LIKE ?");
    $searchTerm = "%{$search}%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM customers");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Database</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>


<!---------------------------CCSSSS START----------------------------------------->
<style>
  form {
  display: flex;
  justify-content: none;
  margin-top: 160px;
}

table {
    width: 100%;
    margin: 10px auto;
    border-collapse: collapse;
    overflow: hidden; /* Ensuring borders are consistent */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 2px; /* Adding border radius for a softer look */
    border: 5px solid #ccc; /* Adding a subtle shadow for depth */
    font-size: 13px
}

table th, table td {
    padding: 1px;
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
    border-radius: 2px; /* Adding border radius for a softer look */
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
          <a href="#">Tracker &#9662;</a>
          <div class="dropdown-content">
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
        <th>Owner</th>
        <th>Account</th>
        <th>Field</th>
        <th>Owner</th>
        <th>Document</th>
        <th>Actions<th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td>
            <a href="?uploads/=<?= urlencode(basename($row['agreement'])) ?>"><?= htmlspecialchars($row['agreement']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['others'])) ?>"><?= htmlspecialchars($row['others']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['cancel_cheque'])) ?>"><?= htmlspecialchars($row['cancel_cheque']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['coi'])) ?>"><?= htmlspecialchars($row['coi']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['pan'])) ?>"><?= htmlspecialchars($row['pan']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['license'])) ?>"><?= htmlspecialchars($row['license']) ?></a><br>
            <a href="?uploads/=<?= urlencode(basename($row['other'])) ?>"><?= htmlspecialchars($row['other']) ?></a>

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
             <?= htmlspecialchars($row['ownerdesig']) ?><br>
             <?= htmlspecialchars($row['ownername']) ?><br>
             <?= htmlspecialchars($row['owneremail']) ?><br>
             <?= htmlspecialchars($row['ownercontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['accountdesig']) ?><br>
             <?= htmlspecialchars($row['accountname']) ?><br>
             <?= htmlspecialchars($row['accountemail']) ?><br>
             <?= htmlspecialchars($row['accountcontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['fielddesig']) ?><br>
             <?= htmlspecialchars($row['fieldname']) ?><br>
             <?= htmlspecialchars($row['fieldemail']) ?><br>
             <?= htmlspecialchars($row['fieldcontact']) ?><br>
            </td>
            <td>
             <?= htmlspecialchars($row['desig']) ?><br>
             <?= htmlspecialchars($row['name']) ?><br>
             <?= htmlspecialchars($row['email']) ?><br>
             <?= htmlspecialchars($row['contact']) ?><br>
            </td>
            <td>
            <a href="download.php?id=<?= $row['id'] ?>">Download</a>
            </td>
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
