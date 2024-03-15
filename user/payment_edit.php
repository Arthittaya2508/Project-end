<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h2 {
    color: #333;
}

form {
    max-width: 450px;
    margin: 20px auto;
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input[type="text"],
input[type="time"],
input[type="date"],
input[type="file"],
input[type="submit"] {
    width: 350px;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    justify-content: center;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Optional: Style the file input button */
input[type="file"] {
    padding: 6px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 3px;
}

/* Optional: Style the file input text */
input[type="file"]::-webkit-file-upload-button {
    font-size: 14px;
    font-weight: bold;
    color: #333;
}
</style>

<body>
    <h2>Payment Form</h2>
    <!-- ฟอร์มค้นหาเลขที่ใบเสร็จ -->
    <div class="border mt-5 p-2 my-2">
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

    <form action="insertPayment.php" method="post" enctype="multipart/form-data">
        <label for="cus_name">Full Name:</label><br>
        <input type="text" id="cus_name" name="cus_name"><br>

        <label for="pay_time">Transfer Time:</label><br>
        <input type="time" id="pay_time" name="pay_time"><br>

        <label for="pay_date">Transfer Date:</label><br>
        <input type="date" id="pay_date" name="pay_date"><br>

        <label for="pay_money">Amount:</label><br>
        <input type="text" id="pay_money" name="pay_money"><br>

        <label for="pay_image">Payment Proof:</label><br>
        <input type="file" id="pay_image" name="pay_image"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>