<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Cookie Counter</title>
	<meta name="description" content="Registration Page (Loops)">
	<meta name="author" content="Gabriella Mosquera">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<section id="container">
		<?php
		if ($visits > 1) {
			echo '<h2>Welcome Back! You have visited ' . $visits . ' times</h2>';
		} else {
			echo '<h2>Welcome! This is your first visit.</h2>';
		}
		?>

		<form method="post" action="index.php">
			<label for="userValue">Enter a Value:</label>
			<input type="text" id="userValue" name="userValue">
			<input type="submit" value="Submit">
		</form>

		<?php
		if (isset($_COOKIE['userInput'])) {
			echo '<p>You previously entered: ' . $_COOKIE['userInput'] . '</p>';
		}
		?>
	</section>
</body>

</html>