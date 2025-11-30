<?php
	$conn= mysqli_connect("localhost","root","","click2eat");

if(isset($_POST['btnRegister'])){

    $username = $_POST['usernametxt']; 
    $password = $_POST['passwordtxt'];

    $sql = "SELECT * FROM rider WHERE Email='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==0)
			echo "<script>
						alert('Invalid credentials.');
					</script>";
		else
			header("Location:home.php");
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
        <a href="#" class="dropbtn">Be Our Partner</a>
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
    <form action="#" method="post">
      <label for="username">Username/E-mail</label>
      <input type="text" id="username" name="usernametxt" placeholder="Enter username/e-mail" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="passwordtxt" placeholder="Enter password" required>

      <button type="submit" name = "btnRegister">Login</button>
      <p><a href="#">Forgot password?</a></p>
    </form>
  </main>
</body>
</html>

