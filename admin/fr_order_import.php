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
    <title>เพิ่มข้อมูลการสั่งซื้อสินค้า</title>
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
                        <div></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col">

                                    <div class="alert alert-primary h4 text-center mb-4 mt-4 " role="alert">
                                        เพิ่มข้อมูลการสั่งซื้อสินค้า
                                    </div>

                                    <form name="form1" method="POST" action="insert_order_import.php"
                                        enctype="multipart/form-data" onsubmit="return false;">

                                        <!-- <label for="import_date">วันที่สั่งซื้อ :</label>
                                        <input type="date" id="import_date" name="import_date"><br><br> -->

                                        <label>เลือกประเภทสินค้า :</label>
                                        <select class="form-select" name="typeID" id="typeID" onchange="fetchProducts()"
                                            required>
                                            <option value="">กรุณาเลือกประเภทสินค้า</option>
                                            <?php
                                            $sql = "SELECT * FROM type ORDER BY type_name";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?= $row['type_id'] ?>">
                                                <?= $row['type_name'] ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <br>

                                        <label>เลือกสินค้า :</label>
                                        <select class="form-select" name="pro_id" id="pro_id" required>
                                        </select>
                                        <br>

                                        <script>
                                        // สร้าง function fetchProducts สำหรับการดึงข้อมูลสินค้าโดยใช้ AJAX
                                        function fetchProducts() {
                                            var typeID = document.getElementById("typeID")
                                                .value; // รับค่า typeID จาก select element
                                            console.log("typeID: ", typeID); // แสดงค่า typeID ใน console เพื่อตรวจสอบ

                                            var xhttp = new XMLHttpRequest(); // สร้าง XMLHttpRequest object
                                            xhttp.onreadystatechange = function() {
                                                if (this.readyState == 4 && this.status == 200) {
                                                    document.getElementById("pro_id").innerHTML = this
                                                        .responseText; // นำข้อมูลที่ได้รับมาแสดงใน select element
                                                }
                                            };
                                            xhttp.open("GET", "select_import.php?typeID=" + typeID,
                                                true
                                            ); // สร้าง request ไปยังไฟล์ select_import.php พร้อมส่งค่า typeID ไปด้วย
                                            xhttp.send(); // ส่ง request
                                        }
                                        </script>

                                        <label>ราคาสินค้า :</label>
                                        <select class="form-select" name="price" required>
                                            <?php
                                            $sql = "SELECT DISTINCT price FROM product ORDER BY price";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?= $row['price'] ?>">
                                                <?= $row['price'] ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <label>จำนวนที่ได้สั่งซื้อ :</label>
                                        <input type="text" name="orderQty" class="form-control"
                                            placeholder="จำนวนที่ได้สั่งซื้อ..." required> <br>

                                        <label>บริษัท :</label>
                                        <input type="text" name="company" class="form-control"
                                            placeholder="ชื่อบริษัท..." required> <br>

                                        <div class="">
                                            <button class="btn btn-primary" onclick="addRow()">เพิ่ม</button>
                                        </div>
                                    </form>

                                    <hr>
                                    <div class="alert alert-primary h4 text-center mb-4 mt-4 " role="alert">
                                        รายการสั่งซื้อสินค้า
                                    </div>
                                    <table id="orderTable" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ชื่อสินค้า</th>
                                                <th scope="col">ประเภทสินค้า</th>
                                                <th scope="col">ราคา</th>
                                                <th scope="col">จำนวนที่สั่ง</th>
                                                <th scope="col">บริษัท</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" name="submit" class="btn btn-success"
                                            onclick="submitForm()">Submit</button>
                                        <a href="fr_order_import.php" class="btn btn-danger">Cancel</a>
                                    </div>

                                    <script>
                                    let orderData = [];

                                    function addRow() {
                                        let proId = document.getElementsByName("pro_id")[0].value;
                                        let typeId = document.getElementsByName("typeID")[0].value;
                                        let price = document.getElementsByName("price")[0].value;
                                        let orderQty = document.getElementsByName("orderQty")[0].value;
                                        let company = document.getElementsByName("company")[0].value;

                                        let newRow = "<tr><td>" + proId +
                                            "</td><td>" + typeId +
                                            "</td><td>" + price +
                                            "</td><td>" + orderQty +
                                            "</td><td>" + company +
                                            "</td><td><button class='btn btn-danger' onclick='deleteRow(this)'>ลบ</button></td></tr>";
                                        document.getElementById("orderTable").innerHTML += newRow;

                                        orderData.push({
                                            proId: proId,
                                            typeId: typeId,
                                            price: price,
                                            orderQty: orderQty,
                                            company: company
                                        });
                                    }

                                    function deleteRow(button) {
                                        let row = button.parentNode.parentNode;
                                        let index = row.rowIndex - 1; // ลบ 1 เนื่องจาก index เริ่มต้นที่ 0
                                        orderData.splice(index, 1);
                                        document.getElementById("orderTable").deleteRow(index + 1); // ลบแถวจากตาราง
                                    }


                                    function submitForm() {
                                        // ส่งข้อมูลที่เพิ่มลงตารางไปยังหน้า insert_order_import.php ด้วย AJAX
                                        let xhr = new XMLHttpRequest();
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    console.log(xhr.responseText);
                                                    // ทำสิ่งที่ต้องการหลังจากส่งข้อมูลสำเร็จ
                                                    alert('เพิ่มข้อมูลการสั่งซื้อสินค้าเรียบร้อยแล้ว');
                                                    window.location = 'Show_order_import.php';
                                                } else {
                                                    // กรณีเกิดข้อผิดพลาด
                                                    alert(
                                                        'เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลการสั่งซื้อสินค้าได้'
                                                    );
                                                }
                                            }
                                        };
                                        xhr.open("POST", "insert_order_import.php", true);
                                        xhr.setRequestHeader("Content-Type", "application/json");
                                        xhr.send(JSON.stringify(orderData));
                                    }
                                    </script>
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