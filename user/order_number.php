<?php
session_start();
include 'condb.php';

// Query ข้อมูลจากฐานข้อมูลโดยใช้เลขที่ใบคำสั่งซื้อจาก session variable
$sql = "SELECT * FROM `tb_order` ORDER BY `tb_order`.`orderID`";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);

// เก็บค่าราคารวมทั้งหมดจากผลลัพธ์ที่ได้จากคิวรี
$total_price = $rs['total_price'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Number</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    /* CSS styles remain unchanged */
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <div class="content">
        <h3 class="text-center">รายละเอียดการสั่งซื้อ</h3>
        <div class="card">
            <div class="card-body">
                <!-- แสดงรายละเอียดการสั่งซื้อ -->
                <h4><strong>เลขที่ใบสั่งซื้อ:</strong> <?= $rs['orderID'] ?></h4> <br>
                <!-- แสดงชื่อ-นามสกุล, ที่อยู่จัดส่ง, เบอร์โทรศัพท์ -->
                <!-- โดยใช้ session variables ที่เก็บข้อมูลจากหน้า address.php -->
                <p><strong>ชื่อ-นามสกุล:</strong> <?= isset($_SESSION["fullname"]) ? $_SESSION["fullname"] : "" ?></p>
                <p><strong>ที่อยู่จัดส่ง:</strong> <?= isset($_SESSION["address"]) ? $_SESSION["address"] : "" ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?= isset($_SESSION["telephone"]) ? $_SESSION["telephone"] : "" ?>
                </p>
            </div>
        </div>
        <!-- แสดงรายการสินค้าที่สั่งซื้อ -->
        <!-- โดยใช้คิวรีข้อมูลจากฐานข้อมูล และวนลูปแสดงผลทุกรายการ -->
        <div class="card md-4 mt-4">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาสินค้า</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- วนลูปแสดงรายการสินค้า -->
                        <?php
                $sql1 = "SELECT d.pro_id, p.pro_name, d.orderPrice, d.orderQty, d.Total FROM order_detail d JOIN product p ON d.pro_id=p.pro_id WHERE d.orderID= '" . $_SESSION["order_id"] . "' ";
                $result1 = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_array($result1)) {
                ?>
                        <tr>
                            <td><?= $row['pro_id'] ?></td>
                            <td><?= $row['pro_name'] ?></td>
                            <td><?= $row['orderPrice'] ?></td>
                            <td><?= $row['orderQty'] ?></td>
                            <td><?= $row['Total'] ?></td>
                        </tr>
                        <?php
                }
                ?>
                    </tbody>
                </table>
                <!-- แสดงราคารวมทั้งหมดของรายการสั่งซื้อ -->
                <h6 class="text-end"> รวมเป็นเงิน <?= number_format($total_price, 2) ?> บาท</h6>
            </div>
        </div>
        <!-- เพิ่มปุ่มจ่ายเงิน ที่เมื่อคลิก จะไปยังหน้า select_pay.php -->
        <div class="text-center">
            <button class="btn btn-primary" onclick="window.location.href = 'select_pay.php';">จ่ายเงิน</button>
        </div>
    </div>
</body>

</html>