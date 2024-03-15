<?php
include 'condb.php';
session_start();

// เรียกข้อมูลที่อยู่ของผู้ใช้งานที่ล็อกอิน
$username = $_SESSION['username']; // สมมติว่าคุณมี session ที่เก็บ user_id ของผู้ใช้งานที่ล็อกอิน
$sql = "SELECT * FROM member WHERE username = '$username'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>เลือกที่อยู่การจัดส่งสินค้า</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="address.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <h2>เลือกที่อยู่การจัดส่งสินค้า</h2>
    <form action="in_address.php" method="post">
        <select name="address">
            <?php
            // แสดงตัวเลือกที่อยู่ที่มีในฐานข้อมูล
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["address"] . "'>" . $row["address"] . "</option>";
                }
            }
            ?>
            <option value="new">ที่อยู่ใหม่</option>
        </select>
        <br><br>
        <input type="submit" value="ยืนยัน">
    </form>
</body>

</html>