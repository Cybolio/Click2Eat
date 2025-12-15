<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = intval($_GET['id']);

// Change status to "In Transit" (use your code for picked up, e.g. 2)
$sql = "UPDATE orderprocess SET OrderStatus = 2 WHERE OrderID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Redirect back to dashboard
header("Location: riderview.php");
exit();
?>
