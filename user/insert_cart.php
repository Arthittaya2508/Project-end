<?php
session_start();
include 'condb.php';

// // Check if any product is selected before confirming the order
// if (!isset($_SESSION["intLine"]) || $_SESSION["intLine"] <= 0) {
//     echo "<script>alert('กรุณาเลือกสินค้าก่อนยืนยันคำสั่งซื้อ'); window.location='cart.php';</script>";
//     exit; // Stop further execution
// }

$cusName = $_POST['cus_name'];
$cusAddress = $_POST['cus_add'];
$cusTel = $_POST['cus_tel'];
$cusID = $_SESSION["cus_id"];

$sql = "insert into tb_order(cus_name,address,telephone,total_price,order_status)
        values('$cusName','$cusAddress','$cusTel','" . $_SESSION["sum_price"] . "','1')";
mysqli_query($conn, $sql);

$orderID = mysqli_insert_id($conn);
$_SESSION["order_id"] = $orderID;

for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (($_SESSION["strProductID"][$i]) != "") {
        // Get product data
        $sql1 = "select * from product where pro_id ='" . $_SESSION["strProductID"][$i] . "' ";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $price = $row1['price'];
        $total = $_SESSION["strQty"][$i] * $price;

        $sql2 = "insert into order_detail(orderID,pro_id,orderPrice,orderQty,Total)
                values('$orderID','" . $_SESSION["strProductID"][$i] . "','$price',
                '" . $_SESSION["strQty"][$i] . "','$total')";
        if (mysqli_query($conn, $sql2)) {
            // Reduce product stock
            $sql3 = "update product set amount = amount - '" . $_SESSION["strQty"][$i] . "'
                    where pro_id='" . $_SESSION["strProductID"][$i] . "'";
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



include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบและกำหนดค่าตัวแปร session สำหรับชื่อ-นามสกุล, ที่อยู่ และเบอร์โทรศัพท์
    $_SESSION["fullname"] = $_POST["fullname"];

    // ตรวจสอบว่าผู้ใช้เลือกใช้ที่อยู่ที่มีอยู่ในระบบหรือเพิ่มที่อยู่ใหม่
    if ($_POST["addressOption"] == "existing") {
        $_SESSION["address"] = $_POST["existingAddress"];
    } else {
        $_SESSION["address"] = $_POST["newAddress"];
    }

    $_SESSION["telephone"] = $_POST["tel"];

    // Redirect ไปยังหน้า orderNum.php
    header("Location: orderNum.php");
    exit();
}
?>