<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$query = "SELECT c.*, p.name, p.price, p.image FROM cart c 
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = $user_id";

$result = mysqli_query($conn, $query);
?>

<h2>Your Cart</h2>
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div>
        <img src="assets/images/<?= $row['image'] ?>" width="100">
        <p><?= $row['name'] ?> (x<?= $row['quantity'] ?>)</p>
        <p>$<?= $row['price'] * $row['quantity'] ?></p>
    </div>
<?php endwhile; ?>

<a href="index.php">Back</a>
