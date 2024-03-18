<?php
session_start();
include 'condb.php';

// รับค่าไอดีผู้ใช้งานจากฟอร์มที่ส่งมา
$cusID = $_POST['userID'];

$cusName = $_POST['fullname']; // แก้ชื่อฟิลด์ตรงนี้ตามฟอร์มของคุณ
$cusAddress = $_POST['existingAddress']; // แก้ชื่อฟิลด์ตรงนี้ตามฟอร์มของคุณ
$cusTel = $_POST['tel']; // แก้ชื่อฟิลด์ตรงนี้ตามฟอร์มของคุณ

$sql = "INSERT INTO tb_order (cus_id, cus_name, address, telephone, total_price, order_status)
        VALUES ('$cusID', '$cusName', '$cusAddress', '$cusTel', '" . $_SESSION["sum_price"] . "', '1')";
mysqli_query($conn, $sql);

$orderID = mysqli_insert_id($conn);
$_SESSION["order_id"] = $orderID;

for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (($_SESSION["strProductID"][$i]) != "") {
        // Get product data
        $sql1 = "SELECT * FROM product WHERE pro_id = '" . $_SESSION["strProductID"][$i] . "'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $price = $row1['price'];
        $total = $_SESSION["strQty"][$i] * $price;

        $sql2 = "INSERT INTO order_detail (orderID, pro_id, orderPrice, orderQty, Total)
                VALUES ('$orderID', '" . $_SESSION["strProductID"][$i] . "', '$price',
                '" . $_SESSION["strQty"][$i] . "', '$total')";
        if (mysqli_query($conn, $sql2)) {
            // Reduce product stock
            $sql3 = "UPDATE product SET amount = amount - '" . $_SESSION["strQty"][$i] . "'
                    WHERE pro_id = '" . $_SESSION["strProductID"][$i] . "'";
            mysqli_query($conn, $sql3);
        }
    }
}

// Line Notify
// Code for Line Notify goes here

mysqli_close($conn);
unset($_SESSION["intLine"]);
unset($_SESSION["strProductID"]);
unset($_SESSION["strQty"]);
unset($_SESSION["sum_price"]);

// เก็บข้อมูลที่อยู่และเบอร์โทรศัพท์ลงใน session
$_SESSION["fullname"] = $_POST["fullname"];
$_SESSION["address"] = $_POST["existingAddress"]; // หรือจะเปลี่ยนเป็น $_POST["newAddress"] ก็ได้ตามที่ต้องการ
$_SESSION["telephone"] = $_POST["tel"];

// หลังจากนั้นก็เรียกหน้า orderNum.php
header("Location: orderNum.php");
exit();
?>