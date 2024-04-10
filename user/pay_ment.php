<?php
include 'condb.php';
session_start();
$order_id = ""; // Initialize the variable to hold order ID
$cusname = ""; // Initialize the variable to hold customer name
$total = 0; // Initialize the variable to hold total price

// Check if orderID is provided in the URL
if (isset($_GET['orderID'])) {
    $order_id = $_GET['orderID'];
    // Fetch order details from the database based on orderID
    $sql = "SELECT * FROM tb_order WHERE orderID='$order_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Assign fetched values to variables
        $cusname = $row['cus_name'];
        $total = $row['total_price'];
    } else {
        // Handle case where orderID doesn't exist
        $_SESSION['error'] = "ไม่พบข้อมูลเลขที่ใบสั่งซื้อ!!!";
        // Redirect back to history.php or any desired page
        header("Location: history.php");
        exit(); // Stop further execution
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

    .but {
        padding: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: center;

    }

    .form-check {
        margin-right: 10px;
        border: 2px solid #6633CC;
        border-radius: 10px;
        padding: 20px 30px;
        background-color: transparent;
        color: #000000;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 200px;
        height: 60px;

    }

    .form-check:hover {
        background-color: #6633CC;
        color: #000000;
        color: white;
    }
    </style>
</head>

<body>
    <?php include  'menu.php'; ?>
    <h2>การชำระเงิน</h2>
    <div class="content">
        <div class="col">
            <div class="but">
                <form class="form-check form-check-inline" method="post" action="insertPayment.php"
                    enctype="multipart/form-data">
                    <input type="radio" class="form-check-input" name="payment_option" id="scanOption"
                        value="สแกนคิวอาร์โค้ด">
                    <label class="form-check-label" for="scanOption">สแกนคิวอาร์โค้ด</label>


                </form>
                <form class="form-check form-check-inline" method="post" action="insertPayment.php"
                    enctype="multipart/form-data">
                    <input type="radio" class="form-check-input" name="payment_option" id="bankOption"
                        value="โอนผ่านบัญชีธนาคาร">
                    <label class="form-check-label" for="bankOption">บัญชีธนาคาร</label>

                </form>
            </div>

        </div>
        <style>

        </style>
        <div id="scanContent" style="display: none;">
            <div class="card">
                <h2>Scan QR Code Payment</h2>
                <img src="img/คิวอาร์โค้ด01.jpg" alt="QR Code">
                <p>Please scan the QR code to proceed with the payment.</p>
            </div>
            <style>
            .card {
                margin-top: 30px;
                width: 400px;
                margin-left: auto;
                margin-right: auto;
            }

            h2 {
                text-align: center;
            }

            .card img {
                display: block;
                margin: 0 auto;
                max-width: 300px;
                height: auto;
            }

            .card p {
                text-align: center;
                margin-top: 20px;
            }

            .scan-img {
                background-color: #E18AAA;
                border: none;
                border-radius: 5px;
                height: 48px;
                color: #ffff;
                font-size: large;
                cursor: pointer;
                margin-top: 10px;
            }

            .scan-img:hover {
                background-color: #E4A0B7;
            }
            </style>
        </div>

        <div id="bankContent" style="display: none;">
            <div class="cont">
                <div class="card01">
                    <img src='img/กสิกร.jpg' alt='รูปบัญชีธนาคาร'>
                    <div class='account-details'>
                        <p> บัญชีธนาคารกสิกรไทย </p>
                        <p>ชื่อบัญชี: วรัชยา บุญมาเลิศ </p>
                        <p>เลขที่บัญชี:
                            <a for="account_number_1" id="account_number_1"> 1234567890</a>
                        </p>
                        <p><button class="copy" href="#"
                                onclick="copyAccountNumber('account_number_1')">คัดลอกเลขที่บัญชี</button></p>
                    </div>
                </div>
                <div class="card01">
                    <img src='img/ไทยพาณิชย์.jpg' alt='รูปบัญชีธนาคาร'>
                    <div class='account-details'>
                        <p> บัญชีธนาคารไทยพาณิชย์</p>
                        <p>ชื่อบัญชี: ศราวุธ แก้วจันทร์เพ็ง </p>
                        <p>เลขที่บัญชี:
                            <a for="account_number_2" id="account_number_2"> 4092152190</a>
                        </p>
                        <p><button class="copy" href="#"
                                onclick="copyAccountNumber('account_number_2')">คัดลอกเลขที่บัญชี</button></p>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .cont {
            display: flex;
            width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: none;

        }

        .card01 {
            display: flex;
            flex-direction: row;
            width: 550px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
        }

        .card01 img {
            width: 100px;
            height: 100px;
            margin-top: 20px;
            margin-left: 20px;
            border-radius: 10px;
        }

        .account-details {
            font-size: 16px;
            margin-top: 10px;
            margin-left: 50px;
        }

        .copy {
            background-color: #ffff;
            color: #EB4343;
            border: 1px solid #EB4343;
            border-radius: 5px;
            width: 140px;
            height: 30px;
        }

        .copy:hover {
            background-color: #EB4343;
            color: #ffff;
        }
        </style>

    </div>
    <script>
    document.getElementById('scanOption').addEventListener('click', function() {
        document.getElementById('scanContent').style.display =
            'block';
        document.getElementById('bankContent').style.display = 'none';
    });

    document.getElementById('bankOption').addEventListener('click', function() {
        document.getElementById('scanContent').style.display =
            'none';
        document.getElementById('bankContent').style.display = 'block';
    });

    function copyAccountNumber(accountId) {
        var accountNumber = document.getElementById(accountId).innerText;
        var tempInput = document.createElement("input");
        tempInput.setAttribute("value", accountNumber);
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("คัดลอกเลขที่บัญชีแล้ว: " + accountNumber);
    }
    </script>

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