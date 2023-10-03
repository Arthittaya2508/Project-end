<?php

include 'condb.php';

// ตรวจสอบว่าตัวแปรต่าง ๆ อยู่ใน $_POST
if(isset($_POST['pname']) && isset($_POST['detail']) && isset($_POST['typeID']) && isset($_POST['price']) && isset($_POST['num'])) {
    $p_name = $_POST['pname'];
    $detail = $_POST['detail'];
    $typeID = $_POST['typeID'];
    $price = $_POST['price'];
    $num = $_POST['num'];

    // อัปโหลดรูปภาพ
    if(is_uploaded_file($_FILES['file1']['tmp_name'])) {
        $new_image_name = 'pr_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "./img/".$new_image_name;
        move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
    } else {
        $new_image_name = "";
    }

    // คำสั่งเพิ่มข้อมูลในตาราง product
    $sql="INSERT INTO product(pro_name,detail,type_id,price,amount,image) VALUES('$p_name','$detail','$typeID','$price','$num','$new_image_name')";
    $result=mysqli_query($conn,$sql);
    
    if($result){
        echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
        echo "<script> window.location='fr_product.php'; </script> ";
    } else {
        echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";   
    }
} else {
    echo "<script> alert('ข้อมูลไม่ถูกส่งมาให้ครบถ้วน'); </script> ";
}

?>