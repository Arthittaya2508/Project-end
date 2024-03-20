<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #FFFAFA;
    }

    .container {
        display: flex;
        margin-top: 110px;
    }

    .img {
        margin-left: -50px;
    }

    .button-container {
        text-align: center;

    }

    input[type="submit"] {
        width: 100px;
    }

    .rgt {
        background-color: #FFFAFA;
        margin-top: 20px;
    }

    h3 {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <br><br>
        <div class="img">
            <img src="img\ploynappan03.png" class="img" alt="Image" width="1000" height="600">
        </div>

        <div class="cd col-md-3 mx-auto  text-dark">
            <h3>Login</h3>
            <form class="rgt" method="POST" action="login_check.php">
                <input type="text" name="username" class="form-control" required placeholder="username"> <br>
                <input type="password" name="password" class="form-control" required placeholder="password"> <br>
                <?php
                    if (isset($_SESSION["Error"])) {
                        echo "<div class='text-danger'> ";
                        echo $_SESSION["Error"];
                        echo "</div>";
                    }
                    ?>
                <div class="button-container">
                    <input type="submit" name="submit" class="btn btn-success" value="Login">
                </div>

                <a href="register.php" class="text-left"> Register </a>
            </form>
        </div>
    </div>
    </div>
    </div>
</body>

</html>