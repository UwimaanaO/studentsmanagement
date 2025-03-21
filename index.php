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
$sql="SELECT * from teachers";
$result=mysqli_query($conn,$sql);
$sql2="SELECT * from courses";
$result2=mysqli_query($conn,$sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav>
        <label class="logo">T3 Schools</label>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Admission</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>

    <div class="section1">
        <label class="img_text">We teach students with care</label>
        <img class ="main_img" src="school.png" alt="School">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="welcome_img" src="playground.jpg" alt="">
            </div>
            <div class="col-md-8">
                <h1>Welcome to T3 Schools</h1>
                <p>T3 School possesses strong knowledge in 
                    IT infrastructure, network administration, and software development. 
                    It is proficient in troubleshooting technical issues and has an excellent ability to develop and implement effective IT solutions that improve efficiency. 
                    Her adaptability to new technologies and her dedication to 
                    staying updated with the latest trends in the ICT field make 
                    her a valuable asset to any team.</p>

            </div>

        </div>
    </div>
    <center>
        <h1>Our Teachers</h1>
    </center>
    <div class="container">
        <div class="row">
        <?php 
        while($info=$result->fetch_assoc())
        {
            
        ?>
        <div class="col-md-4">

        <img class="teacher" src="<?php echo $info['image']; ?>" alt="Teacher Image">
            <h3>
                <?php echo "{$info['name']}"?>
            </h3>
            <p>
                <?php echo "{$info['description']}"?>
            </p>
            </div>
        

        <?php
    
    }?>
        </div>

    </div>
    <center>
        <h1>Our Courses</h1>
    </center>
    <div class="container">
        <div class="row">
        <?php 
        while($info2=$result2->fetch_assoc())
        {
            
        ?>
        <div class="col-md-4">

        <img class="teacher" src="<?php echo $info2['image']; ?>" alt="Course image">
            <h3>
                <?php echo "{$info2['name']}"?>
            </h3>
            <p>
                <?php echo "Course Code: {$info2['code']}"?>
            </p>
            </div>
        

        <?php
    
    }?>
        </div>

    </div>
        <center>
            <h1 class="adm">Admission Form</h1>
        </center>
        <div align="center" class="admission_form">
            <form action="data_check.php" method="POST">
                <div class="adm_form">
                  <label class="label_text">Name</label>
                  <input class="input_des" type="text" name="name">
                </div>
                <div class="adm_form">
                  <label class="label_text">Email</label>
                  <input class="input_des" type="email" name="email">
                </div>
                <div class="adm_form">
                  <label class="label_text">Phone</label>
                  <input class="input_des" type="text" name="phone">
                  </div>
                <div class="adm_form">
                  <label class="label_text">Message</label>
                  <textarea class="text_area" name="message"></textarea>
                </div>
             <div class="adm_form">
                    <input class="btn btn-primary" type="submit" value="Apply" id="submit" name="apply">
                </div>
            </form>

        </div>

    </div>
    <footer>
        <h3 class="footer_text">All @copyright reserved by Livy technologies</h3>
    </footer>
</body>
</html>