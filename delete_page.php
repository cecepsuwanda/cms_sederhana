<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('login.php');
}

// Get page ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Delete the page
if (delete_page($conn, $id)) {
    redirect('pages.php');
}
?> 