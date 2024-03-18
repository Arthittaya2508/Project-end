<?php 

include 'condb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ploynappan</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="cart.css"> -->
    <link rel="stylesheet" href="up_cart.css">

</head>

<body>
    <?php include 'menu.php';?>
    <br><br>
    <div class="container">
        <form id="form1" method="POST" action="insert_cart.php">
            <div class="row">
                <div class="col">
                    <div class="alert alert-custom h4 text-center text-black" role="alert">
                        การสั่งซื้อสินค้า
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
$sumTotal=0;

if(isset($_SESSION["intLine"]))  {  //ถ้าไม่เป็นค่าว่างให้ทำงานใน {}

for ($i=0; $i <= (int)$_SESSION["intLine"]; $i++){
  if(($_SESSION["strProductID"][$i]) != ""){
    $sql1="select * from product where pro_id = '" . $_SESSION["strProductID"][$i] . "' " ;
    $result1 = mysqli_query($conn,$sql1);
    $row_pro = mysqli_fetch_array($result1);

    $_SESSION["price"] = $row_pro['price'];
    $Total = $_SESSION["strQty"][$i];
    $sum = $Total * $row_pro['price'];
    $sumPrice = $sumPrice + $sum;
    $_SESSION["sum_price"] = $sumPrice ;
    $sumTotal=$sumTotal+ $Total;

?>
                        <tr>
                            <td><input type="checkbox" class="itemCheckbox"
                                    aria-label="Checkbox for following text input">
                            </td>

                            <!-- <td><?=$m?></td> -->
                            <td class="centered-cell">
                                <img src="img/<?=$row_pro['image']?>" width="80" height="85" class="border">
                                <?=$row_pro['pro_name']?>
                            </td>
                            <td class="null">สินค้าคงเหลือ (<?php echo $row_pro['amount']; ?>)</td>
                            <td><?=$row_pro['price']?></td>


                            <td>
                                <?php
    $productID = $row_pro['pro_id']; 

    $sql_product = "SELECT * FROM product WHERE pro_id = '$productID'";
    $result_product = mysqli_query($conn, $sql_product);
    $row_product = mysqli_fetch_assoc($result_product);

    $maxStock = $row_product['amount']; 

    if ($_SESSION["strQty"][$i]) {
        echo '<a id="decrement" class="button1" onclick="decrementAmount()" href="order_del.php?id=' . $row_pro['pro_id'] . '">-</a>';
    }

echo '<div id="amount-container"> <span  id="amount">' . $_SESSION["strQty"][$i] . '</span></div>';
    
    
    if ($_SESSION["strQty"][$i] ) {
        echo '<a id="increment" class="button1" onclick="incrementAmount()"  href="order.php?id=' . $row_pro['pro_id'] . '">+</a>';
    }
?>
                            <td><?=$sum?></td>
                            </td>
                            <td class="delete"><a href="pro_delete.php?Line=<?= $i ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
 $m=$m+1;
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
                    <p class="text-end">จำนวนสินค้าที่สั่งซื้อ <?= $sumTotal?> ชิ้น</p>
                    <div style="text-align:right">
                        <a href="all_products.php"> <button type="button"
                                class="btn btn-outline-secondary">เลือกสินค้า</button> </a>
                        <!-- Button trigger modal -->

                        <button id="orderButton" type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">สั่งซื้อสินค้า </button>

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
        $fullname = $name . " " . $lastname; // รวมชื่อและนามสกุลเข้าด้วยกัน
    }
}

?>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เลือกที่อยู่สำหรับจัดส่ง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="but">
                                            <button class="form-check form-check-inline"
                                                onclick="showExistingAddress()">
                                                <input class="form-check-input" type="radio" name="addressOption"
                                                    id="existingAddressOption" value="existing" checked>
                                                <label class="form-check-label"
                                                    for="existingAddressOption">ที่อยู่ที่มีอยู่ในระบบ</label>
                                            </button>
                                            <button class="form-check form-check-inline" onclick="showNewAddress()">
                                                <input class="form-check-input" type="radio" name="addressOption"
                                                    id="newAddressOption" value="new">
                                                <label class="form-check-label"
                                                    for="newAddressOption">แก้ไขข้อมูลที่อยู่</label>
                                            </button>
                                        </div>
                                        <br><br>


                                        <form id="form01" method="POST" action="in_address.php">
                                            <div class="row1">
                                                <!-- เพิ่มฟิลด์ชื่อ-นามสกุล -->
                                                <div class="text02">
                                                    <label for="fullname" class="text02">
                                                        ชื่อ-นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control" id="fullname"
                                                        name="fullname"
                                                        value="<?php echo htmlspecialchars($fullname); ?>" readonly>
                                                </div>

                                                <div id="existingAddressForm">
                                                    <div class="text02">
                                                        <label for="existingAddress" class="text02">
                                                            ที่อยู่ที่มีอยู่ในระบบ
                                                        </label>
                                                        <input type="text" class="form-control" id="existingAddress"
                                                            name="existingAddress"
                                                            value="<?php echo htmlspecialchars($address); ?>" readonly>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div id="newAddressForm" class="hide">
                                                    <div class="text02">
                                                        <label for="newAddress" class="text02">
                                                            ที่อยู่ใหม่ (กรอกเฉพาะกรณีที่ต้องการเปลี่ยนที่อยู่)
                                                        </label>
                                                        <textarea class="form-control" id="newAddress" name="newAddress"
                                                            rows="3"><?php echo htmlspecialchars($address); ?></textarea>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div class="text02">
                                                    <label for="tel" class="text02">
                                                        เบอร์โทรศัพท์
                                                    </label>
                                                    <input type="tel" class="form-control" id="tel" name="tel"
                                                        value="<?php echo htmlspecialchars($telephone); ?>" readonly>
                                                </div>
                                            </div>

                                            <!-- <button type="submit" class="sm">Submit</button> -->
                                        </form>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">ปิด</button>
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
    <script>
    // Function to check if any item is selected
    function checkSelectedItems() {
        var checkboxes = document.querySelectorAll('.itemCheckbox');
        var selected = false;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selected = true;
            }
        });
        return selected;
    }

    // Function to show notification if no item is selected
    function showNotification() {
        var notification = document.getElementById('notification');
        if (!checkSelectedItems()) {
            notification.style.display = 'block';
        } else {
            notification.style.display = 'none';
        }
    }

    // Listen for checkbox changes
    var checkboxes = document.querySelectorAll('.itemCheckbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            showNotification();
            calculateTotal(); // Recalculate total when checkbox changes
        });
    });
    // Function to handle checkbox toggle
    document.getElementById('selectAllCheckbox').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.itemCheckbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('selectAllCheckbox').checked;
        });
        showNotification(); // Check if any item is selected after toggling select all
        calculateTotal(); // Recalculate total when select all checkbox changes
    });
    </script>
</body>

</html>