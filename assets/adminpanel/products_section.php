<?php
function showProducts($conn) {
  $res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
  echo '<section id="products_section"><h2>📦 Products</h2>';
  echo '<input type="text" onkeyup="searchTable(this, \'productsTable\')" placeholder="Search Products..." style="width: 87.3%;height: 19px;padding-top: 10px;background: #333;color: white;margin-right: 10px;" class="search">';
  echo '<a href="add_product.php"  class="btn">+ Add Product</a>';
  echo '<table id="productsTable"><thead><tr>
          <th style="text-align: center">ID</th><th style="text-align: center">Name</th><th style="text-align: center">Description</th><th style="text-align: center">Price</th><th style="text-align: center">Image</th><th style="text-align: center">Date</th><th style="text-align: center">Actions</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>\${$row['price']}</td>
            <td><img src='../../assets/images/{$row['image']}' width='60'></td>
            <td>{$row['created_at']}</td>
            <td>
              <a href='edit_product.php?id={$row['id']}' class='btn btn-sm btn-success'style='text-align: center'>Edit</a> |
              <a href='delete_product.php?id={$row['id']}' class='btn btn-sm btn-danger' style='text-align: center' onclick='return confirm(\"Delete?\")'>Delete</a>
            </td>
          </tr>";
  }
  echo '</tbody></table></section>';
}
?>
