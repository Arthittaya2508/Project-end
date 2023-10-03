<?php include 'condb.php';
$idpro = 'idpro'; // กำหนดค่าเริ่มต้นให้เป็นสตริงว่าง
if (isset($_GET['id'])) {
    $idpro = $_GET['id'];
    // ทำสิ่งที่ต้องการกับตัวแปร $idpro ที่ได้รับมา
    // เช่น นำไปใช้ในการแก้ไขสินค้าในฐานข้อมูล
} else {
    // ไม่ได้รับค่า 'id' มาใน URL หรือค่า 'id' ไม่ถูกต้อง
    // ดำเนินการที่ควรทำหากไม่มี 'id' หรือค่า 'id' ไม่ถูกต้อง
}
$sql="DELETE FROM product WHERE pro_id='$idpro' ";
if(mysqli_query($conn,$sql)){
    echo "<script> alert('ลบข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='show_product.php'; </script> ";
}else{
    echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    echo "<script> alert('ไม่สามารถลบข้อมูลได้'); </script> ";   
}
mysqli_close($conn);

?>