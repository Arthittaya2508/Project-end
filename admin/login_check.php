<?php
include 'condb.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// เข้ารหัส password ด้วย sha512
$password = hash('sha512', $password);

$sql = "SELECT * FROM tb_employee WHERE username='$username' and password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row > 0) {
    $_SESSION["username"] = $row['username'];
    $_SESSION["password"] = $row['password'];
    $_SESSION["id"] = $row['id'];
    $_SESSION["name"] = $row['name'];
    $_SESSION["lastname"] = $row['lastname'];
    $_SESSION["Error"] = "";
    $show=header("Location: index.php"); // ใช้ header เพื่อ redirect หลังจากเข้าสู่ระบบสำเร็จ
    $_SESSION["Error"] = "";
} else {
    $_SESSION["Error"] = "<p>Your username or password is invalid</p>";
    $show=header("Location: login.php");
}

echo $show;
?>
