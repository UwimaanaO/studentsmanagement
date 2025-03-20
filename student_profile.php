<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Redirect if not a student
if ($_SESSION['usertype'] !== 'student') {
    header("Location: adminhome.php");
    exit;
}
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$name=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username='$name'";
$result=mysqli_query($conn,$sql);
$info=mysqli_fetch_assoc($result);

if(isset($_POST['update_profile'])){
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password =($_POST['password']);

    $sql2 = "UPDATE users SET email=?, phone=?, password=? WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt, "ssss", $email, $phone, $password, $name);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Student Profile Updated Successfully');</script>";
        // Refresh page to load new data
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }

    mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" type="text/css" href="student.css">
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
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
    <title>Student Page</title>
</head>
<body>
    <?php 
    include'student_sidebar.php';
    ?> 
    <div class="content">
<center>
        
        
        <h2>Update My Profile</h2>
        <form action="" method="POST">
    <div class="div_des">
        <div>
            <label>Phone</label>
            <input type="number" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>" style="width: 60%;" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>" style="width: 60%;" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter new password" style="width: 60%;" required>
        </div>
        <input type="submit" name="update_profile" class="btn btn-primary" value="Update Profile">
    </div>
</form>
    </center>
        </div>
    </div>
</body>
</html>