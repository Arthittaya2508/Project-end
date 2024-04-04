<?php
include 'condb.php';
$setID = $_POST['setID'];
$set_name = $_POST['set_name'];


//คำสั่งเพิ่มข้อมูลในตาราง product 
$sql = "INSERT INTO `set`(`set_id`, `set_name`)VALUES ('$setID','$set_name') ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='fr_set.php'; </script> ";
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";
}
