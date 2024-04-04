<?php
// Include เพื่อเรียกใช้งานไฟล์ condb.php
include 'condb.php';
session_start();

// ตรวจสอบว่ามีค่า orderID ที่ถูกส่งมาจากลิงก์หรือไม่
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
    // ทำสิ่งที่ต้องการด้วย orderID ที่ได้รับ
}
$total_sum = 0;
$sql = "SELECT p.pro_name , p.detail , p.price, od.orderQty, od.Total, p.image, t.type_name, tbo.order_status, tbo.id_ems
FROM order_detail AS od
LEFT JOIN product AS p ON od.pro_id = p.pro_id
LEFT JOIN type AS t ON p.type_id = t.type_id
LEFT JOIN tb_order AS tbo ON od.orderID = tbo.orderID
WHERE od.orderID = '$orderID'";
$result11 = mysqli_query($conn, $sql);
$row11 = mysqli_fetch_assoc($result11); // เพิ่มบรรทัดนี้เพื่อดึงข้อมูลสถานะเดียวกันมาแสดงที่หัวข้อ h3
$order_status = $row11['order_status'];

// กำหนดข้อความสถานะตามค่าที่ได้รับ
switch ($order_status) {
    case 0:
        $status_text = "ยกเลิก";
        break;
    case 1:
        $status_text = "ยังไม่ชำระเงิน";
        break;
    case 2:
        $status_text = "ชำระเงิน";
        break;
    case 3:
        $status_text = "ส่งสินค้าเรียบร้อย";
        break;
    default:
        $status_text = "ไม่ระบุสถานะ";
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
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="cart.css"> -->
    <link rel="stylesheet" href="up_cart.css">
    <script>
        function confirmCancellation(orderID) {
            var confirmation = confirm("คุณแน่ใจหรือไม่ว่าต้องการยกเลิกสินค้าเลขที่ใบสั่งซื้อ " + orderID + " ?");
            if (confirmation) {
                window.location.href = "cancel_order.php?orderID=" + orderID; // ส่งคำขอยกเลิกไปยังไฟล์ cancel_order.php
            } else {
                // ไม่ต้องทำอะไรเมื่อผู้ใช้ยกเลิกการยกเลิกสินค้า
            }
        }
    </script>
    <style>
        /* CSS เพิ่มสีตามสถานะ */
        .text-danger {
            color: red;
        }

        .text-warning {
            color: yellow;
        }

        .text-primary {
            color: blue;
        }

        .text-info {
            color: lightblue;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <div class="container">
        <h1>รายละเอียดหมายเลข : <?php echo $orderID; ?></h1>
        <!-- แสดงสถานะของคำสั่งซื้อ -->
        <h3>สถานะ : <span class="<?php
                                    switch ($order_status) {
                                        case 0:
                                            echo 'text-danger'; // สีแดง
                                            break;
                                        case 1:
                                            echo 'text-warning'; // สีเหลือง
                                            break;
                                        case 2:
                                            echo 'text-primary'; // สีฟ้า
                                            break;
                                        case 3:
                                            echo 'text-info'; // สีน้ำเงิน
                                            break;
                                        default:
                                            echo 'text-muted'; // สีเทาสำหรับสถานะที่ไม่ระบุ
                                    }
                                    ?>"><?php echo $status_text; ?></span></h3>
        <?php if ($order_status == 3) { ?>
            <!-- แสดงหมายเลข EMS เมื่อสถานะเป็น 3 -->
            <h3>รายละเอียดหมายเลขพัสดุ : <?php echo $row11['id_ems']; ?></h3>
        <?php } ?>
        <table class="table table-bordered">
            <thead>
                <tr class="fs-4">
                    <th colspan="2" style='width : 70%'>รายการ</th>
                    <th scope="col" width="100">ราคา</th>
                    <th scope="col" width="100">จำนวน</th>
                    <th scope="col" width="100">ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // วนลูปแสดงข้อมูลคำสั่งซื้อทั้งหมด
                mysqli_data_seek($result11, 0); // ย้าย pointer กลับไปที่แถวแรก
                while ($row11 = mysqli_fetch_assoc($result11)) {
                    echo "<tr>";
                    echo "<td style='width : 50px'><img class='rounded float-start w-100' src='img/" . $row11['image'] . "'></td>";
                    echo "<td class='text-start fs-4'>ชื่อ: " . $row11['pro_name'] . "<br>ประเภท: " . $row11['type_name'] . "</td>";
                    echo "<td>" . $row11['price'] . "</td>";
                    echo "<td>" . $row11['orderQty'] . "</td>";
                    echo "<td>" . $row11['Total'] . "</td>";
                    echo "</tr>";
                    $total_sum += $row11['Total'];
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>รวมทั้งหมด:</strong></td>
                    <td><strong><?php echo $total_sum; ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <td><a class="btn btn-danger" href="#" onclick="confirmCancellation('<?php echo $orderID; ?>')" role="button">ยกเลิกสินค้า</a></td>

    </div>
</body>

</html>