<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f3f3f3;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .container {
        max-width:800px;
        width: 200%;
        padding: 50px;
        box-sizing: border-box;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
        display: flex;
    }
    
    .logo {
        flex: 1;
        text-align: center;
    }
    
    .logo img {
        max-width: 100%;
        height: auto;
        padding: 120px 40px 0px 0px ;
        
    }
    
    #login-container {
        flex: 1;
        text-align: center;
        margin-left: 20px;
    }
    
    #login-container h1 {
        margin-bottom: 20px;
        color: #ababab;
    }
    
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px 16px 14px 16px; /* Reduce padding to make the input fields smaller */
        margin-bottom: 10px;
        border: none; /* Remove the border */
        border-bottom: 1px solid #ccc; /* Add bottom border to simulate underline */
        box-sizing: border-box;
        border-radius: 5px;
        transition: border-color 0.3s ease;
        background-color: transparent; /* Make background transparent */
    }
    
    input[type="text"]:focus,
    input[type="password"]:focus {
        border-bottom-color: #007bff; /* Change border color on focus */
        outline: none; /* Remove default outline */
    }
    
    
    input[type="text"]:hover,
    input[type="password"]:hover {
        border-bottom-color: #007bff; 
        outline color: #ababab/* Change border color on hover */
    }
    
    /* Add hover effect to submit button */
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
    
    /* Add hover effect to links */
    .link:hover {
        text-decoration: underline;
    }/* Add more styles as needed */
    
    
    button[type="submit"] {
        width: 50%;
        padding: 10px;
        margin-top: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 100px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
    
    .link {
        color: #007bff;
        text-decoration: none;
        display: block; /* Changed to block for better separation */
        margin-top: 20px; /* Added margin at the top */
        margin-bottom: 20px; /* Added margin at the bottom */
    }
    </style>
</head>
<body>



    <div class="container">
        <?php
       if (isset($_POST['submit'])) {
        $loginid = $_POST['loginid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordReapeat = $_POST['repeat_password'];
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $errors = array();
        
        if(empty($loginid) OR empty($name) OR empty($email) OR empty($password) OR empty($passwordReapeat)){
        array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email format");
        }
        if(strlen($password) < 3){
            array_push($errors, "Password must be at least 3 charactes long");
        }
        if ($password !== $passwordReapeat) {
            array_push($errors, "Passwords do not match");
        }

        require_once "admindatabase.php";
        $sql = "SELECT * FROM users WHERE login = '$loginid'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount > 0){
            array_push($errors, "Login ID already exists");
        }
        if(count($errors) > 0){
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{

       
        $sql = "INSERT INTO users (login, full_name, email, password, repeat_password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if($prepareStmt){
        mysqli_stmt_bind_param($stmt, "sssss", $loginid, $name, $email, $passwordHash, $passwordReapeat);
        if ($stmt->execute()) {
            echo "<script>alert('Data Inserted Successfully')</script>";
        } else {
            echo "Error: " . $stmt->error;
        }   
    }
    }
}

    ?>
        <div class="logo">
            <img src="css/logo.jpg" alt="Logo">
          </div>
        <div id="login-container">
        <h1>User Registration</h1>
        <form action="admin.php" method="post">
            <input type="text" name="loginid" placeholder="Create a LoginID" Required>
            <input type="text" name="name" placeholder="Enter your Full Name" Required>
            <input type="text" name="email" placeholder="Enter your Email" Required>
            <input type="password" name="password" placeholder="Enter your Password" Required>
            <input type="password" name="repeat_password" placeholder="Confirm your Password" Required>
            <button type="submit" name = "submit" >Sign Up</button>
        </form>
    </div>
</div>

</body>
</html>
