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
        $branchID = 0; 
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