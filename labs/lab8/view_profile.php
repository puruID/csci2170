<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
include 'header.php'; 
?>



    <h1>View Profile</h1>

    <p>Username: <?php echo $username; ?></p>
    <p>Email: <?php echo $email; ?></p>
   

    <!-- Your profile page content goes here -->

</body>
</html>
