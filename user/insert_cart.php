<?php
session_start();
include 'condb.php';

$cusID = $_POST['userID'];
$cusName = $_POST['fullname'];
$cusAddress = $_POST['newAddress'];
$cusTel = $_POST['tel'];

// Loop through each item in the cart to check stock availability
$insufficientStock = false;
for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (!empty($_SESSION["strProductID"][$i])) {
        $productId = $_SESSION["strProductID"][$i];
        $quantity = $_SESSION["strQty"][$i];

        // Retrieve stock amount for the product
        $stockQuery = "SELECT amount FROM product WHERE pro_id = '$productId'";
        $stockResult = mysqli_query($conn, $stockQuery);
        $row = mysqli_fetch_assoc($stockResult);
        $stockAmount = $row['amount'];

        // Check if the requested quantity exceeds available stock
        if ($quantity > $stockAmount) {
            $insufficientStock = true;
            break;
        }
    }
}

// If there is insufficient stock, redirect back to the cart page with an error message
if ($insufficientStock) {
    $_SESSION['error_message'] = "Some items in your cart have insufficient stock.";
    header("Location: cart.php");
    exit();
}

// If there is sufficient stock, proceed with inserting the order
$sql = "INSERT INTO tb_order (cus_id, cus_name, address, telephone, total_price, order_status)
        VALUES ('$cusID', '$cusName', '$cusAddress', '$cusTel', '" . $_SESSION["sum_price"] . "', '1')";

mysqli_query($conn, $sql);

$orderID = mysqli_insert_id($conn);

// Insert order details
for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (($_SESSION["strProductID"][$i]) != "") {
        $sql1 = "SELECT * FROM product WHERE pro_id = '" . $_SESSION["strProductID"][$i] . "'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $price = $row1['price'];
        $total = $_SESSION["strQty"][$i] * $price;

        $sql2 = "INSERT INTO order_detail (orderID, pro_id, orderPrice, orderQty, Total)
                VALUES ('$orderID', '" . $_SESSION["strProductID"][$i] . "', '$price',
                '" . $_SESSION["strQty"][$i] . "', '$total')";
        if (mysqli_query($conn, $sql2)) {
            $sql3 = "UPDATE product SET amount = amount - '" . $_SESSION["strQty"][$i] . "'
                    WHERE pro_id = '" . $_SESSION["strProductID"][$i] . "'";
            mysqli_query($conn, $sql3);
        }
    }
}

// Line Notify
// Code for Line Notify goes here

// Clear session data
unset($_SESSION["intLine"]);
unset($_SESSION["strProductID"]);
unset($_SESSION["strQty"]);
unset($_SESSION["sum_price"]);

// Store address and telephone in session
$_SESSION["fullname"] = $_POST["fullname"];
$_SESSION["address"] = $_POST["newAddress"];
$_SESSION["telephone"] = $_POST["tel"];

$_SESSION["order_id"] = $orderID;
header("Location: orderNum.php");
exit();
