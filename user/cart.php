<?php
include 'condb.php';
session_start();

// Initialize session variables if not already set
if (!isset($_SESSION["intLine"])) {
    $_SESSION["intLine"] = 0;
    $_SESSION["strProductID"] = array();
    $_SESSION["strQty"] = array();
}

if (isset($_POST['productID']) && isset($_POST['quantity'])) {
    // Add item to the cart
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    // Check if product already exists in the cart
    $key = array_search($productID, $_SESSION["strProductID"]);

    if ($key !== false) {
        // If product exists, update quantity
        $_SESSION["strQty"][$key] += $quantity;
    } else {
        // If product does not exist, add it to the cart
        $_SESSION["strProductID"][$_SESSION["intLine"]] = $productID;
        $_SESSION["strQty"][$_SESSION["intLine"]] = $quantity;
        $_SESSION["intLine"]++;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ploynappan</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .content {

            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            color: #4d4c5b;

            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-weight: normal;
        }

        th.centered-cell,
        td.centered-cell {
            text-align: left;
        }


        th.null,
        td.null {
            width: 200px;
            text-align: left;
            color: #4d4c5b;
        }

        th.delete,
        td.delete {
            width: 50px;
        }

        th.sum,
        td.sum {
            width: 100px;
        }

        .button1 {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .box {
            display: flex;
            justify-content: flex-end;
            margin-left: auto;
            margin-top: 10px;
        }

        #p {
            margin-top: 50px;
        }

        #increment,
        #decrement {
            background-color: #CCB7E5;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #increment:hover,
        #decrement:hover {
            background-color: #45a049;
        }

        #amount-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px 20px;
            display: inline-block;
        }

        #amount {
            font-size: 16px;
        }

        #myButton {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        a {
            color: #333;
            /* สีของลิงก์ */
            text-decoration: none;
            /* ไม่มีขีดเส้นใต้ลิงก์ */
        }

        a:hover {
            color: #ff0000;
            /* สีของลิงก์เมื่อเมาส์ผ่าน */
        }

        .fa-trash {
            color: #ff0000;
            /* สีของไอคอนลบ (Trash icon) */
        }

        .fa-trash:hover {
            color: #cc0000;
            /* สีของไอคอนลบเมื่อเมาส์ผ่าน */
        }

        .modal-dialog {
            width: auto;
        }

        .but {
            display: flex;
        }

        .form-check {
            margin: 0 20px;
            border: 2px solid #CCB7E5;
            border-radius: 10px;
            padding: 20px 30px;
            background-color: transparent;
            color: #000000;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 250px;
            height: 80px;
        }

        .form-check-label {
            font-size: medium;
            justify-content: center;
            margin-top: 20px;
        }

        .form-check-input {
            margin-left: 50px;
            font-size: medium;
        }

        .form-check:hover {
            background-color: #CCB7E5;
            color: #000000;
        }

        .form-check-inline:focus-within label {
            color: #fff;
        }

        .form-check-inline:focus-within {
            background-color: #CCB7E5;
            color: #fff;
        }

        .hide {
            display: none;
        }

        .form01 {
            text-align: left;
        }

        .text02 {
            font-size: medium;
            margin-bottom: 8px;
            justify-content: left;
            text-align: left;
        }
    </style>

</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <div class="container">
        <form id="form1" method="POST" action="insert_cart.php">
            <div class="row">
                <div class="col">
                    <div class="alert alert-custom h4 text-center text-black" role="alert">
                        รายการสินค้าในตะกร้าสินค้า
                    </div>

                    <table class="table table-striped table-hover">
                        <tr>
                            <th><input type="checkbox" id="selectAllCheckbox" aria-label="Checkbox for selecting all">
                            </th>
                            <th class="centered-cell">เลือกสินค้าทั้งหมด</th>
                            <th></th>
                            <th>ราคาสินค้า</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคารวม</th>
                            <th>ลบสินค้า</th>
                        </tr>
                        <?php

                        $Total = 0;
                        $sumPrice = 0;
                        $m = 1;
                        $sumTotal = 0;
                        if (isset($_SESSION["intLine"]) && isset($_SESSION["strProductID"]) && isset($_SESSION["strQty"])) {
                            for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                                if (!empty($_SESSION["strProductID"][$i])) { // เพิ่มการตรวจสอบค่าของ $_SESSION["strProductID"][$i]
                                    // รหัสอนุกรมและรายละเอียดสินค้า
                                    $sql1 = "select * from product where pro_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                    $result1 = mysqli_query($conn, $sql1);
                                    $row_pro = mysqli_fetch_array($result1);

                                    $_SESSION["price"] = $row_pro['price'];
                                    $Total = $_SESSION["strQty"][$i];
                                    $sum = $Total * $row_pro['price'];
                                    $sumPrice = $sumPrice + $sum;
                                    $_SESSION["sum_price"] = $sumPrice;
                                    $sumTotal = $sumTotal + $Total;

                        ?>
                                    <tr>
                                        <td><input type="checkbox" class="itemCheckbox" aria-label="Checkbox for following text input">
                                        </td>

                                        <!-- <td><?= $m ?></td> -->
                                        <td class="centered-cell">
                                            <img src="img/<?= $row_pro['image'] ?>" width="80" height="85" class="border">
                                            <?= $row_pro['pro_name'] ?>
                                        </td>
                                        <td class="null">สินค้าคงเหลือ (<?php echo $row_pro['amount']; ?>)</td>
                                        <td><?= $row_pro['price'] ?></td>


                                        <td>
                                            <?php
                                            $productID = $row_pro['pro_id'];

                                            $sql_product = "SELECT * FROM product WHERE pro_id = '$productID'";
                                            $result_product = mysqli_query($conn, $sql_product);
                                            $row_product = mysqli_fetch_assoc($result_product);

                                            if ($_SESSION["strQty"][$i]) {
                                                echo '<a id="decrement" class="button1" onclick="decrementAmount()" href="order_del.php?id=' . $row_pro['pro_id'] . '">-</a>';
                                            }

                                            echo '<div id="amount-container"> <span  id="amount">' . $_SESSION["strQty"][$i] . '</span></div>';

                                            // เพิ่มเงื่อนไขตรวจสอบว่าจำนวนสินค้าไม่เกินในสต็อกก่อนที่จะเรียกใช้ฟังก์ชัน incrementAmount()
                                            if ($_SESSION["strQty"][$i] < $row_product['amount']) {
                                                echo '<a id="increment" class="button1" onclick="incrementAmount()"  href="order.php?id=' . $row_pro['pro_id'] . '">+</a>';
                                            }
                                            ?>

                                        </td>
                                        <td><?= $sum ?></td>
                                        </td>
                                        <td class="delete"><a href="pro_delete.php?Line=<?= $i ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                    $m = $m + 1;
                                }
                            }
                        } //endif
                        mysqli_close($conn);
                        ?>
                        <tr>
                            <td class="text-end" colspan="5">รวมเป็นเงิน</td>
                            <td class="text-center"><?= number_format($sumPrice); ?></td>
                            <td>บาท</td>
                        </tr>

                    </table>
                    <p class="text-end">จำนวนสินค้าที่สั่งซื้อ <?= $sumTotal ?> ชิ้น</p>
                    <div style="text-align:right">
                        <a href="all_products.php"> <button type="button" class="btn btn-outline-secondary">เลือกสินค้า</button> </a>
                        <!-- Button trigger modal -->

                        <button id="orderButton" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">สั่งซื้อสินค้า </button>

                        <script>
                            function showExistingAddress() {
                                document.getElementById('existingAddressForm').classList.remove('hide');
                                document.getElementById('newAddressForm').classList.add('hide');
                                document.getElementById('fullname').readOnly = true;
                                document.getElementById('userID').readOnly = true;
                                document.getElementById('tel').readOnly = true;
                            }

                            function showNewAddress() {
                                document.getElementById('newAddressForm').classList.remove('hide');
                                document.getElementById('existingAddressForm').classList.add('hide');
                                document.getElementById('fullname').readOnly = false;
                                document.getElementById('userID').readOnly = true;
                                document.getElementById('tel').readOnly = false;

                            }
                        </script>
                        <?php
                        include 'condb.php';


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
                                $userID = $row['id'];
                                $fullname = $name . " " . $lastname; // รวมชื่อและนามสกุลเข้าด้วยกัน
                            }
                        }

                        ?>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เลือกที่อยู่สำหรับจัดส่ง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="but">
                                            <a class="form-check form-check-inline" onclick="showExistingAddress()">
                                                <input class="form-check-input" type="radio" name="addressOption" id="existingAddressOption" value="existing" checked>
                                                <label class="form-check-label" for="existingAddressOption">ที่อยู่ที่มีอยู่ในระบบ</label>
                                            </a>
                                            <a class="form-check form-check-inline" onclick="showNewAddress()">
                                                <input class="form-check-input" type="radio" name="addressOption" id="newAddressOption" value="new">
                                                <label class="form-check-label" for="newAddressOption">แก้ไขข้อมูลที่อยู่</label>
                                            </a>
                                        </div>
                                        <br><br>


                                        <form id="form01" method="POST" action="in_address.php">
                                            <div class="row1">
                                                <!-- เพิ่มฟิลด์ชื่อ-นามสกุล -->
                                                <div class="text02">
                                                    <label for="fullname" class="text02">
                                                        ชื่อ-นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" readonly>
                                                    <input type="hidden" class="form-control" id="userID" name="userID" value="<?php echo htmlspecialchars($userID); ?>" readonly>
                                                </div>

                                                <div id="existingAddressForm">
                                                    <div class="text02">
                                                        <label for="existingAddress" class="text02">
                                                            ที่อยู่ที่มีอยู่ในระบบ
                                                        </label>
                                                        <input type="text" class="form-control" id="existingAddress" name="existingAddress" value="<?php echo htmlspecialchars($address); ?>" readonly>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div id="newAddressForm" class="hide">
                                                    <div class="text02">
                                                        <label for="newAddress" class="text02">
                                                            ที่อยู่ใหม่ (กรอกเฉพาะกรณีที่ต้องการเปลี่ยนที่อยู่)
                                                        </label>
                                                        <textarea class="form-control" id="newAddress" name="newAddress" rows="3"><?php echo htmlspecialchars($address); ?></textarea>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div class="text02">
                                                    <label for="tel" class="text02">
                                                        เบอร์โทรศัพท์
                                                    </label>
                                                    <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($telephone); ?>" readonly>
                                                </div>
                                            </div>

                                            <!-- <button type="submit" class="sm">Submit</button> -->
                                        </form>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert library -->



</body>

</html>