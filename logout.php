<?php
session_start();
require_once 'config/database.php';
logout_user();
header("Location: login.php");
exit();
?> 