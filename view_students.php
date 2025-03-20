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
$sql="SELECT * from users WHERE usertype='student'";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php

include('admin_css.php');

?>
    <title>View Students Page</title>
</head>
<body>

    <?php include('admin_sidebar.php'); ?>

    <div class="content">
        <center>
            <h1>Student Data</h1>
            
            <?php 
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']);
                
            }
            ?>

            <table border="1">
                <tr>
                    <th style="padding: 20px; font-size: 15px;">ID</th>
                    <th style="padding: 20px; font-size: 15px;">Username</th>
                    <th style="padding: 20px; font-size: 15px;">Email</th>
                    <th style="padding: 20px; font-size: 15px;">Phone</th>
                    <th style="padding: 20px; font-size: 15px;">Delete</th>
                    <th style="padding: 20px; font-size: 15px;">Update</th>
                </tr>

                <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                    <td style="padding: 20px; background-color: skyblue;"><?php echo $info['id']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['username']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['email']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;"><?php echo $info['phone']; ?></td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <form method="POST" action="delete_student.php" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                <input type="hidden" name="student_id" value="<?php echo $info['id']; ?>">
                                <button type="submit" class="btn btn-danger" style="color:white;">Delete</button>
                            </form>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                           <?php echo"<a class='btn btn-warning' href='update_student.php?student_id={$info['id']}'> Update</a>"?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </center>
    </div>

</body>
</html>