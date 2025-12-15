<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['food_id'], $_POST['price'], $_POST['quantity'], $_POST['branch_id'])) {
    header("Location: home.php");
    exit();
}

$food_id  = (int) $_POST['food_id'];
$price    = (float) $_POST['price'];
$qty      = (int) $_POST['quantity'];
$branchID = (int) $_POST['branch_id'];

/* Initialize cart */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    $_SESSION['cart_branch'] = $branchID; // lock cart to one restaurant
}

/* Prevent mixing restaurants */
if ($_SESSION['cart_branch'] !== $branchID) {
    $_SESSION['cart'] = [];
    $_SESSION['cart_branch'] = $branchID;
}

/* Add/update item */
if (isset($_SESSION['cart'][$food_id])) {
    $_SESSION['cart'][$food_id]['quantity'] += $qty;
} else {
    $_SESSION['cart'][$food_id] = [
        'quantity' => $qty,
        'price' => $price
    ];
}

/* Redirect BACK to correct menu */
header("Location: customer_menu_view.php?branch=" . $branchID);
exit();
