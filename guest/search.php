<?php include 'condb.php';?>

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
        <div class="row">
            <?php
            $pname = $_POST["pname"];
            $sql = "SELECT * FROM product WHERE pro_name LIKE '%$pname%' ORDER BY pro_name ASC";
            $result = mysqli_query($conn, $sql);

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-sm-3">
                <div class="text-center">
                    <img src="img/<?= $row['image'] ?>" width="200px" height="220" class="mt-5 p-2 my-2 border"> <br>
                    ID: <?=$row['pro_id']?> <br>
                    <b>
                        <h5 class="text-success"> <?= $row['pro_name'] ?>
                    </b></h5>
                    ราคา <b class="text-danger"><?= number_format($row['price']) ?> </b> บาท <br>
                    <a class="btn btn-outline-success mt-3" href="sh_product_detail.php?id=<?= $row['pro_id'] ?>">
                        รายละเอียดสินค้า </a>

                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="alert alert-danger">
                <b>ไม่พบรายชื่อข้อมูล!!</b>
            </div>
            <?php
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

</body>

</html>