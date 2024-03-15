<?php
include 'condb.php';
$orderID = $_POST['order_id'];
$totalPrice = $_POST['total_price'];
$payDate = $_POST['pay_date'];
$payTime = $_POST['pay_time'];

//อัพโหลดรูปภาพ
if  (is_uploaded_file($_FILES['file1']['tmp_name'])){
    $new_image_name = 'b_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']));
    $image_upload_path = "./img/payment/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
}else{
$new_image_name = "";
}

//คำสั่งเพิ่มข้อมูลในตาราง product 
$sql="INSERT INTO payment(orderID,pay_money,pay_date,pay_time,pay_image) 
VALUES('$orderID','$totalPrice','$payDate','$payTime','$new_image_name')";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='history.php'; </script> ";
}else{
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";   
}
mysqli_close($conn);

?>