$sql ="SELECT * FROM product, type WHERE product.type_id = type.type_id and product.pro_id='$ids'

<input type="text" name="detail" class="form-control" placeholder="รายละเอียดสินค้า..." required > <br>
<input type="text" name="detail" class="form-control" value=<?=$rs['detail']?> > <br>
<input type="text" name="address" class="form-control" required>

<a href="order.php?id=<?=$row_pro['pro_id']?>" class="btn btn-success">+</a>
            <?php if($_SESSION["strQty"][$i] > 1){ ?>
            <a href="order_del.php?id=<?=$row_pro['pro_id']?>" class="btn btn-danger">-</a>
            <?php } ?>
//ปุ่มและลด
            <a href="order.php?id=<?=$row_pro['pro_id']?>" class="btn btn-success">+</a>
            <?php if($_SESSION["strQty"][$i] > 1){ ?>
            <a href="order_del.php?id=<?=$row_pro['pro_id']?>" class="btn btn-danger">-</a>
            <?php } ?>

//ตัดสต๊อกสินค้า
            <?php
// Assuming $row_pro is the current product's data
$maxQuantity = 10; // Set the maximum allowed quantity

// Check if the current quantity is less than the maximum
if ($_SESSION["strQty"][$i] < $maxQuantity) {
    echo '<a href="order.php?id=' . $row_pro['pro_id'] . '" class="btn btn-success">+</a>';
}

if ($_SESSION["strQty"][$i] > 1) {
    echo '<a href="order_del.php?id=' . $row_pro['pro_id'] . '" class="btn btn-danger">-</a>';
}
?>


//โค้ด sh_product_detail.php
<?php include 'condb.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarCell</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>
<body>

<div class="container  mt-5">
<br><br>
  <div class="row">
  <?php
  $ids=$_GET['id'];
$sql ="SELECT * FROM product, type WHERE product.type_id= type.type_id";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
    ?>
    <div class="col-md-4">
    <img src="img/<?=$row['image']?>" width="350px" class="mt-5 p-2 my-2 border" />
    </div>
    
    <div class="col-md-6">
    <br><br><br>   
    ID: <?=$row['pro_id']?> <br>
    <h5 class="text-success"> <?=$row['pro_name']?> </h5> 
    ประเภทสินค้า :<?=$row['type_name']?> <br>
    รายละเอียดสินค้า :<?=$row['detail']?> <br>
    ราคา <b class="text-danger"> <?=$row['price']?> </b> บาท <br>
    <a class="btn btn-outline-success mt-3" href="order.php?id=<?=$row['pro_id']?>" > Add cart </a> 
    </div>
  
  </div>
</div>
<?php
mysqli_close($conn); 
?>

</body>
</html>


<?php
            $ids = $_GET['id']; //กดสินค้าตัวไหนก็จะส่ง id ตัวนั้นขึ้นมาตรงรายละเอียด
            $sql = "SELECT * FROM product, type WHERE product.type_id= type.type_id and product.product_id='$ids'"; //ดึงรูปสินค้ามา
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>



$sql = "SELECT * FROM product, type WHERE product.type_id = type.type_id AND product.product_id = '$ids'";
    $result = mysqli_query($conn, $sql);


//footer admin
    <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; My Services 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>



                href="admin/index.php

//เชื่อมไปหน้าที่อยากเชื่อม
                <a href="admin/index.php" class="nav-link">admin</a>




                <?php 
include 'condb.php';
$id=$_GET['id'];
$sql="SELECT * FROM tb_employee WHERE id='$id' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

?>




                <div class="col-sm-6 bg-light text-dark">
        <div class="alert alert-primary h4 text-center mb-4 mt-4 " role="alert">
  แก้ไขข้อมูลพนักงาน
</div> 

<form method="POST" action="update_employee.php">
    <label>รหัสพนักงาน:</label>
    <input type="text" name="id_emp" class="form-control" readonly value="<?=$row['id']?>"> <br>
    
    <label>ชื่อ :</label>
    <input type="text" name="fname" class="form-control" value="<?=$row['name']?>"> <br>
    
    <label>นามสกุล :</label>
    <input type="text" name="lname" class="form-control" value="<?=$row['lastname']?>"> <br>
    
    <label>ที่อยู่ :</label>
    <input type="text" name="address" class="form-control" value="<?=$row['address']?>"> <br>
    
    <label>เบอร์โทรศัพท์ :</label>
    <input type="number" name="telephone" class="form-control" value="<?=$row['telephone']?>"> <br>
    
    <input type="submit" name="Update" class="btn btn-success">
    <a href="show_employee.php" class="btn btn-danger">Cancel</a> <br><br>
</form>

/*รหัสแจ้งเตือน
wUmNvUyqjZwGHokWV3X9GwvnSn9jWUdKspxQIFz0dh7
*/


<div class="container-fluid px-4">
<div class="alert alert-success h4 text-center mt-4" role="alert">
  รายงานการขายสินค้า
</div>