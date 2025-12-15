<?php
session_start(); 

// Create connection
$conn = mysqli_connect("localhost", "root", "", "click2eat");

$loggedIn = isset($_SESSION['customer_id']);
$username = $loggedIn ? $_SESSION['customer_username'] : '';
if (!$loggedIn) {
    header("Location: login.php");  
}

$restaurants = [];
$sql = "SELECT branchID, restaurantname, branchaddress
        FROM restaurant
        WHERE status = 1
        ORDER BY restaurantname";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Click2Eat - Online Ordering</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">
  <style>
    .image-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px 0;
    }
    .grid-item {
      text-align: center;
      text-decoration: none;
      color: #333;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 8px;
      transition: transform 0.2s;
    }
    .grid-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .grid-item div {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .grid-item img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 4px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
<header>
  <div class="banner">
    <img src="banner.png" alt="Banner Placeholder">
  </div>

  <nav>
    <ul>
      <li><a href="edit_profile.php">Edit Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
      <li>
        <a href="customer_view_cart.php">
          🛒 View Cart
          <?php if (!empty($_SESSION['cart'])): ?>
            (<?= array_sum(array_column($_SESSION['cart'], 'quantity')) ?>)
          <?php endif; ?>
        </a>
      </li>
    </ul>
  </nav>
  
</header>

<main>
  <h1>Welcome, <?= htmlspecialchars($username) ?></h1>
  <p>Restaurant's available:</p>

  <section class="image-grid">
    <?php if (count($restaurants) > 0): ?>
        <?php foreach ($restaurants as $restaurant): ?>
          <a href="customer_menu_view.php?branch=<?= htmlspecialchars($restaurant['branchID']) ?>" class="grid-item">
            <div>
              <img src="images/restaurant_placeholder.jpg" alt="<?= htmlspecialchars($restaurant['restaurantname']) ?>">
              <p><?= htmlspecialchars($restaurant['restaurantname']) ?>, <?= htmlspecialchars($restaurant['branchaddress']) ?></p>
            </div>
          </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No restaurants are currently available.</p>
    <?php endif; ?>
  </section>
</main>

<footer>
  <p>© 2025 Click2Eat | All Rights Reserved</p>
</footer>
</body>
</html>
``