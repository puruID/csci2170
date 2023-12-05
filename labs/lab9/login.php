<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $enteredPassword = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    try {
        $stmt = $conn->prepare("SELECT `user_id`, `username`, `password`, `email` FROM `User` WHERE username = :username");
        
        if (!$stmt) {
            error_log("Error: Unable to prepare the statement.");
    
            echo "An error occurred. Please try again later.";
            exit();
        }

        $stmt->bindParam(':username', $enteredUsername);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($enteredPassword, $user['password'])) {
            // Password is correct
            // Set session variables
            $_SESSION['user_id'] = $user['user_id']; // Store user_id in the session
            $_SESSION['username'] = $enteredUsername;
            $_SESSION['email'] = $user['email'];

            // Redirect the user to the welcome page
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid username or password. Please try again.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Login</h1>
    <form action="login.php" method="post" class="contact-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <a href="index.php">
            <button type="button">Sign up</button>
        </a>
    </form>

</body>
</html>
