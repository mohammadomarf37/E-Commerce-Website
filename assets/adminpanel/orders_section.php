<?php
function showOrders($conn) {
  $res = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
  echo '<section id="orders_section"><h2>🛒 Orders</h2>';
  echo '<input type="text" onkeyup="searchTable(this, \'ordersTable\')" placeholder="Search Products..." style="width: 98.7%;height: 19px;padding-top: 10px;background: #333;color: white;" class="search">';
  echo '<table id="ordersTable"><thead><tr>
          <th style="text-align: center">ID</th><th style="text-align: center">Product ID</th><th style="text-align: center">User ID</th><th style="text-align: center">User Name</th><th style="text-align: center">User Email</th><th style="text-align: center">User Contact</th><th style="text-align: center">User Address</th><th style="text-align: center">Quantity</th><th style="text-align: center">Total</th><th style="text-align: center">Status</th><th style="text-align: center">Date</th><th style="text-align: center">Actions</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_assoc($res)) {
    $status = $row['status'] ?? 'Pending';
    $total = $row['total_amount'] == 0 ? "From Cart" : "\${$row['total_amount']}";
    $product_id = $row['product_id'] == 0 ? "From Cart" : "{$row['product_id']}";
    $quantity = $row['quantity'] == 0 ? "From Cart" : "{$row['quantity']}";
    echo "<tr>
            <td>{$row['id']}</td>
            <td>$product_id</td>
            <td>{$row['user_id']}</td>
            <td>{$row['full_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['contact_number']}</td>
            <td>{$row['address']}</td>
            <td>$quantity</td>
            <td>$total</td>
            <td>$status</td>
            <td>{$row['created_at']}</td>
            <td style='text-align: center'>
              <a href='edit_order.php?id={$row['id']}' class='btn btn-sm btn-success'>Edit</a> |
              <a href='delete_order.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete?\")'>Delete</a>
            </td>
          </tr>";
  }
  echo '</tbody></table></section>';
}
?>
