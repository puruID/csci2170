<?php
session_start();
// Include the database connection
include_once "db_connect.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];  

include 'header.php';

// Handle update profile form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    // Handle the update form submission
    $newUsername = filter_input(INPUT_POST, 'new_username', FILTER_SANITIZE_STRING);
    $newEmail = filter_input(INPUT_POST, 'new_email', FILTER_SANITIZE_EMAIL);
    $newPassword = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);

    // Perform the necessary validation on the input data

    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE `User` SET `username`=?, `email`=?, `password`=? WHERE `username`=?";
    $stmt = $conn->prepare($updateQuery);

    // Use a unique salt for each user
    $salt = uniqid();
    $hashedPassword = password_hash($newPassword . $salt, PASSWORD_DEFAULT);

    $stmt->execute([$newUsername, $newEmail, $hashedPassword, $username]);

    if ($stmt->error) {
        echo "Error during update: " . $stmt->error;
        exit();
    }

    // Update the user's profile in the session
    $_SESSION['username'] = $newUsername;
    $_SESSION['email'] = $newEmail;
    $user_id = $_SESSION['user_id'];  

    // Regenerate session ID to prevent session hijacking
    session_regenerate_id(true);

    // Provide feedback to the user
    echo "Profile updated successfully. Reload the page to see the changes!";
}

// Handle delete account form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    // Handle the delete account form submission

    // Delete the user's account from the database
    $deleteQuery = "DELETE FROM `User` WHERE `username`=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->execute([$username]);

    // Destroy the session and regenerate the session ID
    session_regenerate_id(true);
    session_destroy();

    // Provide feedback to the user
    echo "Account deleted successfully.";

    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
<p>Email: <?php echo htmlspecialchars($email); ?></p>


<!-- Update Profile Form -->
<h2>Update Profile</h2>
<form method="post" action="view_profile.php">
    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" required>

    <label for="new_email">New Email:</label>
    <input type="email" name="new_email" required>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>

    <input type="submit" name="update_profile" value="Update">
</form>

<!-- Delete Account Form -->
<h2>Delete Account</h2>
<form method="post" action="view_profile.php" onsubmit="return confirm('Are you sure you want to delete your account?');">
    <input type="submit" name="delete_account" value="Delete Account">
</form>

<a href="logout.php"><button type="button">Log out</button></a>
