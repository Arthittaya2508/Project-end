<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ploynappan</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="product.css">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php   session_start(); ?>
    <?php include 'menu.php';?>
    <?php include 'header.php';?>
    <?php include 'condb.php'; ?>


    <div class="content">
        <!-- notification message  -->
        <?php
         if (isset($_SESSION['success'])) : ?>
        <div class="success">
            <h3>
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
            </h3>
        </div>
        <?php endif ?>

    </div>
</body>

</html>