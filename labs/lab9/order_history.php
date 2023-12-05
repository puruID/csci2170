<?php
session_start();
include 'header.php';
include_once "db_connect.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the form is submitted for updating or deleting an order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateOrder'])) {
        // Update the order
        $orderID = $_POST['orderID'];
        $newQuantity = $_POST['newQuantity'];
        $updateOrderQuery = "UPDATE orders SET quantity = ? WHERE orderID = ?";
        $stmt = $conn->prepare($updateOrderQuery);
        $stmt->execute([$newQuantity, $orderID]);
    } elseif (isset($_POST['deleteOrder'])) {
        // Delete the order
        $orderID = $_POST['orderID'];
        $deleteOrderQuery = "DELETE FROM orders WHERE orderID = ?";
        $stmt = $conn->prepare($deleteOrderQuery);
        $stmt->execute([$orderID]);
    }

    // Redirect back to the order history page
    header("Location: order_history.php");
    exit();
}

// Retrieve user's order history within the last week
$userID = $_SESSION['user_id'];
$weekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));
$orderHistoryQuery = "SELECT * FROM orders WHERE userID = ? AND orderDate > ? ORDER BY orderDate DESC";
$stmt = $conn->prepare($orderHistoryQuery);
$stmt->execute([$userID, $weekAgo]);
$orderHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="update-order-container">
    <h2>Update/Delete Order</h2>
    <?php
    if (!empty($orderHistory)) {
        ?>
        <table>
            <tr>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($orderHistory as $order) {
                ?>
                <tr>
                    <td>
                        <?= $order['orderDate'] ?>
                    </td>
                    <td>
                        <?= $order['price'] * $order['quantity'] ?>
                    </td>
                    <td>
                        <?= $order['quantity'] ?>
                    </td>
                    <td>
                        <!-- Form to update the order quantity -->
                        <form method="post">
                            <input type="hidden" name="orderID" value="<?= $order['orderID'] ?>">
                            <label for="newQuantity">New Quantity:</label>
                            <input type="number" name="newQuantity" value="<?= $order['quantity'] ?>" min="1" max="10">
                            <button type="submit" name="updateOrder">Update</button>
                        </form>
                        <!-- Form to delete the order -->
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            <input type="hidden" name="orderID" value="<?= $order['orderID'] ?>">
                            <button type="submit" name="deleteOrder">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo "<p>No orders found in the last week.</p>";
    }
    ?>
</div>

<h2><a href="welcome.php">Continue shopping</a></h2>

</body>

</html>