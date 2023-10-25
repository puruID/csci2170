<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



<?php
if (!isset($_COOKIE['visits'])) {
    $_COOKIE['visits'] = 0;
}


$visits = $_COOKIE['visits'] + 1;
// If a cookie named 'visits' does exist,
// then add 1 to the current value of the cookie,
if (isset($_POST['userValue'])) {
    setcookie('userInput', $_POST['userValue'], time() + 3600 * 24 * 365);
}


// Using the setcookie( ) function, we can now assign

setcookie('visits', $visits, time() + 3600 * 24 * 365);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Set a cookie to remember the user
    setcookie("username", $username, time() + 3600, "/"); 
    // Cookie expires in 1 hour

    // Redirect the user to a welcome page
    header("Location: welcome.php");
   
}
?>

    <h1>Login</h1>
    <form action="index.php" method="post" class = "contact-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>

</body>
</html>