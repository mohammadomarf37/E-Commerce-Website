<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = intval($_POST['order_id']);
    $status = trim($_POST['status']);

    $stmt = mysqli_prepare($conn, "UPDATE orders SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $status, $order_id);
    mysqli_stmt_execute($stmt);

    header("Location: admin_dashboard.php?section=orders");
    exit;
} else {
    echo "Invalid Request!";
}
?>