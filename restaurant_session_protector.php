<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "click2eat");
$branch_id = $_SESSION["branch_id"];
$getRestaurant = "SELECT * FROM restaurant WHERE branchID = '$branch_id' LIMIT 1";
$result = mysqli_query($conn, $getRestaurant);
$restaurant = mysqli_fetch_assoc($result);
if(isset($_POST['btnConfirm'])){
    
    $password = $_POST["passwordtxt"];
    if($restaurant['password']==$password){
        header("Location: restaurant_add_food.php");
        exit();  
    }else{
        echo "<script>alert('Invalid credentials.');</script>";
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
    <h2><?php echo htmlspecialchars($restaurant['restaurantname']) ?> Confirm</h2>
    <p>Enter password</p>


    <form method="post" action="restaurant_session_protector.php">
        <input type="password" name="passwordtxt" placeholder="Password" required>

        <button type="submit" name="btnConfirm">Confirm</button>
    </form>

</main>

</body>
</html>
