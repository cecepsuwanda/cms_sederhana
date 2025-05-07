<?php
require_once 'config/database.php';

$new_password = 'admin123';
$hash = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = '$hash' WHERE username = 'admin'";
if (mysqli_query($conn, $sql)) {
    echo "Admin password has been reset to 'admin123'.";
} else {
    echo "Error: " . mysqli_error($conn);
} 