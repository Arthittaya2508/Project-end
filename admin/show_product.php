<?php
session_start();
if (!isset ($_SESSION["id"])) {
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

                        <div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <form method="POST" action="insert_product.php">

                                    <div class="alert alert-info h4 text-center mb-4 mt-4 " role="alert">
                                        แสดงข้อมูลสินค้า
                                    </div>

                                    <div class="card-body">
                                        <table id="datatablesSimple" class="table table-striped table-hover">
                                            <thead>

                                                <tr>
                                                    <th>รหัสสินค้า</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>รายละเอียดสินค้า</th>
                                                    <th>ประเภทสินค้า</th>
                                                    <th>ราคาสินค้า</th>
                                                    <th>จำนวนสินค้าคงเหลือ</th>
                                                    <th>รูปภาพสินค้า</th>
                                                    <th>แก้ไข</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $sql = "SELECT * FROM product
    LEFT JOIN type ON type.type_id = product.type_id;";
                                            $hand = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($hand)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['pro_id'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['pro_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['detail'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['type_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['price'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['amount'] ?>
                                                    </td>
                                                    <td><img src="image/<?= $row['image'] ?>" width="80px" hieght="100px">
                                                    </td>
                                                    <td><a a href="edit_product.php?id=<?= $row['pro_id'] ?>"
                                                            class="btn btn-success">Edit</a></td>
                                                    <td><a href="delete_product.php?id=<?= $row['pro_id'] ?>"
                                                            class="btn btn-danger"
                                                            onclick="Del(this.href);return false;">Delete</a></td>
                                                </tr>

                                                <?php
                                            }
                                            mysqli_close($conn);
                                            ?>
                                        </table>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>