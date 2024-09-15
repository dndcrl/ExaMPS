<?php
$password = 'admin_password'; // Replace with your desired admin password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password: " . $hashed_password;
?>
