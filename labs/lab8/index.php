<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>

    <?php
include_once "db_connect.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and filter form data
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

    // Simple validation
    if ($password !== $confirmPassword) {
        echo "Passwords do not match";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
    

            // Use a prepared statement to prevent SQL injection
            $regQuery = "INSERT INTO `User` (`username`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($regQuery);
            $stmt->execute([$username, $email, $hashedPassword]);

            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            // Log or display the database error
            echo "Oops. Database error: " . $e->getMessage();
        }
    }
}
?>


    <!-- Registration Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
