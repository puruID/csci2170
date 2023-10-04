<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
require 'header.php';
?>


<?php

    //  regular expressions for validation
    $nameRegex = "/^[a-zA-Z]+(?: [a-zA-Z]+)?$/";
    $lastNameRegex = "/^[a-zA-Z'-]+$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$_!%*?&])[A-Za-z\d@$_!%*?&]{12,}$/";

    // Initializing variables to hold form data
   $first_name = "";
$last_name = "";
$email = "";
echo "The Password should contains atleast 12 charachters long and should be alphanumeric . Do not forget to use symbols(_!%*?&)";
$password = "";
$confirm_password = "";

    //  validation function
    function inputValidation($input, $regex) {
        return preg_match($regex, $input);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate inputs
        $first_name_valid = inputValidation($first_name, $nameRegex);
        $last_name_valid = inputValidation($last_name, $lastNameRegex);
        $email_valid = inputValidation($email, $emailRegex);
        $password_valid = inputValidation($password, $passwordRegex);
        $confirm_password_valid = ($password === $confirm_password);

        if ($first_name_valid && $last_name_valid && $email_valid && $password_valid && $confirm_password_valid) {
            
            //redirect to welcome page after validating the information
                 header("Location: welcome.php");
            exit();
        }
    }
?>
<div class="form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    First Name: <input type="text" name="first_name" value="<?php echo $first_name;?>" required><br>
    Last Name: <input type="text" name="last_name" value="<?php echo $last_name;?>" required><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>" required><br>
    Password: <input type="password" name="password" required><br>
    Confirm Password: <input type="password" name="confirm_password" required><br>
    <input type="submit" value="Submit">
</form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Display error messages if any field is invalid
        if (!$first_name_valid) echo "Invalid First Name.TRY AGAIN!<br>";
        if (!$last_name_valid) echo "Invalid Last Name.TRY AGAIN!<br>";
        if (!$email_valid) echo "Invalid Email.TRY AGAIN!<br>";
        if (!$password_valid) echo "Invalid Password. The Password should contains atleast 12 charachters and should be atleast alphanumeric . Do not forget to use symbols(_!%*?&)<br>";
        if (!$confirm_password_valid) echo "Passwords do not match.TRY AGAIN!<br>";
    }
?>

<?php 
require 'footer.php';
?>

</body>
</html>
