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
$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'student_id' is present in the URL
if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    // Use prepared statements to avoid SQL injection
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind the student ID to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch the result
    if (mysqli_num_rows($result) > 0) {
        $info = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['message'] = "Student not found!";
        header("Location: view_students.php");
        exit;
    }
    
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "No student ID provided!";
    header("Location: view_students.php");
    exit;
}

if(isset($_POST["update"])) {
$username=$_POST['username'];
$email=$_POST['email'];
$phone=$_POST['phone'];


$query="UPDATE users SET username='$username', email='$email', phone='$phone' WHERE id='$id'";
$result2=mysqli_query($conn, $query);
if ($result2) {
    echo "<script type='text/javascript'>
    alert('Data Updated Successfully');
    
    </script>";
}
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('admin_css.php'); ?>
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_des {
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
    <title>Update Students Page</title>
</head>
<body>

    <?php include('admin_sidebar.php'); ?>
    <div class="content">
        <center>
        <h2 style="padding-top: 20px;">Update Student</h2>
        <div class="div_des">
        <form action="#" method="POST">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($info['id']); ?>">

            <div>
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($info['username']); ?>" required>
            </div>

            <div>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>" required>
            </div>

            <div>
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>" required>
            </div>

            <input type="submit" name="update" value="Update" class="btn btn-success">
            <a href="view_students.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    </center>
    </div>
</body>
</html>
