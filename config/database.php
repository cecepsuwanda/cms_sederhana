<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'cecep');
define('DB_PASS', 'Cecep@1982');
define('DB_NAME', 'cms_sederhana');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 