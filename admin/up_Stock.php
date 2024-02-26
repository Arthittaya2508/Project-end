<?php 
include 'condb.php';
$ids = $_POST['pid'];
$nums = $_POST['pnum'];

$sql_update_product = "UPDATE product SET amount = amount + $nums WHERE pro_id = '$ids'";
$hand_update_product = mysqli_query($conn, $sql_update_product);

if ($hand_update_product) {
    // อัปเดตจำนวนสินค้าสำเร็จ ทำการเพิ่มรายการสินค้าเข้าตาราง stock
    $current_date = date("Y-m-d H:i:s");
    $sql_add_stock = "INSERT INTO stock (pro_id, stock_in, stock_date) VALUES ('$ids', '$nums', '$current_date')";
    $hand_add_stock = mysqli_query($conn, $sql_add_stock);

    if ($hand_add_stock) {
        // เพิ่มรายการสต็อกสำเร็จ
        echo "<script>alert('อัปเดตจำนวนสินค้าและบันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location='index.php'</script>";
    } else {
        // ไม่สามารถเพิ่มรายการสต็อกได้
        echo "<script>alert('ไม่สามารถเพิ่มรายการสต็อกได้')</script>";
    }
} else {
    // ไม่สามารถอัปเดตจำนวนสินค้าได้
    echo "<script>alert('ไม่สามารถอัปเดตจำนวนสินค้าได้')</script>";   
}
mysqli_close($conn);
?>
