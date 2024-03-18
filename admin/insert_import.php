<?php
// เชื่อมต่อกับฐานข้อมูล
include 'condb.php';

// เริ่ม session
session_start();

// ตรวจสอบว่ามีการส่งค่าผ่านเมธอด POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // ดึงค่า orderID จากฟอร์ม
    $orderID = mysqli_real_escape_string($conn, $_POST['orderID']);
    // ดึงค่า import_date จากฟอร์ม
    $import_date = mysqli_real_escape_string($conn, $_POST['import_date']);
    // ดึงค่า name_company จากฟอร์ม
    $name_company = mysqli_real_escape_string($conn, $_POST['name_company']);

    // ตรวจสอบว่ามีสินค้าที่ถูกเลือกหรือไม่
    if(isset($_POST['selected_products']) && !empty($_POST['selected_products'])){
        foreach($_POST['selected_products'] as $selected_product){
            // แยกค่า pro_id และ type_id
            $selected_values = explode("_", $selected_product);
            $pro_id = $selected_values[0];
            $type_id = $selected_values[1];

            // ทำสิ่งที่ต้องการกับค่า pro_id และ type_id ที่ได้
            // เช่น บันทึกลงในฐานข้อมูล
            $sql = "INSERT INTO `import` (orderID, pro_id, type_id, import_date, name_company) VALUES ('$orderID', '$pro_id', '$type_id', '$import_date', '$name_company')";
            $result = mysqli_query($conn, $sql);

            // ตรวจสอบว่าคำสั่ง SQL ทำงานสำเร็จหรือไม่
            if (!$result) {
                echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้ ข้อมูลไม่ถูกต้อง'); </script>";
            }
        }
        echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
        // ส่งผลการบันทึกข้อมูลกลับไปยังหน้าที่ต้องการ
        echo "<script> window.location='show_import.php'; </script>";
        exit; // จบการทำงานหลังบันทึกข้อมูล
    } else {
        echo "<script> alert('กรุณาเลือกสินค้าอย่างน้อย 1 รายการ'); </script>";
    }
} else {
    echo "<script> alert('การเข้าถึงไม่ถูกต้อง'); </script>";
}
mysqli_close($conn);
?>
