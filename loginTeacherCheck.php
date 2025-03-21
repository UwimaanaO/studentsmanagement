<?php
session_start();  // Start the session to store login state

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM teachers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Compare entered password with stored plain text password
        if ($password === $user['password']) {
            // Successful login, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key
            header("Location: teacherhome.php"); // Redirect to a welcome page
            exit();
        } else {
            session_start();
            $message= "Wrong Username or password";
            $_SESSION['loginMessage']=$message;
            header('location:loginteacher.php');
        }
    } else {
        echo "Email not found!";
    }
}
?>
