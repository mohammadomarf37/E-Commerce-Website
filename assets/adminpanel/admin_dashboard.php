<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php");
  exit;
}
?>

<?php
include '../../config.php';
include 'products_section.php';
include 'orders_section.php';
include 'order_items_section.php';
include 'users_section.php';
include 'views_section.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>

<body>
  <header>
    <h1>📊 Admin Dashboard</h1>
    <a href="admin_logout.php">Logout</a>
  </header>

  <?php include 'metrics.php'; ?>

  <div class="dashboard-container ">
    <?php showProducts($conn); ?>
  
    <?php showOrders($conn); ?>

    <?php showOrdersItems($conn); ?>
  
    <?php showUsers($conn); ?>
  
    <?php showViews($conn); ?>
  </div>

  <footer>
    <p style="text-align: center;">© <?= date('Y') ?> Admin Panel - All rights reserved</p>
  </footer>
  <script src="dashboard.js"></script>
</body>

</html>