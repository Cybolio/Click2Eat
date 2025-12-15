<?php
session_start();

if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$branch_id = $_SESSION['branch_id'];

/* ===============================
   Fetch restaurant info
================================ */
$sql_restaurant = "SELECT restaurantname FROM restaurant WHERE branchID = ?";
$stmt_restaurant = mysqli_prepare($conn, $sql_restaurant);
mysqli_stmt_bind_param($stmt_restaurant, "i", $branch_id);
mysqli_stmt_execute($stmt_restaurant);

$result_restaurant = mysqli_stmt_get_result($stmt_restaurant);
$restaurant = mysqli_fetch_assoc($result_restaurant);

mysqli_stmt_close($stmt_restaurant);

/* ===============================
   Fetch menu items
================================ */
$sql_menu = "SELECT FoodID, name, description, Price 
             FROM menu 
             WHERE `branch-ID` = ? 
             ORDER BY name";

$stmt_menu = mysqli_prepare($conn, $sql_menu);
mysqli_stmt_bind_param($stmt_menu, "i", $branch_id);
mysqli_stmt_execute($stmt_menu);

$menuItems = mysqli_stmt_get_result($stmt_menu);

mysqli_stmt_close($stmt_menu);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Menu - <?php echo htmlspecialchars($restaurant['restaurantname']); ?></title>
<link rel="stylesheet" href="styles.css">
<link rel="icon" href="click2eatlogo.png" type="image/png">
<style>
  .menu-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.8rem;
    border-bottom: 1px solid var(--surface-alt);
  }
  .menu-item-row:last-child { border-bottom: none; }
  .edit-button {
    text-decoration: none;
    background-color: var(--accent-soft);
    color: var(--text);
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: background-color 0.3s;
  }
  .edit-button:hover { background-color: var(--accent); color: white; }
  .add-item-button {
      display: inline-block;
      margin-bottom: 1.5rem;
      padding: 0.8rem 1.5rem;
      background-color: var(--accent);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
  }
</style>
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="restaurant_view.php">Back to Dashboard</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<main>
  <a href="restaurant_add_food.php" class="add-item-button">➕ Add New Menu Item</a>
  <section class="section-box">
    <h2>Your Menu</h2>

    <?php if (mysqli_num_rows($menuItems) > 0): ?>
        <?php while ($menu = mysqli_fetch_assoc($menuItems)): ?>
            <div class="menu-item-row">
                <p><?php echo htmlspecialchars($menu['name']); ?></p>
                <a href="restaurant_edit_menu_item.php?id=<?php echo $menu['FoodID']; ?>" class="edit-button">
                    Edit
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">You haven't added any menu items yet.</p>
    <?php endif; ?>
</section>
</main>
</body>
</html>