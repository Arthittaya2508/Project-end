<?php
include 'condb.php';
session_start();
$order_id = "";
$cusname = "";
$total = 0;


if (isset($_POST['btn1'])) {
    $key_word = $_POST['keyword'];
    if ($key_word != "") {
        $sql = "SELECT * FROM tb_order WHERE orderID='$key_word'";
        unset($_SESSION['error']);
        $hand = mysqli_query($conn, $sql);
        $num1 = mysqli_num_rows($hand);

        if ($num1 == 0) {
            $_SESSION['error'] = "ไม่พบข้อมูลเลขที่ใบสั่งซื้อ!!!";
        } else {
            $row = mysqli_fetch_array($hand);
            $order_id = $row['orderID'];
            $cusname = $row['cus_name'];
            $total = $row['total_price'];
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกเลขที่ใบสั่งซื้อ!!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="alert alert-success mt-4" role="alert">
                    แจ้งการชำระเงิน
                </div>
                <!-- ฟอร์มค้นหาเลขที่ใบเสร็จ -->
                <div class="border mt-5 p-2 my-2" style="background-color: #f0f0f5;">
                    <form method="POST" action="pay_ment.php">
                        <label>เลขที่ใบสั่งซื้อ :</label>
                        <input type="text" name="keyword">
                        <button type="submit" name="btn1" class="btn btn-primary">ค้นหา</button>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo " <div class='text-danger'> ";
                            echo $_SESSION['error'];
                            echo " </div> ";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="insertPayment.php" enctype="multipart/form-data">
                    <label class="mt-4">เลขที่ใบสั่งซื้อ :</label>
                    <input type="text" name="order_id" required value="<?=$order_id?>">
                    <label class="mt-4">ชื่อ-นามสกุล (ลูกค้า) :</label>
                    <textarea class="form-control" name="cusName" required rows="1"><?=$cusname?></textarea>
                    <label class="mt-4">จำนวนเงิน :</label>
                    <input type="text" class="form-control" name="total_price" required value="<?= number_format($total, 2) ?>">
                    <label class="mt-4">วันที่โอนเงิน :</label>
                    <input type="date" class="form-control" name="pay_date" required>
                    <label class="mt-4">เวลาที่โอนเงิน :</label>
                    <input type="time" class="form-control" name="pay_time" required>
                    <label class="mt-4">หลักฐานการชำระเงิน :</label>
                    <input type="file" class="form-control" name="file1" required><br>
                    <button type="submit" name="btn2" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
