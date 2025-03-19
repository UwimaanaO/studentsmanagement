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
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql="SELECT * from admission";
$result=mysqli_query($conn,$sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>Admission Page</title>
</head>
<body>
    <?php

include('admin_sidebar.php');

?>

<div class="content">
    <center>
    <h1>Applied for Admission</h1>
    <table border="1">
        <tr>
            <th style="padding: 20px; font-size: 15px;">Name</th>
            <th style="padding: 20px; font-size: 15px;">Email</th>
            <th style="padding: 20px; font-size: 15px;">Phone</th>
            <th style="padding: 20px; font-size: 15px;">Message</th>
        </tr>
        <?php
        while ($info=$result->fetch_assoc()){ 
    
        ?>
        <tr>
            <td style="padding: 20PX;">
                <?php echo"{$info['name']}"?>
            </td>
            <td style="padding: 20PX;">
            <?php echo"{$info['email']}"?>
            </td>
            <td style="padding: 20PX;">
            <?php echo"{$info['phone']}"?>
            </td>
            <td style="padding: 20PX;">
            <?php echo"{$info['message']}"?>
            </td>

        </tr>
        <?php
        }
        ?>
    </table>
</div>
</center>
</body>
</html>