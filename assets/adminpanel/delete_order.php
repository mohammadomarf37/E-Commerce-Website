<?php
include '../../config.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM orders WHERE id = $id");
    mysqli_query($conn, "DELETE FROM order_items WHERE order_id = $id");
    header("Location: admin_dashboard.php#orders_section");
}
?>
