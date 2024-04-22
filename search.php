<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "master";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve all table names from the database
$tables = [];
$result = $connection->query("SHOW TABLES FROM $dbname");
if ($result) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
}

$searchResults = null;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['table'])) {
    $table = $connection->real_escape_string($_GET['table']);
    $searchTerm = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

    // Fetch column names dynamically
    $columnNames = [];
    $columns = $connection->query("SHOW COLUMNS FROM $table");
    if ($columns) {
        while ($row = $columns->fetch_array()) {
            $columnNames[] = $row[0];
        }
    }

    // Modify SQL to include search functionality
    $sql = "SELECT * FROM $table";
    if (!empty($searchTerm)) {
        $sql .= " WHERE ";
        $conditions = [];
        foreach ($columnNames as $columnName) {
            $conditions[] = "`$columnName` LIKE '%$searchTerm%'";
        }
        $sql .= implode(" OR ", $conditions);
    }
    $searchResults = $connection->query($sql);
}
$connection->close();
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
    <style>
          form {
          display: flex;
          justify-content: none;
          margin-top: 100px;
          }
          label {
          margin-right: 10px;
          
          }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #ddd;
            margin: 100px;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #4d4d4d;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 40px;
        }
        label, select, input, button {
            font-size: 20px;
        }
        button {
            padding: 5px;
            background-color: #ababab;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #4d4d4d;
        }
    </style>
</head>
<body>
    <h2>View Database Tables</h2><form method="GET">
    <label for="table">Tables:</label>
    <select name="table" id="table">
        <?php foreach ($tables as $table): ?>
            <option value="<?php echo $table; ?>"<?php if (isset($_GET['table']) && $_GET['table'] === $table) echo ' selected'; ?>><?php echo $table; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="action" value="dropdown-search">Search</button>
    
</form>

<form method="GET">
    <input type="hidden" name="table" value="<?php echo isset($_GET['table']) ? htmlspecialchars($_GET['table']) : ''; ?>">
</form>

    <?php if ($searchResults && $searchResults->num_rows > 0): ?>
        <h3>Database: <?php echo htmlspecialchars($table); ?></h3>
        <table>
            <tr>
                <?php
                    $fields = $searchResults->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>" . htmlspecialchars($field->name) . "</th>";
                    }
                ?>
            </tr>
            <?php
                while ($row = $searchResults->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
    <?php elseif ($searchResults && $searchResults->num_rows == 0): ?>
        <p>No data found in the table.</p>
    <?php endif; ?>
</body>
</html>