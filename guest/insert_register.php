<?php
include 'condb.php';

$name = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

// เช็คว่ามีไฟล์รูปถูกอัปโหลดหรือไม่
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    // ย้ายไฟล์รูปไปยังโฟลเดอร์ที่เหมาะสมบนเซิร์ฟเวอร์
    $target_directory = "uploads/";
    $target_file = $target_directory . basename($image);
    move_uploaded_file($temp_name, $target_file);
} else {
    // หากไม่มีการอัปโหลดรูปภาพ
    $image = ""; // ให้เป็นค่าว่าง
}

$password = hash('sha512', $password);

// ตรวจสอบว่ามีชื่อผู้ใช้งานหรือชื่อ-นามสกุลที่ซ้ำกันหรือไม่
$check_duplicate_sql = "SELECT * FROM member WHERE username = '$username' OR (name = '$name' AND lastname = '$lastname')";
$check_duplicate_result = mysqli_query($conn, $check_duplicate_sql);

if (mysqli_num_rows($check_duplicate_result) > 0) {
    echo "<script> alert('มีผู้ใช้งานหรือชื่อ-นามสกุลนี้แล้ว'); </script> ";
    echo "<script> window.location='register.php'; </script> ";
} else {
    $insert_sql = "INSERT INTO member(name, lastname, address, telephone, username, password, image)
        VALUES ('$name', '$lastname', '$address', '$phone', '$username', '$password', '$image')";
    $insert_result = mysqli_query($conn, $insert_sql);

    if ($insert_result) {
        echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
        echo "<script> window.location='login.php'; </script> ";
    } else {
        echo "<script> alert('<div class=\"error-message\">บันทึกข้อมูลไม่ได้</div>'); </script> ";
    }
}

mysqli_close($conn);
?>