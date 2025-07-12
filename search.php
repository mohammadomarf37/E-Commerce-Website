<?php
include 'config.php';
include 'includes/header.php';
$q = $_GET['q'] ?? '';

$page = 'search'; // Change this on each page accordingly
mysqli_query($conn, "UPDATE page_views SET view_count = view_count + 1 WHERE page_name = '$page'");

$query = "SELECT * FROM products WHERE name LIKE '%$q%' OR description LIKE '%$q%'";
$result = mysqli_query($conn, $query);
?>



<head>
<title>MyClothify - Search</title>
</head>

<div class="container py-5">
  <h2>Search Results for: <strong><?= htmlspecialchars($q) ?></strong></h2>

  <div class="custom-grid mt-4">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="product-card card-bg-<?= $row['id'] ?>">
        <div class="product-info">
          <h5><?= $row['name'] ?></h5>
          <p>$<?= $row['price'] ?></p>
          <a href="product.php?id=<?= $row['id'] ?>"><button class="button-48"><span class="text">View Details</span></button></a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
