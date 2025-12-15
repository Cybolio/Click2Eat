<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];

/* Fetch rider info */
$sqlRider = "
    SELECT 
        `rider-id`   AS rider_id,
        `fullname`   AS ridername,
        `phone-no`   AS phone,
        `vehicle-type` AS vehicle,
        `LicenseNo.` AS license,
        `address`    AS address,
        `status`     AS status
    FROM rider
    WHERE `rider-id` = ?
    LIMIT 1
";
$stmtRider = mysqli_prepare($conn, $sqlRider);
mysqli_stmt_bind_param($stmtRider, "i", $rider_id);
mysqli_stmt_execute($stmtRider);
$riderResult = mysqli_stmt_get_result($stmtRider);
$rider = mysqli_fetch_assoc($riderResult) ?: [];

mysqli_stmt_close($stmtRider);

/* Fetch current delivery (active order assigned to this rider) */
$sqlCurrent = "
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
    WHERE o.RiderID = ? AND o.OrderStatus IN (1,2)
    ORDER BY o.OrderDate DESC
    LIMIT 1
";
$stmtCurrent = mysqli_prepare($conn, $sqlCurrent);
mysqli_stmt_bind_param($stmtCurrent, "i", $rider_id);
mysqli_stmt_execute($stmtCurrent);
$currentResult = mysqli_stmt_get_result($stmtCurrent);
$currentOrder = mysqli_fetch_assoc($currentResult);

/* Fetch available orders (not yet assigned to a rider) */
$sqlAvailable = "
    SELECT 
    o.OrderID,
    o.OrderStatus,
    o.OrderDate,
    r.restaurantname,
    o.`Total Amount` AS total_amount
FROM orderprocess o
JOIN restaurant r ON o.BranchID = r.branchID
WHERE o.RiderID IS NULL AND o.OrderStatus = 1
ORDER BY o.OrderDate DESC

";
$stmtAvail = mysqli_prepare($conn, $sqlAvailable);
mysqli_stmt_execute($stmtAvail);
$availableResult = mysqli_stmt_get_result($stmtAvail);

mysqli_stmt_close($stmtCurrent);
mysqli_stmt_close($stmtAvail);
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Dashboard - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">

</head>

<body>

  <header>
    <nav>
      <ul>
        <li><a href="riderview.html" class="active">Dashboard</a></li>
        <li><a href="rider_current_orders.html">Orders</a></li>
        <li><a href="rider_history.html">History</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

    <div class="banner">
      <img src="images/rider_banner.jpg" alt="Click2Eat Rider Banner">
    </div>

    <div class="rider-header-content">
      <h1>Rider Name</h1>
      <div class="rider-header-content">
  <h1><?php echo htmlspecialchars($rider['ridername'] ?? 'Rider'); ?></h1>
<p>📞 <strong>Phone:</strong> <?php echo htmlspecialchars($rider['phone'] ?? '—'); ?></p>
<p>🏍️ <strong>Vehicle:</strong> <?php echo htmlspecialchars($rider['vehicle'] ?? '—'); ?></p>
<p>🪪 <strong>License No.:</strong> <?php echo htmlspecialchars($rider['license'] ?? '—'); ?></p>
<p>📍 <strong>Base Address:</strong> <?php echo htmlspecialchars($rider['address'] ?? '—'); ?></p>



    </div>
  </header>

  <main>

    <!-- Current Delivery Section -->
<section class="section-box">
  <h2>Current Delivery</h2>

  <?php if ($currentOrder): ?>
    <div class="order-card">
      <div class="order-details">
        <p><strong>Order #:</strong> <?php echo htmlspecialchars($currentOrder['OrderID']); ?></p>
        <p><strong>Pickup:</strong> <?php echo htmlspecialchars($currentOrder['restaurantname']); ?></p>
        <p><strong>Drop-off:</strong> <?php echo htmlspecialchars($currentOrder['home_address']); ?></p>
        <p><strong>Customer:</strong> <?php echo htmlspecialchars($currentOrder['fullname']); ?></p>
        <p><strong>Payout:</strong> ₱<?php echo number_format($currentOrder['total_amount'], 2); ?></p>
        <p><strong>Status:</strong> 
          <span class="order-status">
            <?php echo $currentOrder['OrderStatus'] == 1 ? 'Waiting for Pickup' : 'In Transit'; ?>
          </span>
        </p>
      </div>
      <div>
        <!-- Current Delivery buttons -->
        <a href="view_order.php?id=<?php echo (int)$currentOrder['OrderID']; ?>" class="action-btn">View Order</a>
        <a href="mark_picked.php?id=<?php echo (int)$currentOrder['OrderID']; ?>" class="action-btn">Mark as Picked Up</a>


      </div>
    </div>
  <?php else: ?>
    <p>No current delivery assigned.</p>
  <?php endif; ?>
</section>


<!-- Available Orders Section -->
<section class="section-box">
  <h2>Available Orders</h2>

  <?php while ($order = mysqli_fetch_assoc($availableResult)): ?>
    <div class="order-card">
      <div class="order-details">
        <p><strong>Order #:</strong> <?php echo htmlspecialchars($order['OrderID']); ?></p>
        <p><strong>Restaurant:</strong> <?php echo htmlspecialchars($order['restaurantname']); ?></p>
        <p><strong>Payout:</strong> ₱<?php echo number_format($order['total_amount'], 2); ?></p>
      </div>
      <div>
        <!-- Available Orders buttons -->
        <a href="accept_order.php?id=<?php echo (int)$order['OrderID']; ?>" class="action-btn">Accept Order</a>
      </div>
    </div>
  <?php endwhile; ?>
</section>


  </main>

  <footer>
    <p>© 2025 Click2Eat | Rider Platform</p>
  </footer>

</body>
</html>
