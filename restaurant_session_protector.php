<?php
session_start();
$conn = mysqli_connect("localhost","root","","click2eat");

if (isset($_POST['btnLogin'])) {

    $username = $_POST['usernametxt']; 
    $password = $_POST['passwordtxt'];

    $sql = "SELECT * FROM restaurant WHERE Email='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['restaurantID'] = $row['restaurantID'];

        header("Location: restaurant_add_food.php");
        exit();

    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Session Confirm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="form-container" style="max-width:400px; text-align:center;">
    <h2>Restaurant Session Confirm</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post" action="">
        <input type="text" name="usernametxt" placeholder="Email" required>
        <input type="password" name="passwordtxt" placeholder="Password" required>

        <button type="submit" name="btnLogin">Login</button>
    </form>

</main>

</body>
</html>
