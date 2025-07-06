
<!-- allproducts.php -->
<?php
include 'config.php';

// Fetch filtered or all products
$products = [];

if (isset($_GET['category'])) {
    $categories = $_GET['category'];

    // Ensure it's an array
    if (!is_array($categories)) {
        $categories = [$categories];
    }

    // Escape values and build WHERE clause
    $escapedCategories = array_map(function ($cat) use ($conn) {
        return mysqli_real_escape_string($conn, $cat);
    }, $categories);

    $categoryFilter = "'" . implode("','", $escapedCategories) . "'";
    $sql = "SELECT * FROM products WHERE category IN ($categoryFilter)";
} else {
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($conn, $sql);
?>

<!-- HTML START -->
    <h2 class=" mb-4 fw-bold text-center" id="all-products">All Products</h2>

    <h3 class="" id="filter-btn" onclick="toggleFilters()">Filters <i class="fa-duotone fas fa-regular fa-filter"></i></h3>
        <script>
  function toggleFilters() {
    const filterBar = document.getElementById('filter-bar');
    filterBar.classList.toggle('active');
  }

  
</script>
<div class="container-fluid ">
    <div class="row">
        <!-- Filter Sidebar -->
        <div id="filter-bar"  class="filter-bar col-md-3 p-3 bg-dark text-white animate__animated animate__fadeInLeft">
            <h5>Filter Products</h5>
            <?php
            $selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];
            ?>
            <form method="GET" action="index.php#all-products">
                <div>
                    <input type="checkbox" name="category[]" value="hoodie"
                        <?= in_array('hoodie', $selectedCategories) ? 'checked' : '' ?>>
                    Hoodie
                </div>
                <div>
                    <input type="checkbox" name="category[]" value="jacket"
                        <?= in_array('jacket', $selectedCategories) ? 'checked' : '' ?>>
                    Jacket
                </div>
                <div>
                    <input type="checkbox" name="category[]" value="shirt"
                        <?= in_array('shirt', $selectedCategories) ? 'checked' : '' ?>>
                    Shirt
                </div>

                <button type="submit" class="btn btn-primary btn-sm mt-2">Apply Filter</button>
                <a href="index.php#all-products" class="btn btn-outline-light btn-sm mt-2">Clear Filters</a>
            </form>
        </div>

         <!-- Filter button for mobile -->
     


        <!-- Product Cards -->
        <div class="col-md-9 p-4 ">
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4 mb-4">
                        <div style="background: url(assets/images/<?= $row['image']?>); background-repeat: no-repeat; background-size: cover; background-position: center;" class="product-card">
                            <!-- <img src="assets/images/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>"> -->
                            <div class="product-info">
                                <h5><?= $row['name'] ?></h5>
                                <p $<?= $row['price'] ?></p>
                                    <a href="product.php?id=<?= $row['id'] ?>"><button class="button-48" role="button"><span class="text">View Details</span></button></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>



