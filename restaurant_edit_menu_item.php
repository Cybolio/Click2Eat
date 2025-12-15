<?php
session_start();

if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: restaurant_edit_menu.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$branch_id = $_SESSION['branch_id'];
$food_id   = (int) $_GET['id'];

/* ===============================
   Fetch menu item
================================ */
$sql = "SELECT FoodID, name, description, Price, Category, Availability
        FROM menu
        WHERE FoodID = ? AND `branch-ID` = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $food_id, $branch_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$food = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$food) {
    mysqli_close($conn);
    echo "<script>alert('Menu item not found.'); window.location='restaurant_manage_menu.php';</script>";
    exit();
}

/* ===============================
   Handle form submit
================================ */
if (isset($_POST['btnUpdate'])) {

    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $category    = $_POST['category'];
    $available   = isset($_POST['availability']) ? 1 : 0;

    $update_sql = "UPDATE menu
                   SET name = ?, description = ?, Price = ?, Category = ?, Availability = ?
                   WHERE FoodID = ? AND `branch-ID` = ?";

    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param(
        $update_stmt,
        "ssdsiii",
        $name,
        $description,
        $price,
        $category,
        $available,
        $food_id,
        $branch_id
    );

    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);

    mysqli_close($conn);

    echo "<script>alert('Menu item updated successfully!'); window.location='restaurant_menu_edit.php';</script>";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Menu Item</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
  <nav>
    <ul>
      <li><a href="restaurant_manage_menu.php">⬅ Back to Menu</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<main class="form-container">
<h2>Edit Menu Item</h2>

<form method="post">
    <label>Food Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($food['name']); ?>" required>

    <label>Description</label>
    <textarea name="description" required><?php echo htmlspecialchars($food['description']); ?></textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="<?php echo $food['Price']; ?>" required>

    <label for="category">Category</label>
      <select id="category" value="<?php echo htmlspecialchars($food['Category']); ?>" name="category" required>
          <option value="Appetizer">Appetizer</option>
          <option value="Main Course">Main Course</option>
          <option value="Dessert">Dessert</option>
          <option value="Drink">Drink</option>
      </select>

    <label>
        <input type="checkbox" name="availability" <?php echo $food['Availability'] ? 'checked' : ''; ?>>
        Available
    </label>

    <button type="submit" name="btnUpdate">Update Item</button>
</form>
</main>

</body>
</html>
