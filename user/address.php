<?php
include 'condb.php';
session_start();

// เรียกข้อมูลที่อยู่และเบอร์โทรศัพท์ของผู้ใช้งานที่ล็อกอิน
$username = $_SESSION['username'];
$sql = "SELECT * FROM member WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $lastname = $row['lastname']; // เพิ่มการดึงนามสกุล
        $address = $row['address'];
        $telephone = $row['telephone'];
        $fullname = $name . " " . $lastname; // รวมชื่อและนามสกุลเข้าด้วยกัน
    }
} else {
    // ไม่พบข้อมูลผู้ใช้ในฐานข้อมูล
    // สามารถจัดการตามที่เหมาะสม เช่น แสดงข้อความแจ้งเตือน
    echo "ไม่พบข้อมูลผู้ใช้งาน";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Address</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="address.css"> -->

    <script>
    function showExistingAddress() {
        document.getElementById('existingAddressForm').classList.remove('hide');
        document.getElementById('newAddressForm').classList.add('hide');
        document.getElementById('fullname').readOnly = true;
        document.getElementById('tel').readOnly = true;
    }

    function showNewAddress() {
        document.getElementById('newAddressForm').classList.remove('hide');
        document.getElementById('existingAddressForm').classList.add('hide');
        document.getElementById('fullname').readOnly = false;
        document.getElementById('tel').readOnly = false;

    }
    </script>
    <style>
    .content {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .form-check {
        margin: 0 20px;
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 20px 30px;
        background-color: transparent;
        color: #007bff;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 300px;
        height: 120px;
    }

    .form-check-label {
        font-size: larger;
    }

    .form-check-input {
        margin-left: 50px;
        font-size: medium;
    }

    .form-check:hover {
        background-color: #007bff;
        color: #fff;
    }

    .hide {
        display: none;
    }

    .card {
        width: 800px;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .text-form {
        font-size: larger;
        margin-top: 10px;
        margin-left: 10px;
        margin-bottom: 8px;
    }

    .form-group {
        width: 85%;
        height: 10%;
        margin-left: 50px;
    }

    .sm {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        width: 15%;
        height: 50%;
        margin-top: 30px;
        margin-left: 305px;
        color: #fff;
    }

    .sm:hover {
        background-color: #008714;
        color: #fff;
    }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <h3 class="text-center">เลือกที่อยู่การจัดส่ง</h3>
    <br>
    <div class="content">
        <button class="form-check form-check-inline" onclick="showExistingAddress()">
            <input class="form-check-input" type="radio" name="addressOption" id="existingAddressOption"
                value="existing" checked>
            <label class="form-check-label" for="existingAddressOption">ที่อยู่ที่มีอยู่ในระบบ</label>
        </button>
        <button class="form-check form-check-inline" onclick="showNewAddress()">
            <input class="form-check-input" type="radio" name="addressOption" id="newAddressOption" value="new">
            <label class="form-check-label" for="newAddressOption">แก้ไขข้อมูลการจัดส่ง</label>
        </button>
    </div>
    <br><br>

    <div class="card">
        <form id="form1" method="POST" action="in_address.php">
            <div class="row">
                <!-- เพิ่มฟิลด์ชื่อ-นามสกุล -->
                <div class="form-group">
                    <label for="fullname" class="text-form">
                        ชื่อ-นามสกุล
                    </label>
                    <input type="text" class="form-control" id="fullname" name="fullname"
                        value="<?php echo htmlspecialchars($fullname); ?>" readonly>
                </div>

                <div id="existingAddressForm">
                    <div class="form-group">
                        <label for="existingAddress" class="text-form">
                            ที่อยู่ที่มีอยู่ในระบบ
                        </label>
                        <input type="text" class="form-control" id="existingAddress" name="existingAddress"
                            value="<?php echo htmlspecialchars($address); ?>" readonly>
                    </div>
                    <hr>
                </div>

                <div id="newAddressForm" class="hide">
                    <div class="form-group">
                        <label for="newAddress" class="text-form">
                            ที่อยู่ใหม่ (กรอกเฉพาะกรณีที่ต้องการเปลี่ยนที่อยู่)
                        </label>
                        <textarea class="form-control" id="newAddress" name="newAddress"
                            rows="3"><?php echo htmlspecialchars($address); ?></textarea>
                    </div>
                    <hr>
                </div>

                <div class="form-group">
                    <label for="tel" class="text-form">
                        เบอร์โทรศัพท์
                    </label>
                    <input type="tel" class="form-control" id="tel" name="tel"
                        value="<?php echo htmlspecialchars($telephone); ?>" readonly>
                </div>
            </div>

            <button type="submit" class="sm">Submit</button>
        </form>
    </div>

</body>

</html>