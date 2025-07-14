<?php
function showOrdersItems($conn) {
  $res = mysqli_query($conn, "SELECT * FROM order_items ORDER BY id DESC");
  echo '<section id="order_items"><h2>🛒 Order Items</h2>';
  echo '<input type="text" onkeyup="searchTable(this, \'order_itemsTable\')" placeholder="Search Products..." style="width: 98.7%;height: 19px;padding-top: 10px;background: #333;color: white;" class="search">';
  echo '<table id="order_itemsTable"><thead><tr>
          <th style="text-align: center">ID</th><th style="text-align: center">Order ID</th style="text-align: center"><th style="text-align: center">Product ID</th><th style="text-align: center">Quantity</th><th style="text-align: center">Price</th><th style="text-align: center">Total Price</th><th style="text-align: center">Actions</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_assoc($res)) {
    $price = "\${$row['price']}";
    $total_price = "\${$row['total_price']}";
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['quantity']}</td>
            <td>$price</td>
            <td >$total_price</td>
            <td style='text-align: center'>
              <a href='delete_order_item.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete?\")'>Delete</a>
            </td>
          </tr>";
  }
  echo '</tbody></table></section>';
}
?>
