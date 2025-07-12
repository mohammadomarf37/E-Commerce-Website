<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'], $_POST['quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = max(1, intval($_POST['quantity'])); // At least 1

    $query = "UPDATE cart SET quantity = $quantity WHERE id = $cart_id";
    mysqli_query($conn, $query);
}

header("Location: cart.php");
exit;
