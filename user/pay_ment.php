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
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 10px;
        }

        .content {
            margin-left: auto;
            margin-right: auto;
            width: auto;
            /* Adjust the width as needed */
        }

        /* Your existing CSS styles */
        .alert-success {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }

        .border {
            padding: 30px;
            border-radius: 5px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            background: #fff;
            max-width: 500px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }



        .payform {
            max-width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include  'menu.php'; ?>
    <h2>แจ้งชำระเงิน</h2>
    <div class="content">
        <div class="col">
            <div class="border">
                <form method="POST" action="pay_ment.php">
                    <label>เลขที่ใบสั่งซื้อ :</label>
                    <input class="width" type="text" name="keyword">
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
        <div class="col">
            <form class="payform" method="POST" action="insertPayment.php" enctype="multipart/form-data">
                <label class="mt-4">เลขที่ใบสั่งซื้อ :</label>
                <input class="width" type="text" name="order_id" required value="<?= $order_id ?>"><br>
                <label class="mt-4">ชื่อ-นามสกุล (ลูกค้า) :</label>
                <textarea class="form-control" name="cusName" required rows="1"><?= $cusname ?></textarea>
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

</body>

</html>