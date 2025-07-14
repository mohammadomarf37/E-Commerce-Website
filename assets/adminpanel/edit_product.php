<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    $product = mysqli_fetch_assoc($res);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../../assets/images/$image");
        $query = "UPDATE products SET name=?, price=?, description=?, image=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sdssi", $name, $price, $description, $image, $id);
    } else {
        $query = "UPDATE products SET name=?, price=?, description=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sdsi", $name, $price, $description, $id);
    }

    mysqli_stmt_execute($stmt);
    header("Location: admin_dashboard.php");
    exit;
}
?>
<head>
    <link rel="stylesheet" href="../../bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <title>Dashboard - Edit Product</title>
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
  <h3>Edit Product</h3>
  <form method="POST"  enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <div class="mb-3">
      <label>Product Name:</label>
      <input type="text" name="name" class="form-control style" value="<?= $product['name'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Description:</label>
      <textarea name="description" class="form-control style" rows="8" style="resize: none;" required><?= $product['description'] ?></textarea>
    </div>
    <div class="mb-3">
      <label>Price ($):</label>
      <input type="number" step="0.01" name="price" class="form-control style" value="<?= $product['price'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Change Image (optional):</label>
      <input type="file" name="image" class="form-control style" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
  </form>
  <a href="admin_dashboard.php#products_section">Back</a>
</div>

