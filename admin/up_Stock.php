<?php
include 'condb.php';
$ids = $_POST['pid'];
$nums = $_POST['pnum'];

$sql_update_product = "UPDATE product SET amount = amount + $nums WHERE pro_id = '$ids'";
$hand_update_product = mysqli_query($conn, $sql_update_product);

if ($hand_update_product) {
    // อัปเดตจำนวนสินค้าสำเร็จ ทำการอัปเดตหรือเพิ่มรายการสินค้าเข้าตาราง stock
    $current_date = date("Y-m-d H:i:s");
    $sql_update_stock = "UPDATE stock SET stock_in = stock_in + $nums WHERE pro_id = '$ids' AND stock_date = '$current_date'";
    $hand_update_stock = mysqli_query($conn, $sql_update_stock);

    if ($hand_update_stock) {
        // อัปเดตรายการสต็อกสำเร็จ
        echo "<script>alert('อัปเดตจำนวนสินค้าและรายการสต็อกสำเร็จ')</script>";
        echo "<script>window.location='index.php'</script>";
    } else {
        // ไม่สามารถอัปเดตรายการสต็อกได้
        echo "<script>alert('ไม่สามารถอัปเดตรายการสต็อกได้')</script>";
    }
} else {
    // ไม่สามารถอัปเดตจำนวนสินค้าได้
    echo "<script>alert('ไม่สามารถอัปเดตจำนวนสินค้าได้')</script>";
}
mysqli_close($conn);
