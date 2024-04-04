<?php
include 'condb.php';
session_start();
$type_id = '001';
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    body {
        background-color: #FFF0F5;
    }

    .btn {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #FF99FF;
        border: none;
        border-radius: 5px;
    }


    .btn {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #f893b5;
        border: none;
        border-radius: 5px;
    }

    .btn-danger {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #FF0033;
        border: none;
        border-radius: 5px;
    }

    body {
        font-size: 120%;
        background: #f8f8f8;
    }

    /* CSS file or within <style> tags */
    .pink-color {
        color: #f893b5;
    }

    .pink-color2 {
        color: #FF69B4;

    }

    .pink-color3 {
        color: #fac9db;
    }
    </style>

</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <br><br>
        <h2 class="text-center">
            สร้อยคอ
        </h2>
        <div class="row">
            <?php
            // Retrieve products belonging to the specified type
            $sql = "SELECT * FROM product WHERE type_id = '$type_id' ORDER BY pro_id DESC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $amount1 = $row['amount'];
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
                        <img src="img/<?= $row['image'] ?>" width="200px" height="220"
                            class="mt-5 p-2 my-2 border img-fluid">
                    </div>
                    <b>
                        <h5 class="pink-color2"><?= $row['pro_name'] ?>
                    </b></h5>
                    ราคา <b class="text-danger"><?= number_format($row['price'], 2) ?></b> บาท<br>

                    <?php if ($amount1 <= 0) { ?>
                    <a class="btn btn-danger mt-3" href="#"> สินค้าหมด </a>
                    <?php } else { ?>
                    <a class="btn btn-outline-success mt-3 mb-3" href="sh_product_detail.php?id=<?= $row['pro_id'] ?>">
                        รายละเอียดสินค้า
                    </a>
                    <?php
                            // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่

                            if (isset($_SESSION['username'])) {
                                // ถ้าเข้าสู่ระบบแล้ว ให้แสดงปุ่ม Add cart
                                echo '<a class="btn btn-outline-success mt-3" href="order.php?id=' . $row['pro_id'] . '"> Add cart </a>';
                            } else {
                                // ถ้ายังไม่เข้าสู่ระบบ ให้แสดงแจ้งเตือนให้เข้าสู่ระบบ
                                echo '<button class="btn btn-outline-primary mt-3 mb-3" onclick="showAlert()"> เพิ่มลงในตะกร้า </button>';
                            }
                            ?>
                    <!-- Script แสดงแจ้งเตือน -->
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