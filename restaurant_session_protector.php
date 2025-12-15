<?php
session_start();

/* ===============================
   HARD SESSION CHECK
================================ */
if (!isset($_SESSION['branch_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "click2eat");
if (!$conn) {
    die("Connection failed");
}

$branch_id = $_SESSION['branch_id'];

/* ===============================
   Fetch restaurant securely
================================ */
$sql = "SELECT restaurantname, password FROM restaurant WHERE branchID = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $branch_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$restaurant = mysqli_fetch_assoc($result)) {
    // Session is invalid or restaurant deleted
    session_destroy();
    header("Location: login.php");
    exit();
}

mysqli_stmt_close($stmt);

/* ===============================
   Handle confirmation
================================ */
if (isset($_POST['btnConfirm'])) {
    $password = $_POST['passwordtxt'];

    if ($restaurant['password'] === $password) {
        $_SESSION['menu_edit_confirmed'] = true;
        header("Location: restaurant_menu_edit.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials.');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Session Confirm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="form-container" style="max-width:400px; text-align:center;">
    <h2><?php echo htmlspecialchars($restaurant['restaurantname']); ?> Confirm</h2>
    <p>Enter password</p>

    <form method="post">
        <input type="password" name="passwordtxt" placeholder="Password" required>
        <button type="submit" name="btnConfirm">Confirm</button>
    </form>
</main>

</body>
</html>
