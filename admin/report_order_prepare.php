<?php
session_start();
if (!isset($_SESSION["id"])) {
    $row = header("location:login.php");
}
?>

<?php include 'condb.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include 'menu1.php'; ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <div class="card mb-4 mt-4">
                    <div class="card-header">

                        <br>
                        <style>
                        .btn-warning {
                            background-color: orange;
                            color: white;
                        }

                        .btn-success {
                            background-color: green;
                            color: white;
                        }

                        .btn-info {
                            background-color: #191970;
                            color: white;
                        }

                        .btn-danger {
                            background-color: red;
                            color: white;
                        }

                        .btn-pp {
                            background-color: #FF6600;
                            color: white;
                        }

                        .btn-deli {
                            background-color: violet;
                            color: white;
                        }

                        .btn-check {
                            background-color: #FF1493;
                            color: white;
                        }
                        </style>

                        <a href="report_order.php"><button type="button"
                                class="btn btn-warning">รอการดำเนินการ</button></a>
                        <a href="report_order_yes.php"><button type="button"
                                class="btn btn-success">ชำระเงินแล้ว</button></a>
                        <a href="report_order_prepare.php"><button type="button"
                                class="btn btn-pp">จัดเตรียมสินค้า</button></a>
                        <a href="report_order_waitsend.php"><button type="button"
                                class="btn btn-deli">รอการจัดส่ง</button></a>
                        <a href="report_order_send.php"><button type="button"
                                class="btn btn-info">จัดส่งแล้ว</button></a>
                        <a href="report_order_no.php"><button type="button"
                                class="btn btn-danger">ยกเลิกการสั่งซื้อ</button></a>

                        <br><br>
                        <i class="fas fa-table me-1"></i>
                        แสดงข้อมูลการสั่งซื้อสินค้า (รอการจัดเตรียมสินค้า)
                        <div>

                        </div>

                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>เลขที่ใบสั่งซื้อ</th>
                                        <th>ลูกค้า</th>
                                        <th>ที่อยู่จัดส่งสินค้า</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ราคารวมสุทธิ</th>
                                        <th>วันที่สั่งซื้อ</th>
                                        <th>สถานะการสั่งซื้อ</th>
                                    </tr>
                                </thead>

                                <tfoot>

                                </tfoot>
                                <?php
                                $sql = "select * from tb_order where  order_status='4' order by reg_date DESC";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $status = $row['order_status'];
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['orderID'] ?>
                                    </td>
                                    <td>
                                        <?= $row['cus_name'] ?>
                                    </td>
                                    <td>
                                        <?= $row['address'] ?>
                                    </td>
                                    <td>
                                        <?= $row['telephone'] ?>
                                    </td>
                                    <td>
                                        <?= $row['total_price'] ?>
                                    </td>
                                    <td>
                                        <?= $row['reg_date'] ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($status == 1) {
                                                echo "รอการชำระเงิน";
                                            } else if ($status == 4) {
                                                echo "<b style='color:green'> จัดเตรียมสินค้า </b>";
                                            } else if ($status == 0) {
                                                echo "<b style='color:red'> ยกเลิกการสั่งซื้อ </b>";
                                            }
                                            ?>

                                    </td>
                                    <td><a href="report_order_predetail.php?id=<?= $row['orderID'] ?>"
                                            class="btn btn-success">รายละเอียด</a></td>


                                </tr>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
    </div>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>