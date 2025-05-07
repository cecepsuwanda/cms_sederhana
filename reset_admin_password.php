<?php
require_once 'config/database.php';

$new_password = getenv('ADMIN_NEW_PASSWORD');
$hash = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = '$hash' WHERE username = 'admin'";
if (mysqli_query($conn, $sql)) {
    echo "Admin password has been reset to '$new_password'.";
} else {
    echo "Error: " . mysqli_error($conn);
}