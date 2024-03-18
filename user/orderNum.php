<?php
session_start();
include 'condb.php';

$sql = "SELECT * FROM tb_order WHERE orderID = '" . $_SESSION["order_id"] . "'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    p {
        font-size: large;
    }

    body {
        background-color: #F5F5F5;
    }

    .content {
        width: 1300px;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }
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
                <h4><strong>เลขที่ใบสั่งซื้อ:</strong> <?= $rs['orderID'] ?> </i></h4> <br>
                <p><strong>ชื่อ-นามสกุล:</strong> <?= isset($_SESSION["fullname"]) ? $_SESSION["fullname"] : "" ?></p>
                <p><strong>ที่อยู่จัดส่ง:</strong> <?= isset($_SESSION["address"]) ? $_SESSION["address"] : "" ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?= isset($_SESSION["telephone"]) ? $_SESSION["telephone"] : "" ?>
                </p>
            </div>
        </div>
        <div class="card md-4 mt-4">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>รูปสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาสินค้า</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคารวม</th>
                        </tr>
                    </thead>


                    <?php
                   $sql1 = "SELECT d.pro_id, p.pro_name, p.image, d.orderPrice, d.orderQty, d.Total 
                   FROM order_detail d 
                   JOIN product p ON d.pro_id = p.pro_id 
                   WHERE d.orderID = '" . $_SESSION["order_id"] . "'";

                $sql="SELECT * FROM product p,type t WHERE p.type_id=t.type_id";
                    $result1 = mysqli_query($conn,$sql1);
                    while($row=mysqli_fetch_array($result1)){
                    ?>
                    <tr>
                        <td><?=$row['pro_id']?></td>
                        <td class="highlight-on-hover">
                            <img src="img/<?=$row['image']?>" width="100px" height="100">
                        </td>

                        <td><?=$row['pro_name']?></td>
                        <td><?=$row['orderPrice']?></td>
                        <td><?=$row['orderQty']?></td>
                        <td><?=$row['Total']?></td>
                    </tr>
                    <?php
                    }
                    ?>

                </table>
                <h6 class="text-end"> รวมเป็นเงิน <?=number_format($total_price,2)?> บาท</h6>
            </div>
        </div>
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="window.location.href = 'select_pay.php';">จ่ายเงิน</button>
        </div>
    </div>
</body>

</html>