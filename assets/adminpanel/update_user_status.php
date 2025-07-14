<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $user_id = intval($_GET['id']);
  $res = mysqli_query($conn, "SELECT status FROM users WHERE id = $user_id");
  $row = mysqli_fetch_assoc($res);

  if ($row) {
    $new_status = ($row['status'] === 'active') ? 'deactive' : 'active';
    mysqli_query($conn, "UPDATE users SET status = '$new_status' WHERE id = $user_id");
  }
}

header("Location: admin_dashboard.php#users_section");
exit;
?>
