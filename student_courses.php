<?php
error_reporting(0);
session_start();
session_destroy();
if ($_SESSION['message']){
    $message=$_SESSION['message'];
    echo"<script type='text/javascript'>
    alert('$message');
    </script>";
}
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql2="SELECT * from courses";
$result2=mysqli_query($conn,$sql2);

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
    <meta charset="UTF-8">
    <title>My Courses</title>
</head>
<body>
<?php 
    include'student_sidebar.php';
    ?> 
    <div class="content">
    <div class="container">
        <div class="row">
        <?php 
        while($info2=$result2->fetch_assoc())
        {
            
        ?>
        <div class="col-md-4">

        <img width="200px" height="200px" class="teacher" src="<?php echo $info2['image']; ?>" alt="Course image">
            <h3>
                <?php echo "{$info2['name']}"?>
            </h3>
            <p>
                <?php echo "Course Code: {$info2['code']}"?>
            </p>
            </div>
        

        <?php
    
    }
    ?>
</div>
</body>
</html>