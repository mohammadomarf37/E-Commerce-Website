<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $query = "DELETE FROM cart WHERE id = $cart_id";
    mysqli_query($conn, $query);
}

header("Location: cart.php");
exit;
