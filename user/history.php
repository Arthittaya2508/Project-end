<?php
include 'condb.php';
session_start();

// ดึงข้อมูลคำสั่งซื้อทั้งหมดจากฐานข้อมูล
$sql = "SELECT `orderID`, `cus_name`, `address`, `total_price`, `reg_date` FROM `tb_order` ORDER BY `cus_id` ASC";

$result = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติคำสั่งซื้อ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
    }

    .container {
        padding: 20px;
    }

    .table {
        background-color: #fff;
        border-radius: 5px;
    }

    .table th,
    .table td {
        border-top: none;
    }

    .table th {
        background-color: #e1bee7;
        color: #333;

    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-striped tbody tr:hover {
        background-color: #e0e0e0;
    }

    h2 {
        color: #333;
    }
    </style>
</head>

<body>
    <?php include 'menu.php';?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 class="text-center mb-4">ประวัติคำสั่งซื้อ</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>เลขที่ใบสั่งซื้อ</th>
                            <th>ชื่อลูกค้า</th>
                            <th>ที่อยู่จัดส่ง</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>ยอดรวม</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // วนลูปแสดงข้อมูลคำสั่งซื้อทั้งหมด
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['orderID'] . "</td>";
                            echo "<td>" . $row['cus_name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['reg_date'] . "</td>";
                            echo "<td>" . $row['total_price'] . "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>