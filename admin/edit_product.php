<?php
session_start();
if (!isset ($_SESSION["id"])) {
    $row = header("location:login.php");
}
?>

<?php include 'condb.php';
$idpro = 'idpro'; // กำหนดค่าเริ่มต้นให้เป็นสตริงว่าง
if (isset ($_GET['id'])) {
    $idpro = $_GET['id'];
    // ทำสิ่งที่ต้องการกับตัวแปร $idpro ที่ได้รับมา
    // เช่น นำไปใช้ในการแก้ไขสินค้าในฐานข้อมูล
} else {
    // ไม่ได้รับค่า 'id' มาใน URL หรือค่า 'id' ไม่ถูกต้อง
    // ดำเนินการที่ควรทำหากไม่มี 'id' หรือค่า 'id' ไม่ถูกต้อง
}
$sql1 = "SELECT * FROM product WHERE pro_id='$idpro'";
$result = mysqli_query($conn, $sql1);
$rs = mysqli_fetch_array($result);
$p_typeID = $rs['type_id'];
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

                        <div>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-center">

                                <div class="col-sm-5">

                                    <div class="alert alert-success h4 text-center mb-4" role="alert">
                                        แก้ไขข้อมูลสินค้า
                                    </div>

                                    <form name="form1" method="post" action="update_product.php"
                                        enctype="multipart/form-data">
                                        <label>รหัสสินค้า :</label>
                                        <input type="text" name="proid" class="form-control" readonly
                                            value="<?= htmlspecialchars($rs['pro_id']) ?>"> <br>
                                        <label>ชื่อสินค้า :</label>
                                        <input type="text" name="pname" class="form-control" value=<?= $rs['pro_name'] ?>>
                                        <br>
                                        <label>รายละเอียดสินค้า :</label>
                                        <textarea class="form-control" required placeholder="รายละเอียดสินค้า..."
                                            name="detail" rows="3"></textarea> <br>
                                        <label>ประเภทสินค้า :</label>
                                        <select class="form-select" name="typeID">
                                            <?php
                                            $sql = "SELECT * FROM type ORDER BY type_name";
                                            $hand = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($hand)) {
                                                $ttypeID = $row['type_id'];
                                                ?>
                                                <option value="<?= $row['type_id'] ?>" <?php if ($p_typeID == $ttypeID) {
                                                    echo "selected=selected";
                                                } ?>>
                                                    <?= $row['type_name'] ?>
                                                </option>
                                            <?php
                                            }
                                            mysqli_close($conn);
                                            ?>

                                        </select>

                                        <br>
                                        <label>ราคาสินค้า :</label>
                                        <input type="number" name="price" class="form-control" value=<?= $rs['price'] ?>>
                                        <br>
                                        <label>จำนวนสินค้าคงเหลือ :</label>
                                        <input type="number" name="num" class="form-control" value=<?= $rs['amount'] ?>>
                                        <br>
                                        <label>รูปภาพสินค้า :</label>
                                        <img src="image/<?= $rs['image'] ?>" width="120"> <br><br>
                                        <input type="file" name="file1" required> <br><br>
                                        <input type="hidden" name="txtimg" class="form-control" value=<?= $rs['image'] ?>>
                                        <br>

                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-danger" href="show_product.php" role="button">Cancel</a>
                                        <br><br>

                                    </form>

                                </div>

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