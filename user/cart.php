<?php 
session_start();
include 'condb.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
<?php include 'menu.php';?>
<br><br>
  <div class="container">
    <form id="form1" method="POST" action="insert_cart.php">
    <div class ="row">
        <div class ="col-md-10">
        <div class="alert alert-success h4" role="alert">
  การสั่งซื้อสินค้า
</div>
        <table class="table table-striped table-hover">
        <tr>
            <th>ลำดับที่</th>
            <th>ชื่อสินค้า</th>
            <th>ราคาสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>ราคารวม</th>
            <th>เพิ่ม - ลด</th>
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
            <td><?=$m?></td>
            <td>
                <img src="img/<?=$row_pro['image']?>" width="80" height="100" class="border">
                <?=$row_pro['pro_name']?>
            </td>
            <td><?=$row_pro['price']?></td>
            <td><?=$_SESSION["strQty"][$i]?></td>
            <td><?=$sum?></td>
            <td>
            <?php
               // Assuming $row_pro is the current product's data
            $productID = $row_pro['pro_id']; // Product ID

              // Retrieve product information from the database
            $sql_product = "SELECT * FROM product WHERE pro_id = '$productID'";
            $result_product = mysqli_query($conn, $sql_product);
            $row_product = mysqli_fetch_assoc($result_product);

            $maxStock = $row_product['amount']; // Maximum available stock

            if ($_SESSION["strQty"][$i] < $maxStock) {
    echo '<a href="order.php?id=' . $row_pro['pro_id'] . '" class="btn btn-success">+</a>';
}
            if ($_SESSION["strQty"][$i] > 1) {
    echo '<a href="order_del.php?id=' . $row_pro['pro_id'] . '" class="btn btn-danger">-</a>';
}
?>
            </td>
            <td class="text-center"><a href="pro_delete.php?Line=<?=$i?>" > <img src="img/rubbishbin2.png" width="30"> </a></td> 
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
<a href ="show_product_sell.php"> <button type="button" class="btn btn-outline-secondary">เลือกสินค้า</button> </a>
<button type="submit" class="btn btn-outline-success">ยืนยันการสั่งซื้อ</button>
</div>
  </div>

  <br>
  <div class="row">
    <div class="col-md-5">
      <div class="alert alert-info h4" role="alert">
  ข้อมูลสำหรับจัดส่งสินค้า
</div>
ชื่อ-นามสกุล:
<input type="text" name="cus_name" class="form-control" required placeholder="ชื่อ-นามสกุล"> <br>
ที่อยู่จัดส่งสินค้า 
<textarea class="form-control" required placeholder="ที่อยู่..." name="cus_add" rows="3"> </textarea> <br>
เบอร์โทรศัพท์
<input type="number" name="cus_tel" class="form-control" required placeholder="เบอร์โทรศัพท์..">
<br><br><br>
  </div>
</div>
</from>

</div>    
</body>
</html>