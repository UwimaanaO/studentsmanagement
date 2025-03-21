<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $sql = "DELETE FROM courses WHERE id = '$course_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('course deleted successfully'); window.location.href='view_courses.php';</script>";
    } else {
        echo "<script>alert('Failed to delete course'); window.location.href='view_courses.php';</script>";
    }
} else {
    header("Location: view_courses.php");
    exit;
}
?>
