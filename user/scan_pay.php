<?php

include 'condb.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code Payment</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .card {
        margin-top: 30px;
        width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .content {
        background-color: #fff;
        padding: 20px;
        text-align: center;
    }

    h2 {
        text-align: center;
    }

    img {
        display: block;
        margin: 0 auto;
        max-width: 300px;
        height: auto;
    }

    p {
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
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="content">
        <div class="card">
            <h2>Scan QR Code Payment</h2>
            <img src="img/คิวอาร์โค้ด01.jpg" alt="QR Code">
            <p>Please scan the QR code to proceed with the payment.</p>
        </div>
        <input class="scan-img" type="submit" value="อัพโหลดใบเสร็จจ่ายเงิน"
            onclick="window.location.href = 'pay_ment.php';">
    </div>
</body>

</html>