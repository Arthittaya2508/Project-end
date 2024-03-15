<?php
session_start();
include('condb.php');

$errors = array();

if (isset($_POST['reg_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $address= mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $image =  mysqli_real_escape_string($conn, $_POST['image']);

    if (empty($name)) {
        array_push($errors, "Firstname is required");
    }
    
    if (empty($lastname)) {
        array_push($errors, "Lastname is required");
    }
    if (empty($address)) {
        array_push($errors, "Address is required");
    }
    if (empty($phone)) {
        array_push($errors, "Telephone is required");
    }
    
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($image)) {
        array_push($errors, "Image is required");
    }
    

    // ตรวจสอบความซ้ำของ Username เท่านั้น
    $user_check_query = "SELECT * FROM member WHERE username = '$username'";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        array_push($errors, "Username already exists");
    }

    // ใช้ฟังก์ชัน password_hash() เพื่อเข้ารหัสรหัสผ่านก่อนบันทึกลงฐานข้อมูล
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO member (name, lastname, address, telephone, username, password)
    VALUES ('$name', '$lastname', '$address', '$phone', '$username', '$hashed_password')";
    mysqli_query($conn, $sql);

    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header("location: home.php");
}
?>