<?php
session_start();

// If session isn't set, redirect to login
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
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

if (isset($_POST["add_Course"])) {
    $ccode = mysqli_real_escape_string($conn, $_POST["code"]);
    $cname = mysqli_real_escape_string($conn, $_POST["name"]);
    
    $cimage = $_FILES['image']['name'];
    $dst = "./images/" . $cimage; // Correct path
    $dst_db = "images/" . $cimage; // Correct path in DB
    $check="SELECT * FROM courses WHERE code='$ccode'";
    $check_user=mysqli_query($conn, $check);
    $row_count=mysqli_num_rows($check_user);
    if($row_count== 1) {
        echo "<script type='text/javascript'>
        alert('Code already exists. Try another one');
        
        </script>";
    }else{

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
        $sql = "INSERT INTO courses (code, name , image) VALUES ('$ccode', '$cname', '$dst_db')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<script>alert('Data Uploaded successfully');</script>";
        } else {
            echo "<script>alert('Database insertion failed');</script>";
        }
    } else {
        echo "<script>alert('File upload failed');</script>";
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
    <title>Add Course Page</title>
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
        .text_area{
    width: 60%;
    height: 120px;
    border-radius: 15px;
    border: 1px solid black;  
}
    </style>
</head>
<body>
    <?php

include('admin_sidebar.php');

?>

<div class="content">
    <center>
    <h1>Add Course Details</h1>
    <div class="div_des">
    <form action="#" method="POST" enctype="multipart/form-data">
    <div>
    <label for="">Course code</label>
    <input type="text" name="code" style="width: 60%;">
    </div>
    <div>
    <label for="">Course name</label>
    <input type="text" name="name" style="width: 60%;">
    </div>
    <div>
    <div>
    <label for="">Image</label>
    <input type="file" name="image" style="width: 60%;">
    </div>
    <div>
    <input type="submit" name="add_Course" value="Add Course" class="btn btn-primary">
    </div>
</div>
</form>
</div>

</center>
</body>
</html