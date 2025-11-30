<?php
$conn = mysqli_connect("localhost","root","","click2eat");

if(isset($_POST['btnRegister'])){

    $fullname = $_POST['fullname'];
    $license  = $_POST['license'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $vehicle  = $_POST['vehicle'];
    $address  = $_POST['address'];
    $plate    = $_POST['platenum'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        echo '<script>alert("Passwords must match!");</script>';
        exit(); // stop execution
    }

    $check = mysqli_query($conn, "SELECT * FROM rider WHERE Email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo '<script>alert("Account already exists.");</script>';
    }
    else{
        $insertRider = "INSERT INTO rider (`LicenseNo.`, fullname, Email, `phone-no`, 
                        `vehicle-type`, address, platenum, password)
                        VALUES ('$license', '$fullname', '$email', '$phone', 
                                '$vehicle', '$address', '$plate', '$password')";
        
        mysqli_query($conn, $insertRider);

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
        <li><a href="rider_login.php">Login as a Rider</a></li>
        <li><a href="register.php" class="active">Register as a customer</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>REGISTER AS A RIDER</h2>
      <form action="#" method="post">
      <!-- Full Name -->
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>
        <!-- Email -->
      <label for="license">Professional Driver's License No.</label>
      <input type="text" id="license" name="license" placeholder="A00-00-000000" required>


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
      <label for="confirm">Confirm Password</label>
      <input type="password" id="confirm" name="confirm" placeholder="Re-enter password" required>
      
      <!-- Home Address -->
      <label for="address">Home Address</label>
      <input type="text" id="address" name="address" placeholder="Enter your home address" required>
      <!-- PlateNum -->
      <label for="platenum">Plate Number</label>
      <input type="text" id="platenum" name="platenum" placeholder="Enter plate no." required>
      
      <!-- Vehicle Type -->
      <label for="vehicle">Vehicle Type</label>
      <input type="text" id="vehicle" name="vehicle" placeholder="YEAR MAKE MODEL, COLOR" required>
      
      

      <!-- Register -->
      <button type="submit" name="btnRegister">Register As Rider</button>
      <p>Already have a rider account? <a href="rider_login.php">Login here</a></p>
    </form>
  </main>
</body>
</html>

