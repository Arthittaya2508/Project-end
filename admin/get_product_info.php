<?php
// เชื่อมต่อฐานข้อมูล
include 'condb.php';

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// ตรวจสอบว่ามีการส่งค่า orderID มาหรือไม่
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // ดึงข้อมูล pro_id และ typeID จากตาราง order_import
    $query = "SELECT * FROM `order_import`
    LEFT JOIN product ON order_import.pro_id = product.pro_id
    LEFT JOIN type ON order_import.typeID = type.type_id 
    WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $query);

    // ตรวจสอบว่ามีข้อมูลที่ได้จากการคิวรี่หรือไม่
    if (mysqli_num_rows($result) > 0) {
        // แสดงข้อมูลในรูปแบบของ form-check
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input class='form-check-input' type='checkbox' value='" . $row['pro_id'] . "_" . $row['typeID'] . "' name='selected_products[]' id='product_" . $row['pro_id'] . "_" . $row['typeID'] . "'>";
            echo "<label class='form-check-label' for='product_" . $row['pro_id'] . "_" . $row['typeID'] . "'>";
            echo "ชื่อสินค้า: " . $row['pro_name'] . " / ประเภทสินค้า: " . $row['type_name'];
            echo "</label><br>";
        }
    } else {
        // กรณีไม่พบข้อมูล
        echo "ไม่พบข้อมูล";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
?>