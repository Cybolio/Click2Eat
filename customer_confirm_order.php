<?php
session_start();

/* Security checks */
if (!isset($_SESSION['customer_id'], $_SESSION['cart'], $_SESSION['cart_branch'])) {
    header("Location: home.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$customerID = $_SESSION['customer_id'];
$branchID   = $_SESSION['cart_branch'];
$cart       = $_SESSION['cart'];

/* ==========================
   CALCULATE TOTAL
   ========================== */
$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['quantity'] * $item['price'];
}

/* ==========================
   INSERT INTO orderprocess (RiderID is now NULL)
   ========================== */
$sqlOrder = "
    INSERT INTO orderprocess
    (CustomerID, BranchID, OrderStatus, `Total Amount`, OrderDate, RiderID)
    VALUES (?, ?, ?, ?, NOW(), NULL)
";

$status  = 1; // Active order
$stmtOrder = mysqli_prepare($conn, $sqlOrder);
mysqli_stmt_bind_param(
    $stmtOrder,
    "iiid",
    $customerID,
    $branchID,
    $status,
    $totalAmount
);
mysqli_stmt_execute($stmtOrder);

/* Get generated OrderID */
$orderID = mysqli_insert_id($conn);

/* ==========================
   INSERT INTO order_food_items
   ========================== */
$sqlItems = "
    INSERT INTO order_food_items
    (OrderID, FoodID, Quantity, PriceAtOrder)
    VALUES (?, ?, ?, ?)
";

$stmtItems = mysqli_prepare($conn, $sqlItems);

foreach ($cart as $foodID => $item) {
    $quantity = $item['quantity'];
    $price    = $item['price'];

    mysqli_stmt_bind_param(
        $stmtItems,
        "iiid",
        $orderID,
        $foodID,
        $quantity,
        $price
    );
    mysqli_stmt_execute($stmtItems);
}

/* ==========================
   INSERT INTO paymentrecord
   ========================== */
$sqlPayment = "
    INSERT INTO paymentrecord
    (OrderID, DeliveryID, PaymentDate, Amount, PaymentMethod, PaymentStatus)
    VALUES (?, NULL, NOW(), ?, ?, ?)
";

$paymentMethod = 1; // Example: 1 = Cash
$paymentStatus = 1; // Example: 1 = Paid

$stmtPayment = mysqli_prepare($conn, $sqlPayment);
mysqli_stmt_bind_param(
    $stmtPayment,
    "idii",
    $orderID,
    $totalAmount,
    $paymentMethod,
    $paymentStatus
);
mysqli_stmt_execute($stmtPayment);

/* Get generated PaymentID */
$paymentID = mysqli_insert_id($conn);



/* ==========================
   CLEAN UP
   ========================== */
mysqli_stmt_close($stmtOrder);
mysqli_stmt_close($stmtItems);
mysqli_stmt_close($stmtPayment);
mysqli_close($conn);

/* Clear cart */
unset($_SESSION['cart'], $_SESSION['cart_branch']);

/* Show alert and redirect */
echo "<script>
        alert('Order successful');
        window.location.href = 'home.php';
      </script>";
exit();
?>
