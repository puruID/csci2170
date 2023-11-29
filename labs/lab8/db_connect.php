<?php
$hostname = "db.cs.dal.ca";
$username = "parora";
$password = "ny22tuQaFfHKYUT9w6NMAt8DS";
$database = "parora";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
