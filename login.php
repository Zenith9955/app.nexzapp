<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
}

.logo {
    flex: 1;
    text-align: center;
}

.logo img {
    max-width: 100%;
    height: auto;
    padding: 50px 40px 0px 0px ;
    
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
    width: 20%;
    padding: 10px;
    margin-top: 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}



</style>
<body>
    <div class="container">
    <?php   
if (isset($_POST["login"])){
    $loginid = $_POST['loginid'];
    $password = $_POST['password'];
    require_once "database.php";
    $sql = "SELECT * FROM  users WHERE login = '$loginid'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user)  {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = 'yes';
            header("Location: index.php");
            die();
        }else
        echo "<div class='alert alert-danger'>Password does not match</div>";
    }else
    echo "<div class='alert alert-danger'>Invalid LoginID or Password</div>";
 }
 ?>
        <div class="logo">
            <!-- Modified image source using static template tag -->
            <img src="css/logo.jpg" alt="Logo">
        </div>
        <div id="login-container">
            <h1>Login</h1>
            <form action="" method="post">
                <input type="text" name="loginid" placeholder="Enter your LoginID" required>

                <input type="password" name="password" placeholder="Enter your Password" required>

                <button type="submit" name = "login" value= "login">Login</button>
            </form>
        </div>
    </div>
    

</body>
</html>