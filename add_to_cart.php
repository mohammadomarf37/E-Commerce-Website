<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];  // ✅ user_id from session
$product_id = intval($_GET['id']);

// Check if product already exists in user's cart
$check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");

if (mysqli_num_rows($check) > 0) {
    // Already in cart: increase quantity
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
} else {
    // Not in cart: insert new row
    mysqli_query($conn, "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)");
}

header("Location: cart.php");
exit;
?>
