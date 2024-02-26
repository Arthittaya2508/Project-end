<?php
include 'condb.php';

session_start();
if (!isset($_SESSION["id"])) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Check if all required fields are set
    if (
        isset($_POST['orderID'], $_POST['import_date'], $_POST['pid'], $_POST['pname'], $_POST['price'], $_POST['name_company'])
    ) {
        
        $import_date = mysqli_real_escape_string($conn, $_POST['import_date']);
        $p_id = mysqli_real_escape_string($conn, $_POST['pid']);
        $p_name = mysqli_real_escape_string($conn, $_POST['pname']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $name_company = mysqli_real_escape_string($conn, $_POST['name_company']);

        // Perform the insertion into the database
        $sql = "INSERT INTO import(orderID, import_date, pid, pname, price, name_company) 
                VALUES('$orderID', '$import_date', '$p_id', '$p_name', '$price', '$name_company')";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
            echo "<script> window.location='show_import.php'; </script>";
            exit; // จบการทำงานหลังบันทึกข้อมูล
        } else {
            echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
        }
    } else {
        echo "<script> alert('กรุณากรอกข้อมูลให้ครบถ้วน'); </script>";
    }
} else {
    echo "<script> alert('การเข้าถึงไม่ถูกต้อง'); </script>";
}
mysqli_close($conn);
?>
