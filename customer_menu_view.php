<?php
session_start();

$loggedIn = isset($_SESSION['customer_id']);
$customerID = $loggedIn ? $_SESSION['customer_id'] : null;
$username = $loggedIn ? $_SESSION['customer_username'] : '';

if (!$loggedIn) {
    header("Location: login.php");
    exit();
}

$branchID = isset($_GET['branch']) ? (int)$_GET['branch'] : 0;

if ($branchID === 0) {
    header("Location: home.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* ==============================
   FETCH RESTAURANT NAME
   ============================== */

$restaurantName = "Restaurant Menu";

$sql_restaurant = "SELECT restaurantname FROM restaurant WHERE branchID = ? LIMIT 1";
$stmt_restaurant = mysqli_prepare($conn, $sql_restaurant);
mysqli_stmt_bind_param($stmt_restaurant, "i", $branchID);
mysqli_stmt_execute($stmt_restaurant);

$result_restaurant = mysqli_stmt_get_result($stmt_restaurant);

if (mysqli_num_rows($result_restaurant) > 0) {
    $restaurant = mysqli_fetch_assoc($result_restaurant);
    $restaurantName = htmlspecialchars($restaurant['restaurantname']);
} else {
    mysqli_close($conn);
    header("Location: home.php");
    exit();
}

mysqli_stmt_close($stmt_restaurant);

/* ==============================
   FETCH MENU ITEMS
   ============================== */

$menuItems = [];
$categories = [];

$sql_menu = "
    SELECT FoodID, name, description, Price, Category, Availability
    FROM menu
    WHERE `branch-ID` = ? AND Availability = 1
    ORDER BY Category, name
";

$stmt_menu = mysqli_prepare($conn, $sql_menu);
mysqli_stmt_bind_param($stmt_menu, "i", $branchID);
mysqli_stmt_execute($stmt_menu);

$result_menu = mysqli_stmt_get_result($stmt_menu);

while ($row = mysqli_fetch_assoc($result_menu)) {
    $category = $row['Category'];

    if (!isset($menuItems[$category])) {
        $menuItems[$category] = [];
        $categories[] = $category;
    }

    $menuItems[$category][] = $row;
}

mysqli_stmt_close($stmt_menu);
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $restaurantName ?> Menu - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">
  <style>
    /* Add specific styling for the menu page */
    .menu-section {
        margin-bottom: 30px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #eee;
    }
    .menu-item:last-child {
        border-bottom: none;
    }
    .item-details h4 {
        margin: 0 0 5px 0;
        color: #333;
    }
    .item-details p {
        margin: 0;
        font-size: 0.9em;
        color: #666;
    }
    .item-price {
        font-weight: bold;
        color: #28a745; /* A color for prices */
        min-width: 80px;
        text-align: right;
    }
    .add-to-cart-form {
        display: flex;
        align-items: center;
    }
    .add-to-cart-form input[type="number"] {
        width: 50px;
        margin-right: 10px;
        text-align: center;
    }
    .add-to-cart-form button {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .add-to-cart-form button:hover {
        background-color: #0056b3;
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
      <li><a href="home.php">Home</a></li>
      <li>Welcome, <?= htmlspecialchars($username) ?></li>
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
  <h1><?= $restaurantName ?> Menu</h1>
  <p>Select your favorite dishes and add them to your order.</p>

  <?php if (count($menuItems) > 0): ?>
    <?php foreach ($categories as $category): ?>
      <div class="menu-section">
        <h2><?= htmlspecialchars($category) ?></h2>
        <?php foreach ($menuItems[$category] as $item): ?>
          <div class="menu-item">
            <div class="item-details">
              <h4><?= htmlspecialchars($item['name']) ?></h4>
              <p><?= htmlspecialchars($item['description']) ?></p>
            </div>
            <div class="item-price">
              PHP <?= number_format($item['Price'], 2) ?>
            </div>
            <form action="customer_add_to_cart.php" method="POST" class="add-to-cart-form">
              <input type="hidden" name="food_id" value="<?= $item['FoodID'] ?>">
              <input type="hidden" name="price" value="<?= $item['Price'] ?>">
              <input type="hidden" name="branch_id" value="<?= $branchID ?>">
              <input type="number" name="quantity" value="1" min="1" max="10" required>
              <button type="submit">Add to Cart</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>

  <?php else: ?>
    <p>Sorry, there are no menu items available for <?= $restaurantName ?> right now.</p>
  <?php endif; ?>

</main>

<footer>
  <p>© 2025 Click2Eat | All Rights Reserved</p>
</footer>
</body>
</html>