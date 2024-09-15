<?php
$servername = "localhost";
$username = "root"; // Update this if you have a different username
$password = ""; // Update this if you have a different password
$dbname = "examps_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
