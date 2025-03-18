<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:login.php');
    exit; // It's good practice to include exit after a header redirect
} 
else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'student') {
    header('location:login.php');
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
<header class="header">

<a href="">Admin Dashboard</a>
<div class="logout">
    <a class="btn btn-danger" href="logout.php">Logout</a>
</div>
</header>
<aside>

<ul>

<li>
    <a href="admission.php">Admission</a>
</li>
<li>
    <a href="">Add Student</a>
</li>
<li>
    <a href="">View Students</a>
</li>
<li>
    <a href="">Add Teacher</a>
</li>
<li>
    <a href="">View Teachers</a>
</li>
<li>
    <a href="">Add Course</a>
</li>
<li>
    <a href="">View Courses</a>
</li>
</ul>
</aside>
<div class="content">
    <h1>Welcome to the Student Management Dashboard!</h1>
</div>
</body>
</html>