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
    <style>
    .form-ct {
        width: 50px;
    }

    .bt {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #f893b5;
        border: none;
        border-radius: 5px;
    }
    </style>
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
            $remaining_quantity = $row['amount'];
            ?>
            <div class="col-md-4">
                <div class="highlight-on-hover">
                    <img src="img/<?= $row['image'] ?>" width="350px" class="mt-5 p-2 my-2 border img-fluid">
                </div>
            </div>

            <div class="col-md-6">
                <b>
                    <h5 class="pink-color2"><?= $row['pro_name'] ?>
                </b></h5>
                ประเภทสินค้า: <?= $row['type_name'] ?><br>
                รายละเอียดสินค้า: <?= $row['detail'] ?><br>
                ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท<br>
                จำนวนที่เหลือ: <?= $remaining_quantity ?> ชิ้น<br>

                <!-- เพิ่มปุ่ม บวกและลบตัวเลขจำนวน -->
                <div class="quantity mt-3">
                    <button class="bt btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                    <input type="text" id="quantity" value="1" class="form-ct text-center" readonly>
                    <button class="bt btn-outline-secondary" onclick="increaseQuantity()">+</button>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert library -->
                <script>
                function increaseQuantity() {
                    var quantityInput = document.getElementById('quantity');
                    var quantity = parseInt(quantityInput.value);
                    if (quantity < <?= $remaining_quantity ?>) {
                        quantityInput.value = quantity + 1;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ไม่สามารถเพิ่มจำนวนได้ เนื่องจากสินค้ามีจำนวนไม่เพียงพอ',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                }

                function decreaseQuantity() {
                    var quantityInput = document.getElementById('quantity');
                    var quantity = parseInt(quantityInput.value);
                    if (quantity > 1) {
                        quantityInput.value = quantity - 1;
                    }
                }
                </script>

                <a class="btn btn-outline-success mt-3" href="order.php?id=<?= $row['pro_id'] ?>">Add cart</a>
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
            </style>

            </style>
            <div class="footer">
                <h3>เซ็ตคู่สินค้า</h3>
                <div class="row">
                    <?php
                    // Query to get one product of each type except the current one
                    $similar_products_sql = "SELECT * FROM type
                                LEFT JOIN (SELECT * FROM product WHERE pro_id IN (SELECT MIN(pro_id) FROM product GROUP BY type_id)) AS p
                                ON type.type_id = p.type_id
                                WHERE type.type_id != (SELECT type_id FROM product WHERE pro_id = '$ids')";
                    $similar_products_result = mysqli_query($conn, $similar_products_sql);
                    while ($similar_product_row = mysqli_fetch_assoc($similar_products_result)) {
                        echo '<div class="highlight-on-hover col-md-3">';
                        echo '<img src="img/' . $similar_product_row['image'] . '" width="60%" class="mt-2 p-2 border img-fluid">';
                        echo '<p>' . $similar_product_row['pro_name'] . '</p>';

                        // Check if the product is available
                        if ($similar_product_row['amount'] > 0) {
                            echo '<a class="btn btn-outline-success mt-3 mb-3" href="order.php?id=' . $similar_product_row['pro_id'] . '">เพิ่มลงในตะกร้า</a>';
                        } else {
                            echo '<button class="btn btn-danger mt-3 mb-3" disabled>สินค้าหมด</button>';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>




        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>