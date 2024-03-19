<?php
session_start();
include 'condb.php';

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// รับค่า typeID จากการร้องขอ
$typeID = $_GET['typeID'];

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าโดยใช้ typeID เป็นเงื่อนไข
$sql = "SELECT * FROM product WHERE type_id = '$typeID' ORDER BY pro_id";
$result = mysqli_query($conn, $sql);

// สร้างตัวเลือกสำหรับ select element
$options = "<option value=''>กรุณาเลือกสินค้า</option>";
while ($row = mysqli_fetch_array($result)) {
    $options .= "<option value='" . $row['pro_id'] . "'>" . $row['pro_name'] . "</option>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);

// ส่งตัวเลือกสินค้ากลับไปยัง JavaScript เพื่อแสดงผลใน select element
echo $options;