<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาจาก AJAX หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(file_get_contents('php://input'))) {
    // รับข้อมูลที่ถูกส่งมาจาก AJAX
    $orderData = json_decode(file_get_contents('php://input'), true);

    // สร้างเลข orderID ใหม่
    $orderID = mt_rand(1000000000, 9999999999);

    // วนลูปเพื่อเพิ่มข้อมูลการสั่งซื้อลงในฐานข้อมูล
    foreach ($orderData as $order) {
        $import_date = $order['import_date'];
        $pro_id = $order['proId'];
        $typeID = $order['typeId'];
        $price = $order['price'];
        $orderQty = $order['orderQty'];
        $company = $order['company'];

        // คำนวณค่ารวม (Total)
        $total = $price * $orderQty;

        // เพิ่มข้อมูลการสั่งซื้อลงในฐานข้อมูล
        $sql = "INSERT INTO order_import (orderID, pro_id, typeID, orderPrice, orderQty, Total, name_company, order_import_date) 
                VALUES ('$orderID', '$pro_id', '$typeID', '$price', '$orderQty', '$total', '$company', now())";
        $result = mysqli_query($conn, $sql);

        // ตรวจสอบว่าคำสั่ง SQL ทำงานสำเร็จหรือไม่
        if (!$result) {
            // กรณีเกิดข้อผิดพลาด
            die('Error: ' . mysqli_error($conn));
        }
    }

    // ส่งข้อความกลับเพื่อแสดงว่าข้อมูลถูกเพิ่มลงในฐานข้อมูลสำเร็จ
    echo 'Data added successfully';
}

mysqli_close($conn);