<?php include 'header.php'; 


session_start();

// Check if the user is logged in
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    echo "<h1>Welcome back, $username!</h1>";
} else {
    echo "<h1>Welcome, Guest!</h1>";
}
?>

<!-- Rest of your existing code -->

<section id="coverpage">
    <h2>on all products</h2>
    <p>Save more with coupons & upto 70% off!</p>
    <button id="button">shop now!</button>
    <img src="images/webpagecover.jpeg" alt="bookpage">
</section>

<div class="books">
    <div class="image-container">
        <img src="images/image1.webp" alt="book2">
        <img src="images/image2.jpeg" alt="book2">
        <img src="images/image3.webp" alt="book3">
    </div>
</div>

<?php include 'includes/books.php'; ?>

<section class="book-container">
    <?php foreach ($books as $book): ?>
        <div class="book">
            <h2><?php echo $book['title']; ?></h2>
            <p>ISBN: <?php echo $book['isbn']; ?></p>
            <p>Author: <?php echo $book['author']; ?></p>
            <p>Price: $<?php echo $book['price']; ?></p>
            <p>Publication Year: <?php echo $book['year']; ?></p>
            <p><?php echo $book['blurb']; ?></p>
            <form method="post" action="cart.php">
            <input type="hidden" name="action" value="addToCart">
            <input type="hidden" name="title" value="<?php echo $book['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
            <input type="hidden" name="isbn" value="<?php echo $book['isbn']; ?>">

            <button type="submit">Buy</button>
        </form>

        </div>
    <?php endforeach; ?>
</section>

<?php include 'footer.php'; ?>