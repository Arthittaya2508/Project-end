<?php
  session_start();
if(isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    if($payment_method == 'scan') {
        header("Location: scan_pay.php");
        exit();
    } elseif($payment_method == 'bank_transfer') {
        header("Location: bank_pay.php");
        exit();
    } elseif($payment_method == 'PromptPay') {
        header("Location: promptpay_payment_page.php");
        exit();
    } elseif($payment_method == 'TrueWallet') {
        header("Location: truewallet_payment_page.php");
        exit();
    } else {
        echo "Invalid payment method selected";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกวิธีการชำระเงิน</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    form {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    select {
        width: 80%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>เลือกวิธีการชำระเงิน:</h2>
        <form method="post" class="pay-form">
            <label for="payment_method">Choose Payment Method:</label>
            <select name="payment_method" id="payment_method">
                <option value="scan">สแกนคิวอาร์โค้ด</option>
                <option value="bank_transfer">บัญชีธนาคาร</option>
                <option value="PromptPay">พร้อมเพย์</option>
                <option value="TrueWallet">ทรูวอเล็ท</option>
            </select>
            <br><br>
            <input type="submit" value="ดำเนินการชำระเงิน">
        </form>
    </div>
</body>

</html>