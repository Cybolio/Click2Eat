<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = intval($_GET['id']);

$sql = "
    SELECT 
        o.OrderID,
        o.OrderStatus,
        o.OrderDate,
        o.`Total Amount` AS total_amount,
        r.restaurantname,
        c.fullname,
        c.home_address
    FROM orderprocess o
    JOIN restaurant r ON o.BranchID = r.branchID
    JOIN customer c ON o.CustomerID = c.CustomerID
    WHERE o.OrderID = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$order = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order #<?php echo $order['OrderID']; ?></title>
  <style>
    :root {
      --bg: #fdf6e3;
      --surface: #fff8ec;
      --surface-alt: #f2e6d4;
      --text: #3b2f2f;
      --accent: #965c4a;
      --accent-soft: #d19c67;
      --accent-warm: #6f4e37;
    }
    body {
      background-color: var(--bg);
      color: var(--text);
      font-family: "Segoe UI", sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 2rem;
    }
    .vieworder-container {
      max-width: 700px;
      margin: 0 auto;
      background-color: var(--surface);
      padding: 2rem;
      border-radius: 14px;
      border: 1px solid var(--accent-soft);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .vieworder-container h2 {
      text-align: center;
      color: var(--accent);
      margin-bottom: 1.5rem;
      border-bottom: 2px solid var(--accent-soft);
      padding-bottom: 0.5rem;
    }
    .order-info p {
      margin: 0.5rem 0;
      font-size: 1rem;
      color: var(--text);
    }
    .order-info strong {
      color: var(--accent-warm);
    }
    .status-badge {
      display: inline-block;
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      font-weight: bold;
      background-color: var(--accent-soft);
      color: var(--text);
      margin-top: 0.5rem;
    }
    .status-badge.waiting { background-color: #f0ad4e; color: #fff; }
    .status-badge.transit { background-color: #5bc0de; color: #fff; }
    .status-badge.delivered { background-color: #5cb85c; color: #fff; }
    .action-btn {
      display: inline-block;
      padding: 0.7rem 1.2rem;
      margin: 1rem 0.5rem 0 0;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: 0.3s;
      background-color: var(--accent-soft);
      color: var(--text);
    }
    .action-btn:hover {
      background-color: var(--accent);
      color: #fff8ec;
    }
  </style>
</head>
<body>
  <div class="vieworder-container">
    <h2>Order #<?php echo $order['OrderID']; ?></h2>
    <div class="order-info">
      <p><strong>Restaurant:</strong> <?php echo htmlspecialchars($order['restaurantname']); ?></p>
      <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['fullname']); ?></p>
      <p><strong>Address:</strong> <?php echo htmlspecialchars($order['home_address']); ?></p>
      <p><strong>Total Amount:</strong> ₱<?php echo number_format($order['total_amount'], 2); ?></p>
      <p><strong>Status:</strong> 
        <span class="status-badge 
          <?php echo $order['OrderStatus']==1?'waiting':($order['OrderStatus']==2?'transit':'delivered'); ?>">
          <?php echo $order['OrderStatus']==1?'Waiting for Pickup':($order['OrderStatus']==2?'In Transit':'Delivered'); ?>
        </span>
      </p>
    </div>
    <a href="mark_picked.php?id=<?php echo $currentOrder['OrderID']; ?>" class="action-btn">
        Mark as Picked Up
    </a>
    <a href="mark_delivered.php?id=<?php echo $order['OrderID']; ?>" class="action-btn">
        Mark as Delivered
    </a>

    <a href="riderview.php" class="action-btn">Back to Dashboard</a>
  </div>
</body>
</html>
