<?php
include 'condb.php';
session_start();

$username =$_POST['username'];
$password =$_POST['password'];

//เข้ารหัส password ด้วย sha512
$password=hash('sha512',$password);

$sql="SELECT * FROM member WHERE username='$username' and password ='$password'";
$result=mysqli_query($conn,$sql);
$row =mysqli_fetch_array($result);


if($row > 0){
    $_SESSION["username"]=$row['username'];
    $_SESSION["pw"]=$row['password'];
    $_SESSION["firstname"]=$row['name'];
    $_SESSION["lastname"]=$row['lastname'];
    $show=header("location:index.php");



      
}else{
    $_SESSION["Error"] = "<p> Your username or password is invalid </p>";
    $show=header("location:login.php");
}
echo $show;

?>