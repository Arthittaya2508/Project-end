<?php
// Connect to the database
include 'condb.php';

// Check the connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if orderID is sent
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // Retrieve product information along with company name
    $query = "SELECT order_import.*, product.*, type.*, order_import.name_company AS company_name 
              FROM `order_import`
              LEFT JOIN product ON order_import.pro_id = product.pro_id
              LEFT JOIN type ON order_import.typeID = type.type_id 
              WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $query);

    // Check if there's a result
    if (mysqli_num_rows($result) > 0) {
        // Display company name
        $row = mysqli_fetch_assoc($result); // Fetch the first row
        echo "<label>ชื่อบริษัท:</label>";
        echo "<input class='form-control' type='text' required placeholder='ชื่อบริษัท:' name='name_company' value='" . $row['company_name'] . "'> <br>";

        // Display product information
        mysqli_data_seek($result, 0); // Reset result pointer to the beginning
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input class='form-check-input' type='checkbox' value='" . $row['pro_id'] . "_" . $row['typeID'] . "' name='selected_products[]' id='product_" . $row['pro_id'] . "_" . $row['typeID'] . "'>";
            echo "<label class='form-check-label' for='product_" . $row['pro_id'] . "_" . $row['typeID'] . "'>";
            echo "ชื่อสินค้า: " . $row['pro_name'] . " / ประเภทสินค้า: " . $row['type_name'];
            echo "</label><br>";
        }
    } else {
        // If no result found
        echo "ไม่พบข้อมูล";
    }

    // Close the database connection
    mysqli_close($conn);
}
