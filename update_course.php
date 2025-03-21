<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
} elseif (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'student') {
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

// Check if course_id is provided in URL
if (isset($_GET['course_id'])) {
    $id = intval($_GET['course_id']); // Ensure it's an integer

    // Fetch course details using a prepared statement
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $info = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['message'] = "course not found!";
        header("Location: view_courses.php");
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "No course ID provided!";
    header("Location: view_courses.php");
    exit;
}

// Handle the update form submission
if (isset($_POST["update_course"])) {
    $cid = intval($_POST["id"]);
    $ccode = trim($_POST['code']);
    $cname = trim($_POST['name']);
    $dst_db = $info['image']; // Keep existing image by default

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image']['name'];
        $dst = "./images/" . $file;
        $dst_db = "images/" . $file;

        // Move uploaded file
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
            die("Failed to upload image.");
        }
    }
    $check="SELECT * FROM courses WHERE code='$ccode'";
    $check_user=mysqli_query($conn, $check);
    $row_count=mysqli_num_rows($check_user);
    if($row_count== 1) {
        echo "<script type='text/javascript'>
        alert('Course Code already exists. Try another one');
        
        </script>";
    }else{

    // Update course record using prepared statement
    $query = "UPDATE courses SET code=?, name=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $ccode, $cname, $dst_db, $cid);
    $result2 = mysqli_stmt_execute($stmt);

    if ($result2) {
        echo "<script type='text/javascript'>
        alert('Data Updated Successfully');
        
        </script>";
    } else {
        echo "<script>alert('Update failed!');</script>";
    }

    mysqli_stmt_close($stmt);
}
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('admin_css.php'); ?>
    <title>Update Course's Page</title>
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding: 10px 0;
        }
        .div_des {
            background-color: skyblue;
            width: 400px;
            padding: 70px 20px;
            border-radius: 10px;
        }
        img {
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <?php include('admin_sidebar.php'); ?>

    <div class="content">
        <center>
        <h2 style="padding-top: 20px;">Update course</h2>
        <div class="div_des">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($info['id']); ?>">

                <div>
                    <label>Course code</label>
                    <input style="width: 60%;" type="text" name="code" value="<?php echo htmlspecialchars($info['code']); ?>" required>
                </div>

                <div>
                    <label>Course name</label>
                    <input style="width: 60%;" type="text" name="name" value="<?php echo htmlspecialchars($info['name']); ?>" required>
                </div>

                <div>
                    <label>Current image</label><br>
                    <img height="150px" width="150px" src="<?php echo $info['image']; ?>" alt="course Image">
                </div>

                <div>
                    <label>Choose New Image</label>
                    <input style="width: 60%;" type="file" name="image">
                </div>

                <input type="submit" name="update_course" value="Update" class="btn btn-success">
                <a href="view_courses.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        </center>
    </div>

</body>
</html>
