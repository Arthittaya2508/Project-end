<?php 
session_start();
include 'condb.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $status = $_POST['status'];
    $id = $_SESSION["id_order"];

    // Check the values of $status and $id
    // echo "Status: ";
    // var_dump($status);
    // echo "<br>";
    // echo "ID: ";
    // var_dump($id);

    // Update order status in the database
    $sql = "UPDATE tb_order SET order_status='$status' WHERE orderID='$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the update was successful
    if ($result) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='report_order_yes.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

mysqli_close($conn);
?>
