<?php
$conn = new mysqli("localhost", "root", "", "click2eat");

if(isset($_POST['btnRegister'])){
  $username = $_POST['username'];
  $full_name = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $home_address = $_POST['home_address'];
  $work_address = $_POST['work_address'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm-password'];

  if ($password !== $confirm) {
      echo '<script>alert("Passwords must match!");history.back();</script>';
      exit();
  }

  $check = mysqli_query($conn, "SELECT * FROM customer WHERE email='$email'");
  if (mysqli_num_rows($check) > 0) {
    echo '<script>alert("Account already exists.");history.back();</script>';
    exit();
  }
  else{
    $sql = "INSERT INTO customer (username, fullname, email, phone_no, passwd, home_address, work_address)
            VALUES ('$username', '$full_name', '$email', '$phone', '$password', '$home_address', '$work_address')";
    
    if(mysqli_query($conn, $sql)){
      echo '<script>alert("Registration successful!"); window.location="customer_login.php";</script>';
    } else {
      echo '<script>alert("Registration failed.");history.back();</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Click2Eat</title>
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
        <li><a href="login.php">Login</a></li>
        <li><a href="customer_register.php" class="active">Register</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>Create an Account</h2>
    <form action="customer_register.php" method="post">
      <!-- Username -->
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter username" required>
      <!-- Full Name -->
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

      <!-- Email -->
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <!-- Phone -->
      <label for="phone">Phone Number</label>
      <div style="display: flex; gap: 0.5rem;">
        <select id="country-code" name="country-code" required>
            <option value="+1" data-label="🇺🇸 +1">🇺🇸 +1 (US)</option>
            <option value="+63" data-label="🇵🇭 +63">🇵🇭 Philippines</option>
            <option value="+65" data-label="🇸🇬 +65">🇸🇬 Singapore</option>
            <option value="+62" data-label="🇮🇩 +62">🇮🇩 Indonesia</option>
            <option value="+66" data-label="🇹🇭 +66">🇹🇭 Thailand</option>
            <option value="+60" data-label="🇲🇾 +60">🇲🇾 Malaysia</option>
            <option value="+44" data-label="🇬🇧 +44">🇬🇧 UK</option>
            <option value="+91" data-label="🇮🇳 +91">🇮🇳 India</option>
            <option value="+81" data-label="🇯🇵 +81">🇯🇵 Japan</option>
            <option value="+61" data-label="🇦🇺 +61">🇦🇺 Australia</option>
          <!-- Add more as needed -->
        </select>
        <input type="tel" id="phone" name="phone" required>
      </div>

      <!-- Password -->
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Create a password" required>

      <!-- Confirm Password -->
      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter password" required>

      <!-- Home Address -->
      <label for="home_address">Home Address</label>
      <input type="text" id="home_address" name="home_address" placeholder="Enter your home address" required>
      <!-- Home Address -->
      <label for="work_address">Work Address</label>
      <input type="text" id="work_address" name="work_address" placeholder="(Optional)">

      <!-- Register -->
      <button type="submit" name="btnRegister">Register</button>
      <p>Already have an account? <a href="customer_login.php">Login here</a></p>
    </form>
  </main>
</body>
</html>

