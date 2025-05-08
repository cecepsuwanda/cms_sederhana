<?php
// Database functions
function db_connect() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// User functions
function get_user($conn, $user_id) {
    $query = "SELECT * FROM users WHERE id = " . (int)$user_id;
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function get_all_users($conn) {
    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function create_user($conn, $username, $password, $email) {
    $username = mysqli_real_escape_string($conn, $username);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    return mysqli_query($conn, $query);
}

function update_user($conn, $user_id, $username, $email) {
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = " . (int)$user_id;
    return mysqli_query($conn, $query);
}

function delete_user($conn, $user_id) {
    $query = "DELETE FROM users WHERE id = " . (int)$user_id;
    return mysqli_query($conn, $query);
}

// Page functions
function get_page($conn, $page_id) {
    $query = "SELECT * FROM pages WHERE id = " . (int)$page_id;
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function get_all_pages($conn) {
    $query = "SELECT * FROM pages ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    $pages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pages[] = $row;
    }
    return $pages;
}

function create_page($conn, $title, $content, $status) {
    $title = mysqli_real_escape_string($conn, $title);
    $slug = strtolower(str_replace(' ', '-', $title));
    $content = mysqli_real_escape_string($conn, $content);
    $status = mysqli_real_escape_string($conn, $status);
    
    $query = "INSERT INTO pages (title, slug, content, status) VALUES ('$title', '$slug', '$content', '$status')";
    return mysqli_query($conn, $query);
}

function update_page($conn, $page_id, $title, $content, $status) {
    $title = mysqli_real_escape_string($conn, $title);
    $slug = strtolower(str_replace(' ', '-', $title));
    $content = mysqli_real_escape_string($conn, $content);
    $status = mysqli_real_escape_string($conn, $status);
    
    $query = "UPDATE pages SET title = '$title', slug = '$slug', content = '$content', status = '$status' WHERE id = " . (int)$page_id;
    return mysqli_query($conn, $query);
}

function delete_page($conn, $page_id) {
    $query = "DELETE FROM pages WHERE id = " . (int)$page_id;
    return mysqli_query($conn, $query);
}

// Authentication functions
function login_user($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function logout_user() {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Helper functions
function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitize_output($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?> 