<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body background="playground.jpg" class="body_des">
<center>

<div class="form_des">
    <center class="title_des">
        <h3>Login Form</h3>
        <h4>
        <?php
            // Start the session to display the login message
            session_start();
            // Check if there's a login message to display
            if (isset($_SESSION['loginMessage'])) {
                echo $_SESSION['loginMessage'];
                // Clear the message after displaying it
                unset($_SESSION['loginMessage']);
            }
        ?>
        </h4>
    </center>

<form class="login_form" action="loginTeacherCheck.php" method="POST">
<div>
    <label class="label_form">Email</label>
    <input type="email" name="email" id=""  required>
</div>
<div>
    <label class="label_form">Password</label>
    <input type="password" name="password" id=""required>
</div>
<div>
  <button type="submit" name="submit" class="btn btn-primary">Login</button>
</div>
</form>
</div>
</center>  

</body>
</html>
