<?php include 'condb.php';?>
<!-- สินค้าขายดี -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            สินค้าขายดี
        </div>
        <div class="card-body">
            <ul>
                <?php
                $sqlBestSelling = "SELECT pro_name FROM product ORDER BY sold DESC LIMIT 3"; // เปลี่ยนเงื่อนไขตามฐานข้อมูลของคุณ
                $resultBestSelling = mysqli_query($conn, $sqlBestSelling);

                while ($rowBestSelling = mysqli_fetch_assoc($resultBestSelling)) {
                    echo "<li>" . $rowBestSelling['pro_name'] . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- สินค้าขายได้ต่ำ -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            สินค้าขายได้ต่ำ
        </div>
        <div class="card-body">
            <ul>
                <?php
                $sqlLowSelling = "SELECT pro_name FROM product ORDER BY sold ASC LIMIT 3"; // เปลี่ยนเงื่อนไขตามฐานข้อมูลของคุณ
                $resultLowSelling = mysqli_query($conn, $sqlLowSelling);

                while ($rowLowSelling = mysqli_fetch_assoc($resultLowSelling)) {
                    echo "<li>" . $rowLowSelling['pro_name'] . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>
