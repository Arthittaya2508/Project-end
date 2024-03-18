<?php

include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบและกำหนดค่าตัวแปร session สำหรับชื่อ-นามสกุล, ที่อยู่ และเบอร์โทรศัพท์
    $_SESSION["fullname"] = $_POST["fullname"];

    // ตรวจสอบว่าผู้ใช้เลือกใช้ที่อยู่ที่มีอยู่ในระบบหรือเพิ่มที่อยู่ใหม่
    if ($_POST["addressOption"] == "existing") {
        $_SESSION["address"] = $_POST["existingAddress"];
    } else {
        $_SESSION["address"] = $_POST["newAddress"];
    }

    $_SESSION["telephone"] = $_POST["tel"];

    // Redirect ไปยังหน้า orderNum.php
    header("Location: orderNum.php");
    exit();
}
?>