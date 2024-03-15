<?php 

include 'condb.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ploynappan</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="product.css">

</head>

<body>
    <?php include 'menu.php';?>
    <div class="container">
        <br><br>
        <h2 class="text-center">
            สินค้าทั้งหมด
        </h2>
        <div class="row">
            <?php
            // Retrieve earing types from the database
            $type_query = "SELECT * FROM `type` ORDER BY `type`.`type_id` DESC";
            $type_result = mysqli_query($conn, $type_query);

            // Loop through each earing type
            while ($type_row = mysqli_fetch_array($type_result)) {
                // Display the earing type
                echo "<h3>" . $type_row['type_name'] . "</h3>";

                // Retrieve products belonging to this earing type
                $sql ="SELECT * FROM product WHERE type_id = " . $type_row['type_id'] . " ORDER BY pro_id DESC";
                $result = mysqli_query($conn, $sql);

                // Display products
                while($row=mysqli_fetch_array($result)){
                    $amount1=$row['amount'];
            ?>
            <div class="col-sm-3">
                <div class="text-center">
                    <!-- Product Image -->
                    <div class="highlight-on-hover">
                        <img src="img/<?=$row['image']?>" width="200px" height="220"
                            class="mt-5 p-2 my-2 border img-fluid">
                    </div>

                    <!-- Product Details -->
                    <span class="pink-color">ID: <?= $row['pro_id'] ?></span><br>
                    <b>
                        <h5 class="pink-color2"><?= $row['pro_name'] ?></h5>
                    </b>
                    ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท<br>

                    <!-- Buttons -->
                    <?php if($amount1 <= 0){ ?>
                    <a class="btn btn-danger mt-3" href="#"> สินค้าหมด </a>
                    <?php } else { ?>
                    <a class="btn btn-outline-success mt-3 mb-3" href="sh_product_detail.php?id=<?=$row['pro_id']?>">
                        รายละเอียดสินค้า
                    </a>
                    <a class="btn btn-outline-primary mt-3 mb-3" href="order.php?id=<?=$row['pro_id']?>">
                        เพิ่มลงในตะกร้า
                    </a>
                    <?php } ?>
                </div>
            </div>
            <?php
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>