<?php include 'condb.php';
$f_name = $_POST['fname'];
$l_name = $_POST['lname'];
$address = $_POST['address'];
$tel = $_POST['telephone'];

$sql="INSERT INTO member(name,lastname,address,telephone) VALUES('$f_name','$l_name','$address','$tel') ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
    echo "<script> window.location='show_member.php'; </script> ";
}else{
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";   
}
mysqli_close($conn);

?>