<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>E-comm book store</title>
    
</head>
<body>
    <section id = "header">
        <h4>The Book Store</h4>
        <div>
            <ul id = "navbar">
                <li><a class name="active" href="index.php">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="contact.html">contact us</a></li>
                <li><a href="cart.html">cart</a></li>
            </ul>
        </div>
    </section>
    <section id = "coverpage">
        <h1>Super value deals</h1>
        <h2>on all products</h2>
        <p>Save more with coupons & upto 70% off!</p>
        <button id ="button">shop now!</button>
        <img src="images/webpagecover.jpeg">
    </section>
    <section class = "books">
        <div class = "image-container">
            
        <img src = "images/image1.webp" alt="book2">
        <img src = "images/image2.jpeg" alt="book2">
        <img src = "images/image3.webp" alt="book3">
    </div>
    </section>
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
                <button id = "addtocart">Add To Cart</button>
                
            </div>
        <?php endforeach; ?>
    </section>
    <footer>
        <p>&copy; 2023 Puru Arora</p>
    </footer>
</body>
</html>