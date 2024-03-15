<!DOCTYPE html>
<html>

<head>
    <title>บัญชีธนาคาร</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    h3 {
        text-align: center;
        margin-top: 20px;
    }

    .up-img {
        display: block;
        /* กำหนดให้ปุ่มเป็น block element */
        margin: 20px auto;
        /* ให้ปุ่มอยู่ตรงกลางของหน้าจอ */
        background-color: #E18AAA;
        border: none;
        border-radius: 5px;
        height: 48px;
        color: #ffff;
        font-size: large;
        justify-content: center;
    }

    .up-img:hover {
        background-color: #E4A0B7;

    }

    .contant {
        display: flex;
        width: 60%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: none;

    }

    .card {
        display: flex;
        flex-direction: row;
        width: 600px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
    }

    .card img {
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
</head>

<body>
    <?php include 'menu.php'; ?>
    <h3>โอนเงินผ่านธนาคาร</h3>
    <div class="contant">

        <div class="card">
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

        <div class="card">
            <img src='img/ไทยพาณิชย์.jpg' alt='รูปบัญชีธนาคาร'>
            <div class='account-details'>
                <p> บัญชีธนาคารไทยพาณิชย์</p>
                <p>ชื่อบัญชี: อาทิตยา ธรรมศิริ </p>
                <p>เลขที่บัญชี:
                    <a for="account_number_2" id="account_number_2"> 4092152190</a>
                </p>
                <p><button class="copy" href="#"
                        onclick="copyAccountNumber('account_number_2')">คัดลอกเลขที่บัญชี</button></p>
            </div>
        </div>
    </div>
    </div>
    </div>
    <input class="up-img" type="submit" value="อัพโหลดใบเสร็จจ่ายเงิน" onclick="window.location.href = 'pay_ment.php';">
    <script>
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

</body>

</html>