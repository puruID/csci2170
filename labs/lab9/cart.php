<?php
session_start();
include 'header.php';
include_once "db_connect.php";

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'addToCart') {
        $selectedBook = [
            'title' => $_POST['title'],
            'isbn' => $_POST['isbn'], // Add ISBN to the selected book
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

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Display link to view order history
echo '<h2><a href="order_history.php"><button type = button>View Order History</button></a></h2>';
?>
<div class="table-container">
    <?php
// Calculate total price
$totalPrice = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo '<table>';
    echo '<tr><th>Title</th><th>ISBN</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Actions</th></tr>';
    foreach ($_SESSION['cart'] as $index => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $totalPrice += $subtotal;
        echo "<tr>";
        echo "<td>{$item['title']}</td>";
        echo "<td>{$item['isbn']}</td>";
 
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
<?php
// Order button
echo '<form method="post" action="cart.php">';
echo '<input type="submit" name="placeOrder" value="Place Order">';
echo '</form>';

// Process order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['placeOrder'])) {
    // Ensure the cart is not empty
    if (empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty. Add items before placing an order.</p>";
    } else {
        // Insert order into the orders table
        foreach ($_SESSION['cart'] as $item) {
            $insertOrderQuery = "INSERT INTO orders (order_title, userID, orderDate, isbn,price, quantity) VALUES (?, ?, NOW(), ?, ?,?)";
            $stmt = $conn->prepare($insertOrderQuery);
            $stmt->execute([$item['title'], $_SESSION['user_id'], $item['isbn'], $item['price'], $item['quantity']]);
        }

        // Clear the cart after the order is placed
        unset($_SESSION['cart']);

        echo "<p>Order placed successfully! Total Price: $totalPrice</p>";
    }
}
?>
<!-- Form to empty the cart -->
<form method="post" action="empty_cart.php">
    <input type="hidden" name="action" value="emptyCart">
    <button type="submit">Empty Cart</button>
</form>

<h2><a href="welcome.php">Continue shopping</a></h2>
