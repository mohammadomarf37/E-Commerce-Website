<?php
session_start();
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    if ($address === "") {
        echo "<script>alert('❌ Address cannot be empty or only spaces.'); window.history.back();</script>";
        exit;
    }

    // Insert order
    $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, full_name, email, contact_number, address) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $full_name, $email, $contact, $address);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conn);

    // Fetch cart items
    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");
    $items_body = "";
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];

        $product_result = mysqli_query($conn, "SELECT name, price FROM products WHERE id = $product_id");
        $product = mysqli_fetch_assoc($product_result);
        $price = $product['price'];
        $name = $product['name'];
        $total = $price * $quantity;

        // Save order item
        $item_stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($item_stmt, "iiidd", $order_id, $product_id, $quantity, $price, $total);
        mysqli_stmt_execute($item_stmt);

        // Prepare email body
        $items_body .= "
            Product: $name
            Quantity: $quantity
            Unit Price: $$price
            Total: $$total

        ";
    }

    // Clear cart
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

    // Email
    $mail = new PHPMailer(true);

    try {
        // SMTP Config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'form.submission4@gmail.com';
        $mail->Password = 'kjlx mcmj kxnr jkyy'; // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Mail Settings
        $mail->setFrom('form.submission4@gmail.com', 'New Cart Checkout!');
        $mail->addAddress('mohammadomarf37@gmail.com');

        $mail->Subject = "🛒 New Cart Order Placed";
        $mail->Body = "
            ✅ A New Cart Checkout Order Has Been Placed:

            Full Name: $full_name
            Email: $email
            Contact Number: $contact
            Address: $address

            ------- Items Ordered -------
            $items_body
        ";

        $mail->send();
    } catch (Exception $e) {
        // You can log error here if needed
    }

    echo "<script>alert('✅ Order placed successfully!'); window.location.href='index.php';</script>";
}
?>
