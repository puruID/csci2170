<?php
session_start();
include 'header.php';

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'addToCart') {
        $selectedBook = [
            'title' => $_POST['title'],
            'price' => $_POST['price'],
            'quantity' => 1 // Default quantity is set to 1 when adding to cart
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $_SESSION['cart'][] = $selectedBook;

        echo "<p>Item added to cart!</p>";
    }
    elseif ($_POST['action'] === 'updateQuantity') {
        $index = $_POST['itemIndex'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
    elseif ($_POST['action'] === 'removeItem') {
        $index = $_POST['itemIndex'];
        unset($_SESSION['cart'][$index]);
    }
}
?>
<div class="table-container">
    <?php
// Calculate total price
$totalPrice = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo '<table>';
    echo '<tr><th>Title</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Actions</th></tr>';
    foreach ($_SESSION['cart'] as $index => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $totalPrice += $subtotal;
        echo "<tr>";
        echo "<td>{$item['title']}</td>";
        echo "<td>{$item['price']}</td>";
        echo "<td><form method='post'><input type='hidden' name='action' value='updateQuantity'>";
        echo "<input type='hidden' name='itemIndex' value='$index'>";
        echo "<input type='number' name='quantity' value='{$item['quantity']}' min='1' max='10' onchange='this.form.submit()'></form></td>";
        echo "<td>$subtotal</td>";
        echo "<td><form method='post'><input type='hidden' name='action' value='removeItem'>";
        echo "<input type='hidden' name='itemIndex' value='$index'>";
        echo "<button type='submit'>Remove</button></form></td>";
        echo "</tr>";
    }
    echo '</table>';

    // Display total price
    echo "<p>Total Price: $totalPrice</p>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
</div>

<!-- Form to empty the cart -->
<form method="post" action="empty_cart.php">
    <input type="hidden" name="action" value="emptyCart">
    <button type="submit">Empty Cart</button>
</form>

<h2><a href="welcome.php">Continue shopping</a></h2>
