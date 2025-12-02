<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "click2eat");
if (isset($_POST['btnLogin'])) {

    $username = $_POST['usernametxt'];
    $password = $_POST['passwordtxt'];

    $sql_customer   = "SELECT * FROM customer   WHERE (Email='$username' OR username='$username') AND password='$password' LIMIT 1";
    $sql_restaurant = "SELECT * FROM restaurant WHERE Email='$username' AND password='$password' LIMIT 1";
    $sql_rider      = "SELECT * FROM rider      WHERE Email='$username' AND password='$password' LIMIT 1";

    $result1 = mysqli_query($conn, $sql_customer);
    $result2 = mysqli_query($conn, $sql_restaurant);
    $result3 = mysqli_query($conn, $sql_rider);

    if (mysqli_num_rows($result1) == 1) {
        $row = mysqli_fetch_assoc($result1);
        $_SESSION['customer_id'] = $row['CustomerID'];   // adjust name to match your table
        $_SESSION['customer_username'] = $row['username'];
        header("Location: home.php");
        exit();
    }
    // Restaurant
    else if (mysqli_num_rows($result2) == 1) {
        $row = mysqli_fetch_assoc($result2);
        $_SESSION['branch_id'] = $row['branchID'];  // adjust to your actual column name
        header("Location: restaurant_view.php");
        exit();
    }
    // Rider
    else if (mysqli_num_rows($result3) == 1) {
        $row = mysqli_fetch_assoc($result3);
        $_SESSION['rider_id'] = $row['RiderID'];  // adjust to your actual column name
        header("Location: riderview.php");
        exit();
    }
    // Not found
    else {
        echo "<script>alert('Invalid credentials.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">

  <!-- Logo Placeholder -->
  <link rel="icon" href="click2eatlogo.png" type="image/png">
</head>
<body>
  <header>
    <nav>
    <ul>
      <li class="dropdown">
        <a href="login.php" class="dropbtn">Be Our Partner</a>
        <div class="dropdown-content">
          <a href="rider_register.php">Rider</a>
          <a href="restaurant_register.php">Restaurant</a>
        </div>
      </li>
      <li><a href="login.php" class="active">Login</a></li>
      <li><a href="customer_register.php">Register</a></li>
    </ul>
  </nav>

  </header>

  <main class="form-container">
    <h2>Login to Click2Eat</h2>
    <form action="login.php" method="post">
      <label for="username">Username/E-mail</label>
      <input type="text" id="username" name="usernametxt" placeholder="Enter username/e-mail" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="passwordtxt" placeholder="Enter password" required>

      <button type="submit" name="btnLogin">Login</button>
      <p><a href="#">Forgot password?</a></p>
    </form>
  </main>
</body>
</html>
