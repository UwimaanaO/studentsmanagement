<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit; // It's good practice to include exit after a header redirect
} 
else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'student') {
    header('location:login.php');
    exit;
} 
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$conn = new mysqli($host, $user, $password, $db);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['student_id'])) {
    $user_id = intval($_POST['student_id']); // Convert to integer for security

    // Use Prepared Statements to prevent SQL Injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Student deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting student";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to student list
    header('location:view_students.php');
    exit;
}

// If accessed directly via GET, redirect to view_students.php
header('location:view_students.php');
exit;
?>
