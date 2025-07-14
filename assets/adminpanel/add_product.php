<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp, "../../assets/images/$image");

    $stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sdss", $name, $price, $description, $image);
    mysqli_stmt_execute($stmt);

    header("Location: admin_dashboard.php");
    exit;
}
?>
<head>
    <link rel="stylesheet" href="../../bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <title>Dashboard - Add Product</title>
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
  <h3>Add New Product</h3>
  <form method="POST"  enctype="multipart/form-data">
    <div class="mb-3">
      <label>Product Name:</label>
      <input type="text" name="name" class="form-control style" required>
    </div>
    <div class="mb-3">
      <label>Description:</label>
      <textarea name="description" class="form-control style" rows="8" style="resize: none;" required></textarea>
    </div>
    <div class="mb-3">
      <label>Price ($):</label>
      <input type="number" step="0.01" name="price" class="form-control style" required>
    </div>
    <div class="mb-3">
      <label>Image:</label>
      <input type="file" name="image" class="form-control style" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Add Product</button>
  </form>
  <a href="admin_dashboard.php#products_section">Back</a>
</div>

