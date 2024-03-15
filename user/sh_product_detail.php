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
    <div class="container  mt-5">
        <div class="row justify-content-center align-items-center">

            <?php
  $ids=$_GET['id'];
$sql ="SELECT * FROM product
      LEFT JOIN type ON product.type_id = type.type_id
      WHERE product.pro_id='$ids'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
    ?>
            <div class="col-md-4">

                <style>
                /* เมื่อนำเมาส์ไปวางที่รูป */
                .highlight-on-click img {
                    transition: transform 0.3s ease;
                    /* เพิ่มการเปลี่ยนแปลงเมื่อคลิก */
                }
                </style>

                <style>
                /* เมื่อนำเมาส์โดนรูป */
                .highlight-on-hover img {
                    transition: transform 0.3s ease;
                    /* เพิ่มการเปลี่ยนแปลงเมื่อโดน */
                }

                /* เมื่อโดนนั้น */
                .highlight-on-hover img:hover {
                    transform: scale(1.1);
                    /* เพิ่มการเปลี่ยนแปลงเมื่อโดน */
                }
                </style>

                <div class="highlight-on-hover">
                    <img src="img/<?=$row['image']?>" width="350px" class="mt-5 p-2 my-2 border img-fluid">
                </div>

            </div>

            <div class="col-md-6">
                <br><br><br>
                <span class="pink-color">ID: <?= $row['pro_id'] ?></span>
                <b>
                    <h5 class="pink-color2"><?= $row['pro_name'] ?>
                </b></h5>
                ประเภทสินค้า :<?=$row['type_name']?> <br>
                รายละเอียดสินค้า :<?=$row['detail']?> <br>
                ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท<br>
                <a class="btn btn-outline-success mt-3" href="order.php?id=<?=$row['pro_id']?>"> Add cart </a>
            </div>

        </div>
    </div>
    <?php
mysqli_close($conn); 
?>

</body>

</html>