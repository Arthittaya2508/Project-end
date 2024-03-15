<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code Payment</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    h2 {
        text-align: center;
    }

    img {
        display: block;
        margin: 0 auto;
        max-width: 55%;
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
        margin-left: 190px;
    }

    .scan-img:hover {
        background-color: #E4A0B7;

    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Scan QR Code Payment</h2>
        <img src="img/คิวอาร์โค้ด.jpg" alt="QR Code">
        <p>Please scan the QR code to proceed with the payment.</p>
        <br><br>
        <input class="scan-img" type="submit" value="อัพโหลดใบเสร็จจ่ายเงิน"
            onclick="window.location.href = 'pay_ment.php';">
    </div>
</body>

</html>