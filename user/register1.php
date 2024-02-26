<?php include 'condb.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form action="register_db.php" method="POST">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="firstname" required>
        </div>

        <div class="input-group">
            <label for="last">Lastname</label>
            <input type="text" name="lastname">
        </div>

        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address">
        </div>

        <div class="input-group">
            <label for="phone">Telephone</label>
            <input type="number" name="telephone">
        </div>

        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <button type="submit" name="reg_user" class="btn">Register</button>
        </div>
        <p>Already a member? <a href="login1.php">Sign in</a></p>
    </form>
</body>
</html>
