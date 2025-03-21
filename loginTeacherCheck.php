<?php
session_start();  // Start the session to store login state

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];  // Password from the form (we'll hash this later)

    // Query to fetch the teacher's data by email
    $sql = "SELECT * FROM teachers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if ($row = mysqli_fetch_assoc($result)) {
        // User exists, now verify the password
        if (password_verify($pass, $row['password'])) {
            // Password is correct, login successful
            $_SESSION['teacher_id'] = $row['id'];  // Store user ID in session
            $_SESSION['email'] = $row['email'];    // Store user email in session
            header("Location: teacherhome.php");     // Redirect to dashboard
            exit;
        } else {
            // Incorrect password
            $_SESSION['loginMessage'] = "Invalid password!";
            header("Location: login.php");
            exit;
        }
    } else {
        // No user found with that email
        $_SESSION['loginMessage'] = "No user found with that email!";
        header("Location: login.php");
        exit;
    }

    // Close prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>