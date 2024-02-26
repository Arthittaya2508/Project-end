<?php
// ติดต่อฐานข้อมูล
include('condb.php');

// ดึงรายการสินค้าขายดี (เช่น 10 อันดับแรก)
$best_selling_query = "SELECT * FROM products ORDER BY sales_count DESC LIMIT 10";
$best_selling_result = mysqli_query($conn, $best_selling_query);

// ดึงรายการสินค้าขายได้ต่ำ (เช่น 10 อันดับแรก)
$low_selling_query = "SELECT * FROM products ORDER BY sales_count ASC LIMIT 10";
$low_selling_result = mysqli_query($conn, $low_selling_query);

// ตรวจสอบว่ามีข้อผิดพลาดในการร้องขอหรือไม่
if (!$best_selling_result || !$low_selling_result) {
    echo "Error: " . mysqli_error($conn);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Selling Products</title>
</head> 
<body>
    <h2>Top Selling Products</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($best_selling_result)) : ?>
            <li><?php echo $row['product_name']; ?> - Sold: <?php echo $row['sales_count']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Low Selling Products</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($low_selling_result)) : ?>
            <li><?php echo $row['product_name']; ?> - Sold: <?php echo $row['sales_count']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
<?php
}
?>
