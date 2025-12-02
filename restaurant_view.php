<?php
session_start();

if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","click2eat");
$branch_id = $_SESSION['branch_id'];

// Fetch restaurant info
$getRestaurant = "SELECT * FROM restaurant WHERE branchID = $branch_id LIMIT 1";
$result = mysqli_query($conn, $getRestaurant);
$restaurant = mysqli_fetch_assoc($result);

// Optional: fetch menu items
$getMenu = "SELECT * FROM menu WHERE `branch-ID` = $branch_id";
$menuResult = mysqli_query($conn, $getMenu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($restaurant['restaurantname']); ?> - Click2Eat</title>
<link rel="stylesheet" href="styles.css">
<link rel="icon" href="click2eatlogo.png" type="image/png">
<style>
/* Keep your CSS here */
</style>
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="restaurant_view.php" class="active">Dashboard</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <div class="banner">
    <img src="banner.png" alt="Restaurant Cover">
  </div>

  <div class="restaurant-header-content">
    <h1><?php echo htmlspecialchars($restaurant['restaurantname']); ?></h1>
    <div class="restaurant-info">
      <p>📍 <strong>Address:</strong> <?php echo htmlspecialchars($restaurant['branchaddress']); ?></p>
      <p>⭐ <strong>Rating:</strong> 4.7 (1,200+)</p>
      <p>🕒 <strong>Hours:</strong> 10:00 AM – 10:00 PM</p>
      <p>📞 <strong>Contact:</strong> <?php echo htmlspecialchars($restaurant['contact-num']); ?></p>
    </div>
  </div>
</header>

<main>
  <a href="restaurant_session_protector.php" class="add-item-button">➕ Add New Menu Item</a>

  <h2>Featured Dishes</h2>
  <section class="image-grid">
    <?php while($menu = mysqli_fetch_assoc($menuResult)): ?>
      <div class="menu-item">
        <p><?php echo htmlspecialchars($menu['name']); ?></p>
      </div>
    <?php endwhile; ?>
  </section>
</main>
</body>
</html>
