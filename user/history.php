<?php
include 'condb.php';
session_start();

// ดึงข้อมูลคำสั่งซื้อทั้งหมดจากฐานข้อมูล
$sql99 = "SELECT o.orderID, m.id, o.cus_name, o.address, o.total_price, o.reg_date, o.order_status
        FROM tb_order o
        INNER JOIN member m ON cus_id = id
        ORDER BY o.reg_date DESC";
$result99 = mysqli_query($conn, $sql99);
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

        .content {
            padding: 20px;

        }

        .table {
            background-color: #fff;
            border-radius: 5px;
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .table th,
        .table td {
            border-top: none;
        }

        .table th {
            background-color: #E6E6FA;
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
    <?php include 'menu.php'; ?>
    <div class="content">

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
                        <th>สถานะ</th>
                        <th>รายละเอียด</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    // วนลูปแสดงข้อมูลคำสั่งซื้อทั้งหมด
                    while ($row99 = mysqli_fetch_assoc($result99)) {
                        echo "<tr>";
                        echo "<td>" . $row99['orderID'] . "</td>";
                        echo "<td>" . $row99['cus_name'] . "</td>";
                        echo "<td>" . $row99['address'] . "</td>";
                        echo "<td>" . $row99['reg_date'] . "</td>";
                        echo "<td>" . $row99['total_price'] . "</td>";
                        $status = "";
                        switch ($row99['order_status']) {
                            case 0:
                                $status = "<span class='text-danger'>ยกเลิก</span>";
                                break;
                            case 1:
                                $status = "<span class='text-warning'>ยังไม่ชำระเงิน</span>";
                                break;
                            case 2:
                                $status = "<span class='text-success'>ชำระเงินแล้ว</span>";
                                break;
                            case 3:
                                $status = "<span class='text-info'>ส่งสินค้าเรียบร้อย</span>";
                                break;
                            default:
                                $status = "ไม่ทราบสถานะ";
                        }
                        echo "<td>" . $status . "</td>";
                        echo '<td><a class="btn btn-primary" href="history_order_detail.php?orderID=' . $row99['orderID'] . '" role="button">รายละเอียด</a></td>';
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>