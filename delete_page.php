<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get page ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Delete the page
$stmt = $conn->prepare("DELETE FROM pages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirect back to pages list
header("Location: pages.php");
exit(); 