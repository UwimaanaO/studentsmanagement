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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>Admin Page</title>
</head>
<body>
<header class="header">

<a href="">Admin Dashboard</a>
<div class="logout">
    <a class="btn btn-danger" href="">Logout</a>
</div>
</header>
<aside>

<ul>

<li>
    <a href="">Admission</a>
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
<div>
    <h1>Welcome to the Student Management Dashboard!</h1>
    <p>Manage Students: Add, edit, or delete student details with ease.

Attendance Tracking: Monitor and update attendance records.

Performance Insights: View grades and progress reports.

Class Management: Assign students to classes or groups.

Notifications: Stay updated with announcements and alerts.</p>
</div>
</body>
</html>