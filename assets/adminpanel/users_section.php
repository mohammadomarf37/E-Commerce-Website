<?php
function showUsers($conn) {
  $res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
  echo '<section id="users_section"><h2>👤 Users</h2>';
  echo '<input type="text" onkeyup="searchTable(this, \'usersTable\')" placeholder="Search Products..." style="width: 98.7%;height: 19px;padding-top: 10px;background: #333;color: white;" class="search">';
  echo '<table id="usersTable"><thead><tr>
          <th style="text-align: center">ID</th>
          <th style="text-align: center">Name</th>
          <th style="text-align: center">Email</th>
          <th style="text-align: center">Contact</th>
          <th style="text-align: center">Address</th>
          <th style="text-align: center">Status</th>
          <th style="text-align: center">Date</th>
          <th style="text-align: center">Actions</th>
        </tr></thead><tbody>';
        
  while ($row = mysqli_fetch_assoc($res)) {
    $status = ucfirst($row['status']); // Capitalize first letter
    $btnClass = ($row['status'] === 'active') ? 'btn-danger' : 'btn-success';
    $toggleText = ($row['status'] === 'active') ? 'Deactivate' : 'Activate';

    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['address']}</td>
            <td>$status</span></td>
            <td>{$row['created_at']}</td>
            <td style='text-align: center'>
              <a href='update_user_status.php?id={$row['id']}' style='text-align: center' class='btn btn-sm $btnClass'>$toggleText</a>
            </td>
          </tr>";
  }

  echo '</tbody></table></section>';
}
?>
