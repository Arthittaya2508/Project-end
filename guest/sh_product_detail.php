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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php
            $ids = $_GET['id'];
            $sql = "SELECT * FROM product
      LEFT JOIN type ON product.type_id = type.type_id
      WHERE product.pro_id='$ids'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            // Get remaining quantity
            $amount = $row['amount'];
            ?>
            <div class="col-md-4">
                <div class="highlight-on-hover">
                    <img src="img/<?= $row['image'] ?>" width="350px" class="mt-5 p-2 my-2 border img-fluid">
                </div>
            </div>

            <div class="col-md-6">
                <b>
                    <h5 class="pink-color2"><?= $row['pro_name'] ?>
                    </h5>
                </b>
                ประเภทสินค้า :<?= $row['type_name'] ?> <br>
                รายละเอียดสินค้า :<?= $row['detail'] ?> <br>
                ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท <br>
                <span class="qt"> จำนวนที่เหลือ: <?= $amount ?> ชิ้น </span> <br>
                <button class="btn btn-outline-success mt-3" onclick="showAlert()"> Add cart </button>
            </div>
            <style>
                .footer {
                    text-align: center;
                    margin-top: 20px;

                }

                .highlight-on-hover {
                    transition: transform 0.3s ease;

                }

                .highlight-on-hover:hover {
                    transform: scale(1.1);

                }

                .footer .row {
                    justify-content: center;

                }

                .footer .row .highlight-on-hover {
                    width: 300px;
                    margin: 10px;
                }

                .footer .row .highlight-on-hover img {
                    max-width: 100%;
                    height: auto;
                }

                .footer .row .highlight-on-hover p {
                    margin-top: 10px;
                }

                .qt {
                    color: brown;
                }
            </style>

            </style>
            <div class="footer">
                <h3>เซ็ตคู่สินค้า</h3>
                <div class="row">
                    <?php
                    // Query to get three products of the same set
                    $set_products_sql = "SELECT * FROM product WHERE set_id = (SELECT set_id FROM product WHERE pro_id = '$ids') AND pro_id != '$ids' LIMIT 3";
                    $set_products_result = mysqli_query($conn, $set_products_sql);
                    while ($set_product_row = mysqli_fetch_assoc($set_products_result)) {
                        echo '<div class="highlight-on-hover col-md-3">';
                        echo '<img src="img/' . $set_product_row['image'] . '" width="60%" class="mt-2 p-2 border img-fluid">';
                        echo '<p>' . $set_product_row['pro_name'] . '</p>';

                        // Check if the product is available
                        if ($set_product_row['amount'] > 1) {
                            echo '<a class="btn btn-outline-success mt-3 mb-3"  onclick="showAlert()">เพิ่มลงในตะกร้า</a>';
                        } else {
                            echo '<button class="btn btn-danger mt-3 mb-3"   disabled>สินค้าหมด</button>';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <script>
                function showAlert() {
                    Swal.fire({
                        title: 'กรุณาเข้าสู่ระบบ',
                        text: 'กรุณาเข้าสู่ระบบหรือลงทะเบียนก่อนทำการสั่งซื้อสินค้า',
                        icon: 'warning',
                        showClass: {
                            popup: 'animate__animated animate__fadeInUp animate__faster'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutDown animate__faster'
                        }
                    });
                }
            </script>

        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>