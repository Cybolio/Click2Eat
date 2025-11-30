<?php
$conn = mysqli_connect("localhost","root","","click2eat");

if(isset($_POST['btnRegister'])){

    $fullname = $_POST['owner_fullname'];
    $email    = $_POST['branch_email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm-password'];
    $phone    = $_POST['phone'];
    $restaurant_name  = $_POST['restaurant_name'];
    $branch_address  = $_POST['branch_address'];

    if ($password !== $confirm) {
        echo '<script>alert("Passwords must match!");</script>';
        exit();
    }

    $check = mysqli_query($conn, "SELECT * FROM rider WHERE Email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo '<script>alert("Account already exists.");</script>';
    }

    else{
        $sql = "INSERT INTO restaurant (branchaddress,email,restaurantname,`contact-num`,manager,password)
            VALUES ('$branch_address', '$email', '$restaurant_name', '$phone', '$fullname', '$password')";

        mysqli_query($conn, $sql);

        echo '<script>alert("Registration successful!");</script>';
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
        <li><a href="restaurant_login.php">Login as Restaurant</a></li>
        <li><a href="customer_register.php" class="active">Register as a customer</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>REGISTER YOUR BRANCH</h2>
    <form action="restaurant_register.php" method="post">
      <!-- Full Name -->
      <label for="fullname">Owner/Manager's Full Name</label>
      <input type="text" id="fullname" name="owner_fullname" placeholder="Enter Owner/Manager's full name" required>
      <!-- Email -->
      <label for="email">Email</label>
      <input type="email" id="email" name="branch_email" placeholder="Enter your email" required>
      
      <!-- Password -->
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Create a password" required>

      <!-- Confirm Password -->
      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter password" required>

      

      <!-- Phone -->
      <label for="phone">Contact Number</label>
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
      <!-- Restaurant Name -->
      <label for="restaurant_name">Restaurant Name</label>
      <input type="text" id="restaurant_name" name="restaurant_name" placeholder="Enter restaurant's name" required>
      <!-- Branch Address -->
      <label for="branch_address">Branch Address</label>
      <input type="text" id="branch_address" name="branch_address" placeholder="Unit No./Building Name, Street, Barangay, City, Province/State" required>

      <!-- Register -->
      <button type="submit" name="btnRegister">Register Branch</button>
      <p>Already have a business account? <a href="restaurant_login.php">Login here</a></p>
    </form>
  </main>
</body>
</html>
