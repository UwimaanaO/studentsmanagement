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

if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    $sql = "DELETE FROM teachers WHERE id = '$teacher_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Teacher deleted successfully'); window.location.href='view_teachers.php';</script>";
    } else {
        echo "<script>alert('Failed to delete teacher'); window.location.href='view_teachers.php';</script>";
    }
} else {
    header("Location: view_teachers.php");
    exit;
}
?>
