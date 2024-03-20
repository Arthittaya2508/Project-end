<?php
include 'condb.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        body {

            background-color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content {
            background-color: #FFC0CB;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 100px;
        }

        h2 {
            color: #333;
            text-align: center;
            /* เพิ่มส่วนนี้เพื่อจัดให้ตรงกลาง */
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="content">
        <h2>ติดต่อเรา</h2>

        <p>เรามีช่องทางติดต่อมากมาย โปรดเลือกช่องทางที่คุณต้องการ:</p>

        <ul>
            <li><i class="fab fa-facebook-square"></i>: <a href="https://www.facebook.com/profile.php?id=100007679432823" target="_blank"></i> คลิกที่นี่</a>
            </li>
            <li><i class="fab fa-line"></i>: jayping02</li>
            <li><i class="fas fa-phone"></i>: <a href="tel:0990806892"> 0990806892</a></li>
            <li><i class="far fa-envelope"></i>: <a href="mailto:sarawutohm437@gmail.com"> sarawutohm437@gmail.com</a>
            </li>
        </ul>

    </div>

</body>

</html>