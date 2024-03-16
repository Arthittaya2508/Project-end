<?php

include 'condb.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .container {
        /* background-color: #D3D3D3; */
        padding: 20px;
        max-width: 1300px;
        margin: 0 auto;
    }

    .card {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
    }

    table {
        width: 100%;
        /* ทำให้ตารางขนาดเต็ม */
    }

    th,
    td {
        padding: 10px;
        /* เพิ่มระยะห่างด้านในของเซลล์ของตาราง */
        text-align: center;
        /* จัดข้อความในตารางกลาง */
        border-bottom: 1px solid #ddd;
        /* เพิ่มเส้นขอบด้านล่างของเซลล์ */
    }

    th {
        background-color: #f2f2f2;
        /* สีพื้นหลังของส่วนหัวตาราง */
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" aria-label="Checkbox for following text input"></th>
                        <th></th>
                        <th></th>

                        <th>ราคาต่อชิ้น</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                        <th>บวก-ลบ</th>
                        <th>ลบสินค้า</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $Total = 0;
                    $sumPrice = 0;
                    $m = 1;
                    $sumTotal = 0;

                    if (isset($_SESSION["intLine"])) { //ถ้าไม่เป็นค่าว่างให้ทำงานใน {}

                        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                            if (($_SESSION["strProductID"][$i]) != "") {
                                $sql1 = "select * from product where pro_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                $result1 = mysqli_query($conn, $sql1);
                                $row_pro = mysqli_fetch_array($result1);

                                $_SESSION["price"] = $row_pro['price'];
                                $Total = $_SESSION["strQty"][$i];
                                $sum = $Total * $row_pro['price'];
                                $sumPrice = $sumPrice + $sum;
                                $_SESSION["sum_price"] = $sumPrice;
                                $sumTotal = $sumTotal + $Total;

                    ?>
                    <tr>
                        <td><input type="checkbox" aria-label="Checkbox for following text input"></td>
                        <td><img src="img/<?=$row_pro['image']?>" width="80" height="85" class="border">
                            <?=$row_pro['pro_name']?></td>
                        <td></td>
                        <td><?= $row_pro['price'] ?></td>
                        <td><?= $_SESSION["strQty"][$i] ?></td>
                        <td><?= $sum ?></td>
                        <td>

                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="11" stroke="black" stroke-width="2" fill="none" />
                                <text x="9" y="17" font-family="Arial" font-size="16" fill="black">+</text>
                            </svg>
                            <span>1</span>
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="11" stroke="black" stroke-width="2" fill="none" />
                                <text x="9" y="17" font-family="Arial" font-size="16" fill="black">-</text>
                            </svg>

                        </td>
                        <td><a href="pro_delete.php?Line=<?= $i ?>"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php
                            }
                        }
                    } //endif
                    mysqli_close($conn);
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="5">รวมเป็นเงิน</td>
                        <td class="text-center"><?= number_format($sumPrice); ?></td>
                        <td>บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>