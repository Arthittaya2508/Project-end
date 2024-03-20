<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("location:login.php");
}
?>

<?php
include 'condb.php';
$orderID = $_GET['orderID'];
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
                    <div class="card-header alert">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="insert_import.php">

                                    <div class="alert alert-success h4" role="alert">
                                        รายละเอียดเลขใบสั่งซื้อ : <?= $orderID ?>
                                    </div>

                                    <table class="table table-striped">
                                        <tr>
                                            <th>ชื่อบริษัท</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ประเภทสินค้า</th>
                                            <th>จำนวนสินค้า</th>
                                            <th>ราคาสินค้า</th>
                                            <th>ราคารวม</th>
                                        </tr>
                                        <?php
                                        $grandTotalPrice = 0; // ตั้งค่าเริ่มต้นให้ราคารวมทั้งหมดเป็น 0

                                        $sql = "SELECT DISTINCT i.name_company, p.pro_name, t.type_name, oi.orderQty, oi.orderPrice, (oi.orderQty * oi.orderPrice) AS orderTotalPrice
                                        FROM import AS i
                                        LEFT JOIN order_import AS oi ON i.orderID = oi.orderID
                                        LEFT JOIN type AS t ON oi.typeID = t.type_id
                                        LEFT JOIN product AS p ON oi.pro_id = p.pro_id
                                        WHERE i.orderID = '$orderID';
                                        ";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <tr>
                                                <td><?= $row["name_company"] ?></td>
                                                <td><?= $row["pro_name"] ?></td>
                                                <td><?= $row["type_name"] ?></td>
                                                <td><?= $row["orderQty"] ?></td>
                                                <td><?= $row["orderPrice"] ?></td>
                                                <td><?= $row["orderTotalPrice"] ?></td> <!-- แสดงราคารวมของรายการนี้ -->
                                            </tr>
                                        <?php
                                            $grandTotalPrice += $row['orderTotalPrice']; // เพิ่มราคารวมของรายการนี้เข้าไปในราคารวมทั้งหมด
                                        }
                                        mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
                                        ?>
                                        <tr>
                                            <td colspan="5"><strong>ราคารวม</strong></td>
                                            <td><strong><?= $grandTotalPrice ?></strong></td>
                                            <!-- แสดงราคารวมทั้งหมด -->
                                        </tr>
                                    </table>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
</main>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>