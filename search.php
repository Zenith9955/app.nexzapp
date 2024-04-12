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
    <title>Database Table View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fff;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
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
            margin-bottom: 30px;
        }
        label, select, input, button {
            font-size: 15px;
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
    <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit" name="action" value="dropdown-search">Search By Name</button>
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
