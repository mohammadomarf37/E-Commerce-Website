<?php
function showViews($conn) {
  $res = mysqli_query($conn, "SELECT * FROM page_views");
  $total_views = 0;

  echo '<section><h2>📈 Page Views</h2>';
  echo '<table>
          <thead>
            <tr><th style="text-align: center">Page</th><th style="text-align: center">Views</th></tr>
          </thead>
          <tbody>';

  while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <td>{$row['page_name']}</td>
            <td >{$row['view_count']}</td>
          </tr>";
    $total_views += $row['view_count'];
  }

  // Print total after loop
  echo "<tr>
          <th style='text-align:center'>Total Views:</th>
          <th style='text-align:center'>$total_views</th>
        </tr>";

  echo '</tbody></table></section>';
}
?>
