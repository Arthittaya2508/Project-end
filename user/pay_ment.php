<?php
include 'condb.php';
if(isset($_POST['btn1'])){
    $key_word=$_POST['keyword'];
    if($key_word != ""){
        $sql="SELECT * "
    }
}

?>

้<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>

</head>
<body>

<div class="container">

<div class="row mt-4">
<div class="col-md-4">
    <div class="alert alert-success mt-4" role="alert">
  แจ้งการชำระเงิน
</div>
<!-- ฟอร์มค้นหาเลขที่ใบเสร็จ -->
<div class="border mt-5 p-2 my-2" style="background-color: #f0f0f5;" >
<from method="POST" action="pay_ment.php">
<label>เลขที่ใบสั่งซื้อ :</label>
<input type="text" name="keyword">
<button type="submit" name="btn1" class="btn btn-primary">ค้นหา</button>

</form>
</div>

</div>
</div>

<div class="row">
<div class="col-md-4">
<from method="POST" action="insertPayment.php" enctype="multipart/form-data">
<label class="mt-4">เลขที่ใบสั่งซื้อ :</label>
<input type="text" name="order_id" required><br>
<label class="mt-4">เลขที่ใบสั่งซื้อ :</label>
<textarea class="form-control" name="cusName" required rows="1"></textarea>
<label class="mt-4">จำนวนเงิน :</label>
<input type="number" class="form-control" name="total_price" required>
<label class="mt-4">วันที่โอนเงิน :</label>
<input type="date" class="form-control" name="pay_date" required>
<label class="mt-4">เวลาที่โอนเงิน :</label>
<input type="time" class="form-control" name="pay_time" required>
<label class="mt-4">หลักฐานการชำระเงิน :</label>
<input type="file" class="form-control" name="file" required><br>
<button type="submit" name="btn2" class="btn btn-primary">Submit</button>


    
</body>
</html>