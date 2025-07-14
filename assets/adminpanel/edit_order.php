<?php
include '../../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET full_name = '$full_name' WHERE id = $id");
    mysqli_query($conn, "UPDATE orders SET email = '$email' WHERE id = $id");
    mysqli_query($conn, "UPDATE orders SET contact_number = '$contact_number' WHERE id = $id");
    mysqli_query($conn, "UPDATE orders SET address = '$address' WHERE id = $id");
    mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = $id");
    header("Location: admin_dashboard.php#orders_section");
}
?>
<?php
$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id=$id"));
?>

<head>
    <link rel="stylesheet" href="../../bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <title>Dashboard - Edit Order</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #111;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .style {
            background-color: #444;
            color: #fff;
            border: 1px solid #444;
        }
        .style:focus {
            background-color: #444;
            color: white;
        }
    </style>
</head>
<div class="container mt-5">
    <h3>Edit Order #<?= $order['id'] ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $order['id'] ?>">
        <div class="mb-3">
            <label>Full Name:</label>
            <input type="text" name="full_name" class="form-control style" value="<?= $order['full_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control style" value="<?= $order['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Contact Number:</label>
            <input type="text" name="contact_number" class="form-control style" value="<?= $order['contact_number'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Address:</label>
            <textarea name="address" class="form-control style" rows="4" required style="resize: none;"><?= $order['address'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control style" required>
                <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Processing" <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                <option value="Shipped" <?= $order['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
    <a href="admin_dashboard.php#orders_section">Back</a>
</div>