<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("location:login.php");
    exit();
}

include 'condb.php';

$idpro = ''; // Initialize $idpro
if (isset($_GET['id'])) {
    $idpro = $_GET['id'];
    // Proceed with the logic for $idpro if needed
} else {
    // Handle the case where 'id' is not set or invalid
}

// Fetch product details for editing
$sql1 = "SELECT * FROM product WHERE pro_id='$idpro'";
$result = mysqli_query($conn, $sql1);
$rs = mysqli_fetch_array($result);
$p_typeID = $rs['type_id'];

// Handle form submission for updating product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $proid = $_POST['proid'];
    $pname = $_POST['pname'];
    $detail = $_POST['detail'];
    $typeID = $_POST['typeID'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $set_product = $_POST['set_product']; // Retrieve the new product type

    // Update product details in the database
    $sql_update = "UPDATE product SET pro_name='$pname', detail='$detail', type_id='$typeID', price='$price', amount='$num', set_product='$set_product' WHERE pro_id='$proid'";
    if (mysqli_query($conn, $sql_update)) {
        // Success message or redirection
    } else {
        // Error handling
    }
}
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
                                        <input type="text" name="pname" class="form-control"
                                            value=<?= $rs['pro_name'] ?>>
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
                                        <input type="number" name="price" class="form-control"
                                            value=<?= $rs['price'] ?>>
                                        <br>
                                        <label>จำนวนสินค้าคงเหลือ :</label>
                                        <input type="number" name="num" class="form-control" value=<?= $rs['amount'] ?>>
                                        <label>ประเภทเซ็ทสินค้า :</label>
                                        <select class="form-select" name="set_product"
                                            aria-label="Default select example">
                                            <option value="h">เซ็ทหัวใจ</option>
                                            <option value="b">เซ็ทผีเสื้อ</option>
                                            <option value="m">เซ็ทอวกาศ</option>
                                            <option value="p">เซ็ทไข่มุก</option>
                                            <option value="o">เซ็ทอื่นๆ</option>
                                        </select><br>
                                        <br>
                                        <label>รูปภาพสินค้า :</label>
                                        <img src="image/<?= $rs['image'] ?>" width="120"> <br><br>
                                        <input type="file" name="file1" required> <br><br>
                                        <input type="hidden" name="txtimg" class="form-control"
                                            value=<?= $rs['image'] ?>>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>