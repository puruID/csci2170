<!-- This is the submission for lab1.
@author: Puru Arora
B00887468
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Example</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <?php
            $num1 = 500; // First number
            $num2 = 350; // Second number

            $sum = $num1 + $num2; // Adding the two numbers

            echo "<h1 class='sum'>The sum of $num1 and $num2 is: $sum.</h1>";
        ?>

        <?php
            $name = "Puru";
            $age = 20;
            echo "<div class='msg'>My name is " . $name . " and I am " . $age . " years old.</div>";
        ?>
    </div>
</body>
</html>
