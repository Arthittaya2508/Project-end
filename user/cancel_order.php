<?php
include 'condb.php';
session_start();

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    $sql = "UPDATE tb_order SET order_status = 0 WHERE orderID = $orderID";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("อัปเดตสถานะเรียบร้อย"); window.location.href = "history.php";</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "ไม่พบรหัสคำสั่งซื้อ";
}