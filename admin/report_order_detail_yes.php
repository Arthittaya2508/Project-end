<?php
session_start();
if (!isset ($_SESSION["id"])) {
    $row = header("location:login.php");
}
?>

<?php
include 'condb.php';
$ids = $_GET['id'];
$_SESSION["id_order"] = $ids;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>report</title>
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
                        <i class="fas fa-table me-1"></i>
                        แสดงรายการสินค้า
                        <div>
                            <a href="report_order_yes.php"><button type="button"
                                    class="btn btn-success">กลับหน้าหลัก</button>
                            </a>
                        </div>

                        <div class="card-body">
                            <?php
                            $sql_order_info = "SELECT cus_name FROM tb_order WHERE orderID = '$ids'";
                            $result_order_info = mysqli_query($conn, $sql_order_info);
                            $row_order_info = mysqli_fetch_assoc($result_order_info);
                            $cus_name = $row_order_info['cus_name'];
                            ?>
                            <h5>ชื่อผู้สั่ง:
                                <?= $cus_name ?>
                            </h5>
                            <h5>เลขที่ใบสั่งซื้อ :
                                <?= $ids ?>
                            </h5>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวนสินค้า</th>
                                        <th>ราคาสินค้า</th>
                                        <th>ราคารวม</th>

                                    </tr>
                                </thead>

                                <?php
                                $sql = "select tbo.total_price, product.pro_name, od.orderPrice, od.orderQty, od.Total
                                from tb_order as tbo
                                LEFT JOIN order_detail AS od ON tbo.orderID = od.orderID
                                LEFT JOIN product ON od.pro_id = product.pro_id
                                where order_status='2' and od.orderID = '$ids'";
                                $result = mysqli_query($conn, $sql);
                                $sum_total = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $sum_total = $row['total_price'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row['pro_name'] ?>
                                        </td>
                                        <td>
                                            <?= $row['orderQty'] ?>
                                        </td>
                                        <td>
                                            <?= $row['orderPrice'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Total'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                mysqli_close($conn);
                                ?>

                            </table>

                            <b>ราคารวมสุทธิ
                                <?= number_format($sum_total, 2) ?>บาท
                            </b>

                        </div>
                    </div>
                </div>
                <form method="POST" action="update_order_yes.php">
                    <div class="row">
                        <div class="col-md-3">
                            <label>การชำระเงิน</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="2">ชำระเงินเรียบร้อย</option>
                                <option value="3">จัดส่งสินค้าเรียบร้อย</option>
                            </select><br>
                            <label>เลขที่การจัดส่งสินค้า</label>
                            <input type="text" name='idEMS' class="foem-control"><br><br>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>

                </form>
        </main>
        <?php include 'footer.php'; ?>
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
<script>
    function del(mypage) {
        var agree = confirm('คุณต้องการยกเลิกใบสั่งซื้อสินค้าหรือไม่');
        if (agree) {
            window.location = mypage;
        }
    }
    function del1(mypage1) {
        var agree = confirm('คุณต้องการปรับสถานะการชำระเงินหรือไม่');
        if (agree) {
            window.location = mypage1;
        }
    }
</script>