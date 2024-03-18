<?php 
include 'condb.php';
$id = $_POST['orderID'];
$import_date = $_POST['import_date'];
$pro_id = $_POST['pro_id'];
$pro_name = $_POST['pro_name'];
$price = $_POST['price'];
$name_company = $_POST['name_company'];

// เพิ่มข้อมูลลงในฐานข้อมูล
$sql = "UPDATE import SET import_date='$import_date', pro_id='$pro_id', pro_name='$pro_name', price='$price', name_company='$name_company' WHERE orderID= '$id'";
$result = mysqli_query($conn, $sql);

// ตรวจสอบว่าคำสั่ง SQL ทำงานสำเร็จหรือไม่
if($result){
    echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='show_import.php'; </script> ";
}else{
    echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้'); </script> ";   
}
mysqli_close($conn);

?>
