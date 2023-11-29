<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT `username`, `password`, `email` FROM `User` WHERE username = :username");
        
        if (!$stmt) {
            echo "Error: Unable to prepare the statement.";
            exit();
        }

        $stmt->bindParam(':username', $enteredUsername);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($enteredPassword, $user['password'])) {
            // Password is correct
            // Set session variables
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
    </form>

</body>
</html>
