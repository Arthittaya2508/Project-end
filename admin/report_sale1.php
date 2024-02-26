<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit(); // ใส่ exit() เพื่อให้โปรแกรมหยุดทำงานทันทีหลังจากเปลี่ยนเส้นทาง
}
?> <!--ต้องมีรหัส admin เท่านั้นถึงจะสามารถเข้าถึงได้ ถ้าเป็นบุคคลทั่วไปไม่สามารถเข้าถึงได้-->

<?php include 'condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Report</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!---เรียกใช้งานเทมเพลสในบูสแต็บ-->
    <link href="css/styles.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="sb-nav-fixed">
    <?php include 'menu1.php'; ?> <!--แยกไฟล์เมนูออกจากตัวและทำการเรียกฟังก์ชันเมนูมาเเทน--->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        รายงานการขายสินค้า

                    </div>

                    <br>
                    <div>
                        <form name="form1" method="POST" action="report_sale.php"> <!--ในส่วนของหน้าวันที่-->
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="date" name="dt1" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="date" name="dt2" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    <!--จะส่งค่าไปค้นหา dt1 and dt2 i ใส่ไอคอน-->
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>เลขที่ใบสั่งซื้อ</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>ลูกค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ที่อยู่จัดส่งสินค้า</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>ราคารวมสุทธิ</th>
                                    <th>ราคาต้นทุน</th>
                                    <th>กำไร</th>
                                </tr>
                            </thead>

                            <!---ดึงข้อมูลมาแสดงผล--->
                            <?php
                            $ddt1 = @$_POST['dt1']; //รับค่าวันที่มา
                            $ddt2 = @$_POST['dt2'];
                            $add_date = date('Y/m/d', strtotime($ddt2 . "+1 days"));

                            if (($ddt1 != "") & ($ddt2 != "")) {
                                echo "ค้นหาจากวันที่ $ddt1 ถึง $ddt2 ";
                                $sql = "SELECT o.orderID, o.reg_date, o.cus_name, o.address, o.telephone, o.total_price,
                           SUM(p.cost) AS total_cost, GROUP_CONCAT(p.pro_name) AS pro_names,
                           GROUP_CONCAT(od.orderQty) AS orderQtys
                    FROM tb_order AS o
                    INNER JOIN order_detail AS od ON o.orderID = od.orderID
                    INNER JOIN product AS p ON od.pro_id = p.pro_id
                    WHERE o.order_status = '2'
                    AND o.reg_date BETWEEN '$ddt1' AND '$add_date'
                    GROUP BY o.orderID, o.reg_date, o.cus_name, o.address, o.telephone, o.total_price
                    ORDER BY o.reg_date DESC";
                            } else {
                                $sql = "SELECT o.orderID, o.reg_date, o.cus_name, o.address, o.telephone, o.total_price,
                           SUM(p.cost) AS total_cost, GROUP_CONCAT(p.pro_name) AS pro_names,
                           GROUP_CONCAT(od.orderQty) AS orderQtys
                    FROM tb_order AS o
                    INNER JOIN order_detail AS od ON o.orderID = od.orderID
                    INNER JOIN product AS p ON od.pro_id = p.pro_id
                    WHERE o.order_status = '2'
                    GROUP BY o.orderID, o.reg_date, o.cus_name, o.address, o.telephone, o.total_price
                    ORDER BY o.reg_date DESC";
                            }

                            $total_profit = 0;
                            $total_sales = 0;

                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_array($result)) {
                                $profit = $row['total_price'] - $row['total_cost'];
                                $total_profit += $profit;
                                $total_sales += $row['total_price'];
                                $pro_names = explode(",", $row['pro_names']);
                                $orderQtys = explode(",", $row['orderQtys']);
                                ?>

                            <tr>
                                <td>
                                    <?= $row['orderID'] ?>
                                </td>
                                <td>
                                    <?= $row['reg_date'] ?>
                                </td>
                                <td>
                                    <?= $row['cus_name'] ?>
                                </td>
                                <td>
                                    <?php
                                    for ($i = 0; $i < count($pro_names); $i++) {
                                        echo '- ' . $pro_names[$i];
                                        if ($i < count($pro_names) - 1) {
                                            echo "<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    for ($i = 0; $i < count($orderQtys); $i++) {
                                        echo $orderQtys[$i];
                                        if ($i < count($orderQtys) - 1) {
                                            echo "<br>";
                                        }
                                    }
                                    ?>
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
                                    <?= $row['total_cost'] ?>
                                </td>
                                <td>
                                    <?= $profit ?>
                                </td>
                            </tr>

                            <?php
                            }
                            mysqli_close($conn);
                            ?>

                        </table>
                        <div class="text-end"><b> รวมราคารวมสุทธิ
                                <?= number_format($total_sales, 2) ?> บาท
                            </b></div>
                        <div class="text-end"><b> รวมกำไรทั้งหมด
                                <?= number_format($total_profit, 2) ?> บาท
                            </b></div>
                    </div>


                </div>
        </main>
        <?php include 'footer.php'; ?> <!--แยกไฟล์footerออกจากตัวและทำการเรียกฟังก์ชันfooterมาเเทน--->

    </div>
    </div>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>