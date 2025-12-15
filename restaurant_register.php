<?php
$conn = mysqli_connect("localhost","root","","click2eat");

if (!$conn) {
    die("Database connection failed");
}

if(isset($_POST['btnRegister'])){

    $restaurant = $_POST['restaurantname'];
    $manager    = $_POST['manager'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $address    = $_POST['branchaddress'];
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm'];

    if ($password !== $confirm) {
        echo '<script>alert("Passwords must match!");</script>';
        exit();
    }

    $check = mysqli_query($conn, "SELECT * FROM restaurant WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo '<script>alert("Account already exists.");</script>';
    }
    else{
        $insert = "INSERT INTO restaurant  
                   (branchaddress, email, restaurantname, contactnum, manager, password)
                   VALUES
                   ('$address', '$email', '$restaurant', '$phone', '$manager', '$password')";

        mysqli_query($conn, $insert);

        echo '<script>alert("Registration successful!"); window.location="login.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Restaurant - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">
</head>
<body>

<header>
  <nav>
    <ul>
      <li><a href="login.php">Login</a></li>
      <li><a href="#" class="active">Register Restaurant</a></li>
    </ul>
  </nav>
</header>

<main class="form-container">
  <h2>REGISTER RESTAURANT</h2>

  <form action="#" method="post">

    <!-- Restaurant Name -->
    <label for="restaurantname">Restaurant Name</label>
    <input type="text" id="restaurantname" name="restaurantname" required>

    <!-- Manager Name -->
    <label for="manager">Manager Name</label>
    <input type="text" id="manager" name="manager" required>

    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <!-- Contact Number -->
    <label for="phone">Contact Number</label>
    <input type="text" id="phone" name="phone" required>

    <!-- Branch Address -->
    <label for="branchaddress">Branch Address</label>
    <input type="text" id="branchaddress" name="branchaddress" required>

    <!-- Password -->
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <!-- Confirm Password -->
    <label for="confirm">Confirm Password</label>
    <input type="password" id="confirm" name="confirm" required>

    <button type="submit" name="btnRegister">Register</button>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </form>
</main>

</body>
</html>
