<?php 
include 'condb.php';
$id=$_POST['id_emp'];
$f_name=$_POST['fname'];
$l_name=$_POST['lname'];
$address=$_POST['address'];
$position=$_POST['position'];
$tel=$_POST['telephone'];

$sql = "UPDATE tb_employee set name='$f_name', lastname='$l_name', address='$address', telephone='$tel', position='$position' WHERE id= '$id' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='show_employee.php'; </script> ";
}else{
    echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้'); </script> ";   
}
mysqli_close($conn);

?>