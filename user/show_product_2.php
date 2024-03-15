<?php 
include 'condb.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <br>
        <div class="alert alert-info h4 text-center mb-4 mt-4 " role="alert">
            แสดงข้อมูลสินค้า
        </div>
        <a class="btn btn-success mb-4" href="fr_product.php" role="button">Add+</a>
        <table class="table table-striped table-hover">
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>ประเภทสินค้า</th>
                <th>ราคาสินค้า</th>
                <th>จำนวนสินค้าคงเหลือ</th>
                <th>รูปภาพสินค้า</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
    $sql="SELECT * FROM product
    LEFT JOIN type ON type.type_id = product.type_id;";
    $hand = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($hand)){
    ?>
            <tr>
                <td><?=$row['pro_id']?></td>
                <td><?=$row['pro_name']?></td>
                <td><?=$row['detail']?></td>
                <td><?=$row['type_name']?></td>
                <td><?=$row['price']?></td>
                <td><?=$row['amount']?></td>
                <td><img src="img/<?=$row['image']?>" width="80px" hieght="100px"></td>
                <td><a a href="edit_product.php?id=<?=$row['pro_id']?>" class="btn btn-success">Edit</a></td>
                <td><a href="delete_product.php?id=<?=$row['pro_id']?>" class="btn btn-danger"
                        onclick="Del(this.href);return false;">Delete</a></td>
            </tr>

            <?php
}
mysqli_close($conn);
?>
        </table>

    </div>

</body>

</html>

<script language="JavaScript">
function Del(mypage) {
    var agree = confirm("คุณต้องการลบข้อมูลหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>