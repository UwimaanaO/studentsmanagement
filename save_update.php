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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['student_id']) || empty($_POST['student_id'])) {
        $_SESSION['message'] = "No student selected!";
        header("Location: view_students.php");
        exit;
    }

    $student_id = $_POST['student_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // ✅ Check if the username is already in use by another user
    $check_sql = "SELECT id FROM users WHERE username = ? AND id != ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "si", $username, $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Error: Username already exists!";
        header("Location: update_student.php?student_id=" . $student_id);
        exit;
    }

    // ✅ Check if the email is already in use by another user
    $check_email_sql = "SELECT id FROM users WHERE email = ? AND id != ?";
    $stmt_email = mysqli_prepare($conn, $check_email_sql);
    mysqli_stmt_bind_param($stmt_email, "si", $email, $student_id);
    mysqli_stmt_execute($stmt_email);
    $result_email = mysqli_stmt_get_result($stmt_email);

    if (mysqli_num_rows($result_email) > 0) {
        $_SESSION['message'] = "Error: Email already exists!";
        header("Location: update_student.php?student_id=" . $student_id);
        exit;
    }

    // ✅ Update student details if username and email are unique
    $update_sql = "UPDATE users SET username=?, email=?, phone=? WHERE id=?";
    $stmt_update = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt_update, "sssi", $username, $email, $phone, $student_id);
    
    if (mysqli_stmt_execute($stmt_update)) {
        $_SESSION['message'] = "Student updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating student.";
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt_email);
    mysqli_stmt_close($stmt_update);
    mysqli_close($conn);
    
    header("Location: view_students.php");
    exit;
}
?>
