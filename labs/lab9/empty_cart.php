<?php
session_start();

$_SESSION['cart'] = array(); // Reset the cart

header("Location: cart.php"); // Redirect back to the cart page
?>