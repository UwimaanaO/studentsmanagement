<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Optional: Ensure correct user role (for admin pages)
if ($_SESSION['usertype'] !== 'admin') { 
    header("Location: studenthome.php"); // Redirect non-admins
    exit;
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