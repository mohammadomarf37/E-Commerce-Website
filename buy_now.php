<?php
session_start();
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


$user_id = $_SESSION['user']['id'];
// GET wali line hata do
// if (!isset($_GET['id'])) {...}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['product_id'])) {
        echo "Invalid product request.";
        exit;
    }

    $product_id = intval($_POST['product_id']);
} else {
    echo "Invalid request.";
    exit;
}


$product_result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
$product = mysqli_fetch_assoc($product_result);

if (!$product) {
    echo "Product not found.";
    exit;
}

$user_result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = intval($_POST['quantity']);
    $address = trim($_POST['address']);
    $price = $product['price'];
    $total = $price * $quantity;

    // PHP Validation
    if ($address === "") {
        echo "❌ Address cannot be empty or only spaces.";
        exit; // Stop processing further
    }

    // Insert into orders
    $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, product_id, full_name, email, contact_number, address, quantity, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iissssii", $user_id, $product_id, $user['name'], $user['email'], $user['contact'], $address, $quantity, $total);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conn);

    // Insert into order_items


    $stmt_item = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, price, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt_item, "iiiii", $order_id, $product_id, $price, $quantity, $total);
    mysqli_stmt_execute($stmt_item);

    // $_SESSION['order_placed'] = 'Order placed successfully!';
    // header("Location: product.php?id=$product_id");
    // exit;
    
    // Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'form.submission4@gmail.com';
        $mail->Password = 'kjlx mcmj kxnr jkyy';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('form.submission4@gmail.com', 'New Order!');
        $mail->addAddress('mohammadomarf37@gmail.com');

        $mail->Subject = "New Order Received";
        $mail->Body = "
            New Order Details:
            Full Name: {$user['name']}
            Email: {$user['email']}
            Contact: {$user['contact']}
            Address: $address
            Quantity: $quantity
            Product: {$product['name']}
        ";

        $mail->send();
        echo "Order placed successfully!";

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



