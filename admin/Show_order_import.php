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
                    <div class="card-header alert">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">วันที่สั่งซื้อสินค้า</th>
                                        <th scope="col">เลขที่ใบสั่งซื้อ</th>
                                        <th scope="col">ราคารวม</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <?php
                                $totalQuantity = 0;
                                $totalPrice = 0;
                                $previous_orderID = null; // ตัวแปรเพื่อเก็บ orderID ก่อนหน้า
                                $sql = "SELECT *,
                SUM(Total) AS total_order
                FROM order_import
                LEFT JOIN type ON order_import.typeID = type.type_id
                LEFT JOIN product ON order_import.pro_id = product.pro_id
                GROUP BY orderID"; // ใช้ GROUP BY เพื่อรวม Total ของแต่ละ orderID
                                $hand = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($hand)) {
                                    $totalQuantity += $row['orderQty'];
                                    $totalPrice += $row['total_order']; // ใช้ค่า total_order ที่รวมแล้วแทน Total เดิม

                                    // ตรวจสอบว่า orderID เป็น orderID เดียวกันหรือไม่
                                    if ($row['orderID'] !== $previous_orderID) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['order_import_date'] ?>
                                    </td>
                                    <td>
                                        <?= $row['orderID'] ?>
                                    </td>
                                    <td>
                                        <?= $row['total_order'] ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="show_detail_import.php?orderID=<?= $row['orderID'] ?>"
                                            role="button">รายละเอียด</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    $previous_orderID = $row['orderID']; // อัปเดตค่า orderID เพื่อใช้ในการเปรียบเทียบในรอบต่อไป
                                }
                                ?>
                                <tr>
                                    <td colspan="2"><strong>รวม</strong></td>
                                    <td><strong>
                                            <?= $totalPrice ?>
                                        </strong></td>
                                </tr>
                                <?php
                                mysqli_close($conn);
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>

</html>

<script language="JavaScript">
function Del(mypage) {
    var agree = confirm("คุณต้องการลบข้อมูลหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>

</div>




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