<?php
require_once 'config.php';
require_once 'includes/functions.php';

$conn = db_connect();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 