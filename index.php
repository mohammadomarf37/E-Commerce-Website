<?php
session_start();
include 'includes/header.php';
include 'config.php';
$page = 'home'; // Change this on each page accordingly
mysqli_query($conn, "UPDATE page_views SET view_count = view_count + 1 WHERE page_name = '$page'");

?>

<head>
    <title>MyClothify - Home</title>
</head>

<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <h1 class="display-4 fw-bold animate__animated animate__bounceInDown">Shop the Latest Trends</h1>
        <p class="lead animate__animated animate__bounceInLeft">High-quality products at unbeatable prices.</p>
        <a href="#products" class=" "><button class="mt-5 button-48 animate__animated animate__bounceInLeft" role="button"><span class="text">Shop Now</span></button></a>
    </div>
</section>


<!-- Featured Products -->
<section id="products" class="py-5 ">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Featured Products</h2>

        <div class="custom-grid">
            <!-- Card 1 -->
            <div class="product-card card-bg-1 ">
                <div class="product-info">
                    <h5>Premium Hoodie</h5>
                    <p>$39.99</p>
                    <!-- <a href="#" class="btn btn-dark-bold">Add to Cart</a> -->
                    <a href="product.php?id=1"><button class="button-48" role="button"><span class="text">View Details</span></button></a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="product-card card-bg-2 ">
                <div class="product-info">
                    <h5>Casual Jacket</h5>
                    <p>$49.99</p>
                    <a href="product.php?id=2"><button class="button-48" role="button"><span class="text">View Details</span></button></a>

                </div>
            </div>

            <!-- Card 3 -->
            <div class="product-card card-bg-3">
                <div class="product-info">
                    <h5>Stylish Sneakers</h5>
                    <p>$59.99</p>
                    <a href="product.php?id=3"><button class="button-48" role="button"><span class="text">View Details</span></button></a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Carousel -->
<div class="custom-carousel" id="carouselTrack">
    <!-- <div class="carousel-track"> -->
        <div class="carousel-slide"><img src="assets/images/banner3.png" alt="Slide 1"></div>
        <div class="carousel-slide"><img src="assets/images/banner3.png" alt="Slide 2"></div>
        <div class="carousel-slide"><img src="assets/images/banner3.png" alt="Slide 3"></div>
    <!-- </div> -->
</div>

    <!-- <button class="carousel-btn prev">&#10094;</button>
  <button class="carousel-btn next">&#10095;</button> -->

    <!-- <div class="carousel-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div> -->



<!-- shop.php -->
<?php include 'allproducts.php'; ?>


<?php include 'includes/footer.php'; ?>