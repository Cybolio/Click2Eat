<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$branch_id = (int)$_SESSION['branch_id'];

/* ===============================
   HANDLE DELETE (POST)
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_food_id'])) {

    $food_id = (int)$_POST['delete_food_id'];

    $sql_delete = "
        DELETE FROM menu
        WHERE FoodID = ?
          AND `branch-ID` = ?
    ";

    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "ii", $food_id, $branch_id);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);

    // Prevent form resubmission
    header("Location: restaurant_menu_edit.php");
    exit();
}

/* ===============================
   FETCH RESTAURANT INFO
================================ */
$sql_restaurant = "
    SELECT restaurantname
    FROM restaurant
    WHERE branchID = ?
";

$stmt_restaurant = mysqli_prepare($conn, $sql_restaurant);
mysqli_stmt_bind_param($stmt_restaurant, "i", $branch_id);
mysqli_stmt_execute($stmt_restaurant);
$result_restaurant = mysqli_stmt_get_result($stmt_restaurant);
$restaurant = mysqli_fetch_assoc($result_restaurant);
mysqli_stmt_close($stmt_restaurant);

/* ===============================
   FETCH MENU ITEMS
================================ */
$sql_menu = "
    SELECT
        FoodID,
        name,
        Category,
        Price,
        Availability
    FROM menu
    WHERE `branch-ID` = ?
    ORDER BY name
";

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

.menu-item-row:last-child {
    border-bottom: none;
}

.menu-info {
    display: flex;
    flex-direction: column;
}

.menu-info small {
    color: #777;
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    text-decoration: none;
}

.edit-btn {
    background-color: var(--accent-soft);
    color: var(--text);
}

.edit-btn:hover {
    background-color: var(--accent);
    color: white;
}

.delete-btn {
    background-color: #d9534f;
    color: white;
}

.delete-btn:hover {
    background-color: #c9302c;
}

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

            <div class="menu-info">
                <strong><?php echo htmlspecialchars($menu['name']); ?></strong>
                <small>
                    <?php echo htmlspecialchars($menu['Category']); ?> —
                    ₱<?php echo number_format($menu['Price'], 2); ?>
                    <?php if ((int)$menu['Availability'] === 0): ?>
                        <span style="color:red;">(Unavailable)</span>
                    <?php endif; ?>
                </small>
            </div>

            <div class="actions">
                <a href="restaurant_edit_menu_item.php?id=<?php echo $menu['FoodID']; ?>"
                   class="btn edit-btn">
                    Edit
                </a>

                <form method="post" style="margin:0;">
                    <input type="hidden" name="delete_food_id"
                           value="<?php echo $menu['FoodID']; ?>">
                    <button type="submit"
                            class="btn delete-btn"
                            onclick="return confirm('Delete this menu item? This cannot be undone.');">
                        Delete
                    </button>
                </form>
            </div>

        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center;">You haven't added any menu items yet.</p>
<?php endif; ?>

</section>

</main>

</body>
</html>
