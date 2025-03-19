<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session completely
session_destroy();

// Remove session cookie (optional but recommended)
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login page
header("Location: login.php");
exit;
?>