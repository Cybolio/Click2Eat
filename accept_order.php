<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];
$order_id = intval($_GET['id']);

// Assign order to rider
$sql = "UPDATE orderprocess SET RiderID = ?, OrderStatus = 1 WHERE OrderID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $rider_id, $order_id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Redirect back to dashboard
header("Location: riderview.php");
exit();
?>
