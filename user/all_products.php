<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้า</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="product.css">
</head>
<style>
/* เมื่อนำเมาส์ไปวางที่รูป */
.highlight-on-click {
    transition: transform 0.3s ease;
    /* เพิ่มการเปลี่ยนแปลงเมื่อคลิก */
}
</style>

<style>
/* เมื่อนำเมาส์โดนรูป */
.highlight-on-hover {
    transition: transform 0.3s ease;
    /* เพิ่มการเปลี่ยนแปลงเมื่อโดน */
}

/* เมื่อโดนนั้น */
.highlight-on-hover :hover {
    transform: scale(1.1);
    /* เพิ่มการเปลี่ยนแปลงเมื่อโดน */
}
</style>

<body>
    <?php
      session_start(); ?>
    <?php include 'menu.php';?>
    <div class="container">
        <div class="row">
            <div class="col ">
                <div class="text-center ">
                    <br><br>
                    <h1>รายการสินค้า</h1>
                </div>
                <br><br>
                <div class="d-flex ">
                    <div class="card highlight-on-hover text-center me-5" style="width: 20rem;">
                        <a href="necklece.php">
                            <img src="img/10.jpg" alt="สร้อยคอ" width="250" height="250">
                        </a> <br>
                        <h4 class="text-center ">สร้อยคอ</h4>
                    </div>
                    <div class="card highlight-on-hover text-center me-5" style="width: 20rem;">

                        <a href="rings.php">
                            <img src="img/แหวน01.jpg" alt="แหวน" width="250" height="250">
                        </a>
                        <br>
                        <h4 class="text-center text-center">แหวน</h4>
                    </div>
                    <div class="card highlight-on-hover text-center me-5 " style="width: 20rem;">

                        <a href="bracelets.php">
                            <img src="img/กำไล01.jpg" alt="กำไล" width="250" height="250">
                        </a>
                        <br>
                        <h4 class="text-center">กำไลแขน</h4>
                    </div>
                    <div class="card highlight-on-hover text-center me-3" style="width: 20rem; ">

                        <a href="earrings.php">
                            <img src="img/ต่างหู01.jpg" alt="ต่างหู" width="250" height="250">
                        </a>
                        <br>
                        <h4 class="text-center">ต่างหู</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>