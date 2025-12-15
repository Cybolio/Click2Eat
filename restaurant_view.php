<?php
session_start();
if (isset($_POST['toggle_status'])) {
    $conn = mysqli_connect("localhost","root","","click2eat");

    $branch_id = $_SESSION['branch_id'];

    $sql = "UPDATE restaurant
            SET status = NOT status
            WHERE branchID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $branch_id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Refresh page to show updated status
    header("Location: restaurant_view.php");
    exit();
}

if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","click2eat");
$branch_id = $_SESSION['branch_id'];

$sql = "SELECT * FROM restaurant WHERE branchID = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $branch_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$restaurant = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);
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
    .manage-menu-button {
        display: inline-block;
        margin: 1rem 0;
        padding: 1rem 2rem;
        background-color: var(--accent);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: background-color 0.3s;
    }
    .manage-menu-button:hover {
        background-color: var(--accent-warm);
    }
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
        <form method="POST" style="display:inline;">
          <p>🕒 <strong>Status:</strong>
            <span id="statusText" style="font-weight:bold; color: <?php echo $restaurant['status'] ? 'green' : 'red'; ?>">
              <?php echo $restaurant['status'] ? 'OPEN' : 'CLOSED'; ?>
            </span>
          </p>
          <button type="submit" name="toggle_status" class="manage-menu-button">
              Open/Close Restaurant
          </button>
        </form>
      <p>📞 <strong>Contact:</strong> <?php echo htmlspecialchars($restaurant['contact-num']); ?></p>
    </div>
  </div>
</header>

<main>
  <a href="restaurant_session_protector.php" class="manage-menu-button">📋 Manage Menu</a>

  <h2>Featured Dishes</h2>
  <section class="image-grid">
  </section>
</main>
</body>
</html>
