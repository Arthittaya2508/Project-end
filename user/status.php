<?php

include 'condb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Tracking</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    .content {
        margin-top: 20px;
        text-align: center;
    }

    .box {
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
        width: 500px;
        border: none;
    }

    .tracking-form {
        display: inline-block;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .tracking-input {
        padding: 8px;
        width: 400px;
        border-radius: 3px;
        border: none;
        margin-right: 10px;
    }

    .tracking-submit {
        padding: 8px 20px;
        border-radius: 3px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .mid {
        margin-top: 20px;
    }

    .status-bar {
        list-style-type: none;
        padding: 0;
        margin: 0;
        overflow: hidden;
        border-bottom: #ccc solid 1px;
        position: fixed;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        width: fit-content;
    }

    .status {
        display: inline-block;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        cursor: pointer;
    }

    .status:hover {
        background-color: #f5f5f5;
    }

    .status.active {
        background-color: #80B7A2;
        color: white;
    }

    .status.active:hover {
        background-color: #80B7A2;
    }

    .badge {
        background-color: #BFCED6;
        border-radius: 50px;
        font-size: 12px;
        margin-left: 5px;
    }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="content">
        <h2>เช็คสถานะพัสดุ</h2>

        <form class="tracking-form" action="https://trackingwebsite.com/track" method="GET">
            <input class="tracking-input" type="text" name="tracking_number" placeholder="&#x1F50D; กรอกเลขพัสดุ"
                oninput="this.value = this.value.replace(/กากบาท/g, '');">
            <button type="submit" class="tracking-submit">ค้นหา</button>
        </form>


        <div class="mid">
            <ul class="status-bar">
                <li class="status" onclick="setStatusActive(this)">ทั้งหมด<span class="badge badge-primary">15</span>
                </li>
                <li class="status" onclick="setStatusActive(this)">เตรียมจัดส่ง<span
                        class="badge badge-primary">8</span></li>
                <li class="status" onclick="setStatusActive(this)">อยู่ในระหว่างการจัดส่ง<span
                        class="badge badge-primary">4</span></li>
                <li class="status" onclick="setStatusActive(this)">ส่งสินค้าเรียบร้อย<span
                        class="badge badge-primary">3</span>
                </li>
                <li class="status" onclick="setStatusActive(this)">ยกเลิก<span class="badge badge-primary">0</span></li>
            </ul>
        </div>

        <style>
        .status-icon {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
            margin-top: 150px;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;


        }

        .icon {
            width: 80px;
            height: 80px;
            /* position: relative; */
            background-color: #c9f1ff;
            border-radius: 50%;
            margin-left: 80px;
        }

        .icon img {
            width: 80px;
            height: 80px;
            border: 3px solid #c9f1ff;
            border-radius: 50%;
            position: relative;
        }


        .icon:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 100px;
            width: 70px;
            margin-left: 30px;
            border-top: 3px solid #01ace8;
        }
        </style>
        <div class="footer">

            <ul class="status-icon">
                <li class="icon"><img src="img/icons/icon1.png" alt=""></li>
                <li class="icon"><img src="img/icons/icon2.png" alt=""></li>
                <li class="icon"><img src="img/icons/icon3.png" alt=""></li>
                <li class="icon"><img src="img/icons/icon4.png" alt=""></li>
            </ul>
        </div>
    </div>

    <script>
    function setStatusActive(element) {
        // Remove 'active' class from all status items
        var statusItems = document.querySelectorAll('.status');
        statusItems.forEach(function(item) {
            item.classList.remove('active');
        });

        // Add 'active' class to the clicked status item
        element.classList.add('active');
    }
    </script>
</body>

</html>