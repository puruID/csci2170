<?php
// Create your variables for your form data
// In this case, we can leave them empty since
// the value they'll hold will be provided when
// the user submits the form
$valid = '';
$postMsg = '';
$email = '';
$password = '';

// Lets create a function that cleans the data provided by the user 
// through the input fields
function clean($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}
//regexp for the first and last name of the person
$nameRegex = "/^[a-zA-Z+\-\ ]+(?: [a-zA-Z]+)?$/";
$lastNameRegex = "/^[a-zA-Z'-]+$/";
$passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$_!%*?&])[A-Za-z\d@$_!%*?&]{12,}$/";
// Lets try to validate our email input by using regular expressions
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
// 	$postMsg = 'There was a POST request';
// 	if(empty($_POST['email'])){
// 		$email = 'Email is required';
// 	} else {
// 		$email = clean($_POST['email']);
// 		$emailRegex = '/^[^@]+@[^@]+\.[a-z]{2,5}/i';
// 		if(!preg_match($emailRegex, $email)){
// 			$email = 'invalid email';
// 		} else {
// 			$email = 'valid email';
// 		}
// 	}
// }

// Lets try to validate the email input using filters
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$postMsg = 'There was a POST request';
	if(empty($_POST['email'])) {
		$email = 'Email is required';
	} else {
		$email = clean($_POST['email']);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = 'invalid email';
		} else {
			$email = 'valid email';
		}
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$password = $_POST["password"];

	$first_name_valid = filter_var($first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$nameRegex)));
	$last_name_valid = filter_var($last_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$lastNameRegex)));
	$password_valid = filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$passwordRegex)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Display error messages if any field is invalid
	if (!$first_name_valid) echo "Invalid First Name.TRY AGAIN!<br>";
	if (!$last_name_valid) echo "Invalid Last Name.TRY AGAIN!<br>";
	if (!$password_valid) echo "Invalid Password. The Password should contains atleast 12 charachters and should be atleast alphanumeric . Do not forget to use symbols(_!%*?&)<br>";
}
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Registration Page</title>
	<meta name="description" content="Registration Page (Loops)">
	<meta name="author" content="Gabriella Mosquera">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div id="container">
		<form id="registration" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<fieldset>
				<legend>Registration</legend>
				<p><label for="first_name">first name</label>
				<input name="first_name" id="firstname" type="text">
				<p>
				<p><label for="last_name">last name</label>
				<input name="last_name" id="lastname" type="text">
				<p>
					<label for="email">Email Address: </label>
					<input name="email" id="email" type="text" size="29">
				</p>
				<p>
					<label for="password">Password: </label>
					<input name="password" id="password" type="password" size="20">
				</p>
				<input type="submit" name="submit" value="Register">
			</fieldset>
			<p> <span class="error">Valid or Not: </span><em><?= $valid; ?></em></p>
			<p> <span class="success">Email: </span><em><?= $email; ?></em></p>
			<p> <span class="success">Post Message: </span><em><?= $postMsg; ?></em></p>
		</form>
	</div>
</body>
</html>