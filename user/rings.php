<?php 

include 'condb.php';
session_start();


$type_id = '002'; 
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
            แหวน
        </h2>
        <div class="row">
            <?php
            // Retrieve products belonging to the specified type
            $sql ="SELECT * FROM product WHERE type_id = '$type_id' ORDER BY pro_id DESC";
            $result = mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
                $amount1=$row['amount'];
            ?>
            <div class="col-sm-3">
                <div class="text-center">

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
                        <img src="img/<?=$row['image']?>" width="200px" height="220"
                            class="mt-5 p-2 my-2 border img-fluid">
                    </div>


                    <!-- HTML -->

                    <span class="pink-color">ID: <?= $row['pro_id'] ?></span>
                    <br>
                    <b>
                        <h5 class="pink-color2"><?= $row['pro_name'] ?>
                    </b></h5>


                    ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท<br>

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
  mysqli_close($conn);
  ?>

        </div>
    </div>

</body>

</html>