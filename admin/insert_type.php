<?php
include 'condb.php';
$typeID = $_POST['typeID'];
$type_name = $_POST['type_name'];


//คำสั่งเพิ่มข้อมูลในตาราง product 
$sql="INSERT INTO type(type_id,type_name) VALUES('$typeID','$type_name')";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='fr_type.php'; </script> ";
}else{
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";   
}

?>