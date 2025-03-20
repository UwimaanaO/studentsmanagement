<?php
/*session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit; // It's good practice to include exit after a header redirect
} 
else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'student') {
    header('location:login.php');
    exit;
}*/
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
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST["add_teacher"])) {
    $tname = $_POST["name"];
    $tdescription = $_POST["description"];
    $temail = $_POST["email"];
    $timage = $_FILES['image']['name'];
    $dst="./images/".$timage;
    $dst_db = "/images".$timage;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    $sql = "INSERT INTO teachers (name,description,email,image) VALUES ('$tname','$tdescription','$temail','$dst_db')";
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
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>Add Teacher Page</title>
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
    <h1>Add Teacher Details</h1>
    <div class="div_des">
    <form action="#" method="POST" enctype="multipart/form-data">
    <div>
    <label for="">Teacher name</label>
    <input type="text" name="name" style="width: 60%;">
    </div>
    <div>
    <label for="">Description</label>
    <textarea name="description"  class="text_area"></textarea>
    </div>
    <div>
    <label for="">Email</label>
    <input type="email" name="email" style="width: 60%;">
    </div>
    <div>
    <label for="">Image</label>
    <input type="file" name="image" style="width: 60%;">
    </div>
    <div>
    <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
    </div>
</div>
</form>
</div>

</center>
</body>
</html