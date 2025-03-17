<?php
error_reporting(0);

session_start();
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
$name=$_POST["username"];
$pass=$_POST["password"];
$sql="select * from users where username='".$name."' AND password='".$pass."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if($row["usertype"]== "student"){
    $_SESSION['username']=$name;
    $_SESSION['usertype']="student";
    header("location:studenthome.php");
}
else if($row["usertype"]== "admin"){
    $_SESSION['username']=$name;
    $_SESSION['usertype']="admin";
    header("location:adminhome.php");
}
else{
    session_start();
    $message= "Wrong Username or password";
    $_SESSION['loginMessage']=$message;
    header('location:login.php');
}
}










?>