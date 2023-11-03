<?php include 'header.php'; 

if(isset($_SESSION['page_count'])){
    $_SESSION['page_count'] += 1;
} else {
    $_SESSION['page_count'] = 1;
}

echo "You've visited this page " . $_SESSION['page_count'] . " times.";

// Check if the cookie is set
if(isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
    echo "<h1>Welcome, $username!</h1>";
} else {
    echo "<h1>Welcome, Guest!</h1>";
}



?>



<section id="coverpage">
    <h2>on all products</h2>
    <p>Save more with coupons & upto 70% off!</p>
    <button id ="button">shop now!</button>
    <img src="images/webpagecover.jpeg" alt="bookpage">
</section>

<div class = "books">
        
        <div class = "image-container">
            
        <img src = "images/image1.webp" alt="book2">
        <img src = "images/image2.jpeg" alt="book2">
        <img src = "images/image3.webp" alt="book3">
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
            <button type="submit">Buy</button>
        </form>
     
        </div>
    <?php endforeach; ?>
   
</section>


<?php include 'footer.php'; ?>
