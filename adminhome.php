<?php
session_start();

// Redirect if user is not logged in OR if user is not an admin
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header('location:login.php');
    exit; // Always exit after a redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>Admin Page</title>
</head>
<body>
    <?php

include('admin_sidebar.php');

?>
<div class="content">
    <h1>Welcome to the Student Management Dashboard!</h1>
</div>
</body>
</html>