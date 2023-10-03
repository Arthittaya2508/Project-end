<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-4 badge bg-light text-dark ">
                <h5>Login</h5>
                <form method="POST" action="login_check.php">
                    <input type="text" class="form-control" maxlength="10" name="username" placeholder="Username"> <br>
                    <input type="password" maxlength="10" class="form-control" name="password" placeholder="Password"> <br>
                    <?php
                    if (isset($_SESSION["Error"])) {
                        echo "<div class='text-danger'>";
                        echo $_SESSION["Error"];
                        echo "</div>";
                    }
                    $_SESSION['Error'] = "";
                    ?>
                    <button type="submit" class="btn btn-success" name="submit">Login</button>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
