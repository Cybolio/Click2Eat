<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
$branchID = $_SESSION['cart_branch'] ?? 0;

if (empty($cart)) {
    echo "<script>
            alert('Cart is empty');
            window.location.href = 'home.php';
          </script>";
    exit();
}

$conn = mysqli_connect("localhost","root","","click2eat");

/* Fetch food names */
$foodIDs = implode(',', array_keys($cart));
$sql = "SELECT FoodID, name FROM menu WHERE FoodID IN ($foodIDs)";
$result = mysqli_query($conn, $sql);

$foodNames = [];
while ($row = mysqli_fetch_assoc($result)) {
    $foodNames[$row['FoodID']] = $row['name'];
}

mysqli_close($conn);

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<main>

  <div class="section-box">
    <h2>Your Cart</h2>

    <table style="width:100%; border-collapse: collapse;">
      <thead>
        <tr style="border-bottom:2px solid var(--accent-soft);">
          <th style="text-align:left; padding:10px;">Food</th>
          <th style="text-align:center; padding:10px;">Qty</th>
          <th style="text-align:right; padding:10px;">Price</th>
          <th style="text-align:right; padding:10px;">Subtotal</th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($cart as $foodID => $item): 
          $subtotal = $item['quantity'] * $item['price'];
          $total += $subtotal;
      ?>
        <tr style="border-bottom:1px dashed var(--accent-soft);">
          <td style="padding:10px;">
            <?= htmlspecialchars($foodNames[$foodID] ?? 'Unknown') ?>
          </td>
          <td style="text-align:center;">
            <?= $item['quantity'] ?>
          </td>
          <td style="text-align:right;">
            PHP <?= number_format($item['price'], 2) ?>
          </td>
          <td style="text-align:right; font-weight:bold;">
            PHP <?= number_format($subtotal, 2) ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="3" style="text-align:right; padding-top:15px;">
            <strong>Total</strong>
          </td>
          <td style="text-align:right; padding-top:15px; font-size:1.2rem; color:var(--accent);">
            <strong>PHP <?= number_format($total, 2) ?></strong>
          </td>
        </tr>
      </tfoot>
    </table>

    <form action="customer_confirm_order.php" method="POST" style="margin-top:2rem;">
      <button type="submit" class="action-btn" style="width:100%; font-size:1.1rem;">
        Confirm Delivery
      </button>
    </form>

  </div>

</main>

<footer>
  <p>© 2025 Click2Eat | All Rights Reserved</p>
</footer>

</body>
</html>

