<?php include 'condb.php';
$idpro = 'idpro'; // กำหนดค่าเริ่มต้นให้เป็นสตริงว่าง
if (isset($_GET['id'])) {
    $idpro = $_GET['id'];
    // ทำสิ่งที่ต้องการกับตัวแปร $idpro ที่ได้รับมา
    // เช่น นำไปใช้ในการแก้ไขสินค้าในฐานข้อมูล
} else {
    // ไม่ได้รับค่า 'id' มาใน URL หรือค่า 'id' ไม่ถูกต้อง
    // ดำเนินการที่ควรทำหากไม่มี 'id' หรือค่า 'id' ไม่ถูกต้อง
}
$sql1 = "SELECT * FROM product WHERE pro_id='$idpro'";
$result = mysqli_query($conn,$sql1);
$rs=mysqli_fetch_array($result);
$p_typeID=$rs['type_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >    
</head>
<body>

<div class="container">
<br>
  <div class="row">
    <div class="col-sm-6 bg-light text-dark">
        <div class="alert alert-primary h4 text-center mb-4 mt-4 " role="alert">
  แก้ไขข้อมูลสินค้า
</div> 
   
<form name="form1" method="post" action="update_product.php" enctype="multipart/form-data">
<label>รหัสสินค้า :</label>
<input type="text" name="proid" class="form-control" readonly value="<?=htmlspecialchars($rs['pro_id'])?>"> <br>   
<label>ชื่อสินค้า :</label>
<input type="text" name="pname" class="form-control" value=<?=$rs['pro_name']?> > <br>
<label>รายละเอียดสินค้า :</label>
<input type="text" name="detail" class="form-control" value=<?=$rs['detail']?> > <br>
<label>ประเภทสินค้า :</label>
<select class="form-select" name="typeID" > 
<?php
$sql="SELECT * FROM type ORDER BY type_name";
$hand=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($hand)){
    $ttypeID = $row['type_id'];
    ?>   
    <option value="<?=$row['type_id']?>" <?php if($p_typeID==$ttypeID){echo "selected=selected";} ?> >
    <?=$row['type_name']?></option>
    <?php    
}
mysqli_close($conn);
?>

</select>

<br>
<label>ราคาสินค้า :</label> 
<input type="number" name="price" class="form-control" value=<?=$rs['price']?> > <br>
<label>จำนวนสินค้าคงเหลือ :</label>
<input type="number" name="num" class="form-control" value=<?=$rs['amount']?> > <br>
<label>รูปภาพสินค้า :</label>
<img src="img/<?=$rs['image']?>" width="120"> <br><br>
<input type="file" name="file1"   required > <br><br>
<input type="hidden" name="txtimg" class="form-control" value=<?=$rs['image']?> > <br>

<button type="submit" class="btn btn-success">Update</button>
<a class="btn btn-danger" href="show_product_2.php" role="button">Cancel</a>
<br><br>

</form>

    </div>
  </div>

</div>

</body>
</html>