<?php
/*session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit; // It's good practice to include exit after a header redirect
} 
else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'student') {
    header('location:login.php');
    exit;
} */
session_start();
error_reporting(0);

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
$sql="SELECT * from teachers";
$result=mysqli_query($conn,$sql);
/*if($_GET['teacher_id']){
    $t_id=$_GET['teacher_id'];

    $sql2= "DELETE FROM teachers WHERE id='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
        header("location:view_teachers.php");
    }
    }
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>View Teachers Page</title>
</head>
<body>

    <?php include('admin_sidebar.php'); ?>

    <div class="content">
        <center>
            <h1>Teachers Data</h1>
            
            <?php 
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']);
                
            }
            ?>

            <table border="1">
                <tr>
                    <th style="padding: 20px; font-size: 15px;">ID</th>
                    <th style="padding: 20px; font-size: 15px;">Teacher Name</th>
                    <th style="padding: 20px; font-size: 15px;">Description</th>
                    <th style="padding: 20px; font-size: 15px;">Email</th>
                    <th style="padding: 20px; font-size: 15px;">Image</th>
                    <th style="padding: 20px; font-size: 15px;">Delete</th>
                    <th style="padding: 20px; font-size: 15px;">Update</th>
                </tr>

                <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['id']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['name']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['description']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['email']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><img height="100px" width="100px" src="<?php echo $info['image']; ?>" alt=""></td>
                        <td style="padding: 20px; background-color: skyblue;">
                        <?php
                        echo "<a onClick=\"return confirm('Are you sure you want to delete this teacher?');\" 
                        class='btn btn-danger' style='color: white;' 
                            href='delete_teacher.php?teacher_id={$info['id']}'>Delete</a>";
                            ?>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                           <?php echo"<a style='color:white' class='btn btn-warning' href='update_teacher.php?teacher_id={$info['id']}'> Update</a>"?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </center>
    </div>

</body>
</html>