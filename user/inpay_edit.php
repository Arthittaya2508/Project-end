<?php
include 'condb.php';

// ตรวจสอบว่ามีการส่งข้อมูลจากแบบฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากแบบฟอร์ม
    $orderID = $_POST['order_id'];
    $cusName = $_POST["cus_name"];
    $payTime = $_POST["pay_time"];
    $payDate = $_POST["pay_date"];
    $payMoney = $_POST["pay_money"];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
    if(isset($_FILES["pay_image"])) {
        // ตรวจสอบว่าโฟลเดอร์ uploads มีหรือไม่
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
        }
        
        // ตั้งชื่อไฟล์ใหม่เพื่อหลีกเลี่ยงการซ้ำ
        $filename = uniqid() . "_" . basename($_FILES["pay_image"]["name"]);
        $target_file = $target_dir . $filename;

        // พยายามย้ายไฟล์ไปยังโฟลเดอร์ปลายทาง
        if (move_uploaded_file($_FILES["pay_image"]["tmp_name"], $target_file)) {
            // เชื่อมต่อฐานข้อมูล MySQL
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // ตรวจสอบการเชื่อมต่อ
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // สร้างคำสั่ง SQL เพื่อบันทึกข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO payment (orderID, pay_time, pay_date, pay_money, pay_image)
            VALUES ('$orderID','$payTime', '$payDate', '$payMoney', '$filename')";

            // Execute คำสั่ง SQL
            $result=mysqli_query($conn,$sql);
            if($result){
            
                
                echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script> ";
                echo "<script> window.location='history.php'; </script> ";
            } else {
                // ถ้ามีปัญหาในการบันทึกข้อมูล
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // ปิดการเชื่อมต่อ MySQL
            mysqli_close($conn);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded";
    }
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script> ";
}
?>