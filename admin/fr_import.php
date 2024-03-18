<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("location:login.php");
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
    <title>import</title>
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
                                <div class="col">
                                    <div class="alert alert-primary h4 text-center mb-4 mt-4" role="alert">
                                        เพิ่มข้อมูลรับเข้าสินค้า
                                    </div>
                                    <form name="form1" method="POST" action="insert_import.php"
                                        enctype="multipart/form-data">

                                        <input type="text" id="orderID" name="orderID" style="display: none;"><br><br>

                                        <label for="import_date">วันที่นำเข้ารับสินค้า:</label>
                                        <input type="date" id="import_date" name="import_date"><br><br>

                                        <label>รหัสใบสั่งซื้อ :</label>
                                        <!-- <input type="number" name="orderID" class="form-control"
                                            placeholder="รหัสสินค้า..." required>  -->
                                        <?php
                                        // ดึงข้อมูล orderID จากตาราง order_import
                                        $query = "SELECT DISTINCT orderID FROM `order_import`";
                                        $result = mysqli_query($conn, $query);
                                        ?>

                                        <select class="form-select" name="orderID" aria-label="Default select example"
                                            id="orderIDSelect">
                                            <option selected>กรุณาเลือกรหัสสินค้า</option>
                                            <?php
                                            // ตรวจสอบว่ามีข้อมูลที่ได้จากการคิวรี่หรือไม่
                                            if (mysqli_num_rows($result) > 0) {
                                                // วนลูปเพื่อดึงข้อมูลและแสดงในแบบกล่องเลือก
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='" . $row['orderID'] . "'>" . $row['orderID'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>ไม่พบข้อมูล</option>";
                                            }
                                            ?>
                                        </select><br>

                                        <label>ชื่อสินค้า / ประเภทสินค้า:</label>
                                        <div class="form-check" id="productInfo">
                                            <!-- ข้อมูลจะถูกแสดงที่นี่ -->
                                        </div><br>

                                        <!-- ส่วนของ JavaScript -->
                                        <script>
                                            // เมื่อมีการเลือก option จาก select element
                                            document.getElementById("orderIDSelect").addEventListener("change", function () {
                                                var orderID = this.value; // รหัสสั่งซื้อที่ถูกเลือก

                                                // ส่ง request ไปยังไฟล์ PHP เพื่อดึงข้อมูล pro_id และ typeID
                                                var xhr = new XMLHttpRequest();
                                                xhr.onreadystatechange = function () {
                                                    if (xhr.readyState == XMLHttpRequest.DONE) {
                                                        if (xhr.status == 200) {
                                                            // เมื่อได้ข้อมูลกลับมาแสดงใน div ชื่อ productInfo
                                                            document.getElementById("productInfo").innerHTML = xhr.responseText;
                                                        } else {
                                                            // กรณีเกิดข้อผิดพลาดในการร้องขอ
                                                            console.log('เกิดข้อผิดพลาด: ' + xhr.status);
                                                        }
                                                    }
                                                };
                                                // สร้าง request และส่งไปยังไฟล์ PHP ที่จะดึงข้อมูล
                                                xhr.open("GET", "get_product_info.php?orderID=" + orderID, true);
                                                xhr.send();
                                            });
                                        </script>


                                        <label>ชื่อบริษัท:</label>
                                        <input class="form-control" type="text" required placeholder="ชื่อบริษัท:"
                                            name="name_company"> <br>

                                        <input type="submit" name="submit" class="btn btn-success">
                                        <a href="show_product.php" class="btn btn-danger">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
    <!-- ... (closing body tags, scripts, etc.) ... -->
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