<?php
include 'condb.php';
session_start();

$orderID = $_POST['order_id'];
$totalPrice = $_POST['total_price'];
$payDate = $_POST['pay_date'];
$payTime = $_POST['pay_time'];

//อัพโหลดรูปภาพ
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'b_' . uniqid() . "." . pathinfo(basename($_FILES['file1']['name'], PATHINFO_EXTENSION));
    $image_upload_path = "./img/payment/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}


$sql = "INSERT INTO payment(orderID, pay_money, pay_date, pay_time, pay_image) 
VALUES('$orderID', '$totalPrice', '$payDate', '$payTime', '$new_image_name')";
$result = mysqli_query($conn, $sql);
if ($result) {
    // ทำการอัปเดตสถานะคำสั่งซื้อ และตรวจสอบความสำเร็จของการอัปเดต
    $update_sql = "UPDATE tb_order SET order_status = 2 WHERE orderID = '$orderID'";
    if (mysqli_query($conn, $update_sql)) {
        // Also update order status to indicate awaiting further processing
        $update_sql = "UPDATE tb_order SET order_status = 2 WHERE orderID = '$orderID'";
        if (mysqli_query($conn, $update_sql)) {
            // Both updates were successful
            header("Location: history.php");
            exit();
        } else {
            // Failed to update order status to "รอการตรวจสอบ"
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดตสถานะคำสั่งซื้อ";
            header("Location: payment_page.php");
            exit();
        }
    } else {
        // Failed to update order status to "รอการชำระเงิน"
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดตสถานะคำสั่งซื้อ";
        header("Location: payment_page.php");
        exit();
    }
}
mysqli_close($conn);
