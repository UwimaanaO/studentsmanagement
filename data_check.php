<?php

session_start();
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['apply'])) {
$data_name=$_POST['name'];
$data_email=$_POST['email'];
$data_phone=$_POST['phone'];
$data_message=$_POST['message'];

$sql="INSERT INTO admission(name,email,phone,message) VALUES('$data_name','$data_email','$data_phone','$data_message')";
$result=mysqli_query($conn,$sql);
if($result){
    $_SESSION['message']='Your application was sent successfully';
    header('location:index.php');
}
else {
    echo "Apply Failed";
}
}

?>