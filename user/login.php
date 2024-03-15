<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php // หลังจากตรวจสอบการล็อกอินสำเร็จ
$_SESSION['id'] = $id; // หรือค่าอื่น ๆ ที่เกี่ยวข้อง
?>
    <div class="container">
        <br><br>
        <div class="row ">
            <div class=" col-md-8 mx-auto justify-center">
                <!-- นี่คือที่ใส่รูปภาพ -->
                <img src="img\ploynappan03.png" class="img" alt="Image" width="1000" height="500">
            </div>

            <div class="col-md-3 mx-auto badgeb  bg-light text-dark">
                <h5>Login</h5>
                <form method="POST" action="login_check.php">
                    <input type="text" name="username" class="form-control" required placeholder="username"> <br>
                    <input type="password" name="password" class="form-control" required placeholder="password"> <br>
                    <?php
                if(isset($_SESSION["Error"])){
                    echo "<div class='text-danger'> ";
                    echo $_SESSION["Error"];
                    echo "</div>";
                }
                ?>
                    <input type="submit" name="submit" class="btn btn-success" value="Login">
                    <br><br>
                    <a href="register.php" class="text-left"> Register </a>
                </form>
            </div>
        </div>

    </div>

    </div>

    </div>
</body>

</html>