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
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST["add_student"])) {
    $username = $_POST["name"];
    $useremail = $_POST["email"];
    $userphone = $_POST["phone"];
    $userpass = $_POST["password"];
    $usertype="student";
    $check="SELECT * FROM users WHERE username='$username'";
    $check_user=mysqli_query($conn, $check);
    $row_count=mysqli_num_rows($check_user);
    if($row_count== 1) {
        echo "<script type='text/javascript'>
        alert('Username already exists. Try another one');
        
        </script>";
    }
    else{

    $sql="INSERT INTO users(username,phone,email,usertype,password) 
      VALUES('$username','$userphone','$useremail','$usertype','$userpass')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script type='text/javascript'>
        alert('Data Uploaded successfully');
        
        </script>";
    }
    else{
        echo "Data upload failed";
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>Add Student Page</title>
    <style>
        label{
            display: inline-block;
            text-align: right;
            width:100px ;
            padding-top: 10px;
            padding-bottom: 10px;

        }
        .div_des{
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
    <?php

include('admin_sidebar.php');

?>

<div class="content">
    <center>
    <h1>Add Student Details</h1>
    <div class="div_des">
    <form action="#" method="POST">
    <div>
    <label for="">Username</label>
    <input type="text" name="name">
    </div>
    <div>
    <label for="">Phone</label>
    <input type="number" name="phone">
    </div>
    <div>
    <label for="">Email</label>
    <input type="email" name="email">
    </div>
    <div>
    <label for="">Password</label>
    <input type="text" name="password">
    </div>
    <div>
    <input type="submit" name="add_student" value="Add Student" class="btn btn-primary">
    </div>
</div>
</form>
</div>

</center>
</body>
</html>