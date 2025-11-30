<?php
session_start();
if (!isset($_SESSION['restaurantID'])) {
    header("Location: restaurant_login.php");
    exit();
}
?>

<?php
$conn = mysqli_connect("localhost","root","","click2eat");

if (isset($_POST['submit_item'])) {

    $foodname = $_POST['food_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $categ = $_POST['category'];

    $sqlSelect = "SELECT * FROM menu WHERE name = '$foodname'";
    $result = mysqli_query($conn, $sqlSelect);

    if (mysqli_num_rows($result) == 0 ) {
        
        $branchID = 1; 
        $sqlMenu = "INSERT INTO menu(name, `branch-ID`, description, price, category) 
            VALUES ('$foodname', '$branchID', '$desc', '$price', '$categ')";
        
        if (mysqli_query($conn, $sqlMenu)) {
             echo "<script>alert('Menu item added successfully');</script>";
        } else {
             echo "Error: " . mysqli_error($conn); 
        }

    } else {
        echo "<script>alert('Food item is existing.');</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Menu Item - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="restaurant_view.html">Back to Menu</a></li>
        <li><a href="login.html">Login</a></li>
      </ul>
    </nav>
  </header>

  <main class="form-container">
    <h2>Upload New Menu Item</h2>
    
    <form method="POST">
      
      <label for="food_name">Dish Name</label>
      <input type="text" id="food_name" name="food_name"  required>
      
      <label for="description">Description</label>
      <input type="text" id="description" name="description" >

      <label for="price">Price (Php)</label>
      <input type="number" id="price" name="price" step="0.01" min="0" required>
      
      <label for="category">Category</label>
      <select id="category" name="category" required>
          <option value="Appetizer">Appetizer</option>
          <option value="Main Course">Main Course</option>
          <option value="Dessert">Dessert</option>
          <option value="Drink">Drink</option>
      </select>


      <button type="submit" name="submit_item">Upload Item</button>
      
    </form>
  </main>
</body>
</html>