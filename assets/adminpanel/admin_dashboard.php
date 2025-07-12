<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php");
  exit;
}
?>

<?php
include '../../config.php';



// Fetch summary counts
$total_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
$total_items = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM order_items"));
$views = mysqli_query($conn, "SELECT * FROM page_views");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      background-color: #1e1e1e;
      border: none;
    }

    .card-title {
      font-size: 1.2rem;
    }

    table {
      background-color: #1f1f1f;
      color: white;
    }

    .table thead {
      background-color: #333;
    }

    .form-control,
    .btn {
      border-radius: 0;
    }

    .search-bar {
      width: 250px;
    }
  </style>
</head>

<body>
  <div class="container py-5">
    <h2 class="mb-4">📊 Admin Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4" style="color: white;">
      <div class="col-md-2">
        <div style="color: white;" class="card text-center p-3">
          <h5 class="card-title">Products</h5>
          <p><?= $total_products ?></p>
        </div>
      </div>
      <div class="col-md-2">
        <div style="color: white;" class="card text-center p-3">
          <h5 class="card-title">Users</h5>
          <p><?= $total_users ?></p>
        </div>
      </div>
      <div class="col-md-2">
        <div style="color: white;" class="card text-center p-3">
          <h5 class="card-title">Orders</h5>
          <p><?= $total_orders ?></p>
        </div>
      </div>
      <div class="col-md-2">
        <div style="color: white;" class="card text-center p-3">
          <h5 class="card-title">Order Items</h5>
          <p><?= $total_items ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center p-3" style="color: white;">
          <h5 class="card-title">Views</h5>
          <ul class="list-unstyled mb-0">
            <?php while ($v = mysqli_fetch_assoc($views)): ?>
              <li><?= ucfirst($v['page_name']) ?>: <?= $v['view_count'] ?></li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Products Table -->
    <div class="mt-5">
      <h4>🛒 Products <a href="add_product.php" class="btn btn-sm btn-success float-end">Add Product</a></h4>
      <input type="text" class="form-control search-bar mb-2" placeholder="Search..." onkeyup="searchTable(this, 'productsTable')">
      <table class="table table-bordered table-hover" id="productsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM products");
          while ($row = mysqli_fetch_assoc($res)):
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td>$<?= number_format($row['price'], 2) ?></td>
              <td>
                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Users Table -->
    <div class="mt-5">
      <h4>👤 Users</h4>
      <input type="text" class="form-control search-bar mb-2" placeholder="Search..." onkeyup="searchTable(this, 'usersTable')">
      <table class="table table-bordered" id="usersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM users");
          while ($row = mysqli_fetch_assoc($res)):
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Orders Table -->
    <div class="mt-5">
      <h4>📦 Orders</h4>
      <input type="text" class="form-control search-bar mb-2" placeholder="Search..." onkeyup="searchTable(this, 'ordersTable')">
      <table class="table table-bordered" id="ordersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
          while ($row = mysqli_fetch_assoc($res)):
            $display_total = $row['total_amount'] == 0 ? "From Cart" : "$" . number_format($row['total_amount'], 2);
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['full_name'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['quantity'] == 0 ? '-' : $row['quantity'] ?></td>
              <td><?= $display_total ?></td>
              <td>
                <form method="POST" action="update_status.php" class="d-flex align-items-center">
                  <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                  <select name="status" class="form-select form-select-sm me-2">
                    <option value="pending" <?= $row['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="processing" <?= $row['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                    <option value="shipped" <?= $row['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="delivered" <?= $row['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-success">Save</button>
                </form>
              </td>

            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Order Items -->
  <?php
  $orderItems = mysqli_query($conn, "SELECT oi.*, p.name AS product_name, o.full_name FROM order_items oi
  JOIN products p ON oi.product_id = p.id
  JOIN orders o ON oi.order_id = o.id
  ORDER BY oi.order_id DESC
  ");
  ?>
  <div class="mt-5">
  <h3 class="mb-3">Order Items</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-white">
      <thead class="table-dark">
        <tr>
          <th>Order ID</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
          <th>Ordered By</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($item = mysqli_fetch_assoc($orderItems)): ?>
          <tr>
            <td><?= $item['order_id'] ?></td>
            <td><?= $item['product_name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td>$<?= number_format($item['total_price'], 2) ?></td>
            <td><?= htmlspecialchars($item['full_name']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

  </div>

  

  <script>
    function searchTable(input, tableId) {
      const filter = input.value.toLowerCase();
      const rows = document.querySelectorAll(`#${tableId} tbody tr`);
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    }
  </script>
</body>

</html>