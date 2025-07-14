<?php
include '../../config.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM order_items WHERE id = $id");
    header("Location: admin_dashboard.php#order_items");
}
?>
