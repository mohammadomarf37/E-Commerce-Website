<?php
include 'config.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        include 'includes/footer.php';
        exit;
    }
} else {
    echo "Invalid product.";
    include 'includes/footer.php';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        

        main {
            min-height: 75.7vh;
            /* Full screen height */
            display: flex;
            flex-direction: column;
        }

        main>.content {
            flex: 0;
            /* Pushes footer to bottom */
        }

        /* .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        } */
    </style>
</head>

<body style="background-color: #121212; color: white; font-family: 'Segoe UI', sans-serif;">
    <main>
        <div class="content">
            <!-- product section start -->
            <section class="py-5">
                <div class="container">
                    <div class="row align-items-center g-5">
                        <!-- Product image -->
                        <div class="col-md-6 text-center">
                            <img src="assets/images/<?php echo $product['image']; ?>" class="img-fluid rounded shadow-lg animate__animated animate__fadeInLeft" alt="<?php echo $product['name']; ?>" style="max-width: 100%; height: 400px; object-fit: cover;">
                        </div>

                        <!-- Product info -->
                        <div class="col-md-6 animate__animated animate__fadeInRight">
                            <h1 class="display-5 fw-bold mb-3"><?php echo $product['name']; ?></h1>
                            <h3 class="text-primary mb-3">$<?php echo $product['price']; ?></h3>
                            <p style="font-size: 1.1rem; line-height: 1.7;"><?php echo $product['description']; ?></p>

                            <div class="mt-4">
                                <a href="#" class="btn btn-primary btn-lg me-3">Buy Now</a>
                                <a href="#" class="btn btn-outline-light btn-lg">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product section end -->
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>

</html>