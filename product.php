<?php
session_start();


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

    @media (max-width: 575px) {
        .conp {
            --bs-gutter-x: 1rem;
        }
    }

    #buyNowModal textarea::placeholder {
        color: #999;
    }

    /* .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        } */
</style>


<!-- Product Section -->
<body style="background-color: #121212; color: white; font-family: 'Segoe UI', sans-serif;">
    <main>
        <div class="content">
            <!-- product section start -->
            <section class="py-5">
                <div class="container">
                    <div class="conp row align-items-center g-5">
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
                                <?php if (!isset($_SESSION['user'])): ?>
                                    <a href="login.php"><button class="sp-btn"><span>Login to Buy</span></button></a>
                                <?php else: ?>
                                    <button id="buyNowBtn" class="sp-btn"><span>Buy Now</span></button>
                                <?php endif; ?>
                                <a href="add_to_cart.php?id=<?= $product['id'] ?>"><button class="sp-btn atc-btn" role="button"><span class="text">Add To Cart</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <!-- Buy Now Modal -->
    <?php
    // Buy Now Modal ke part me ye code lagao
    if (isset($_SESSION['user']['email'])) {
        $email = $_SESSION['user']['email'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);  // Ab ye array me full user data hoga
    }

    ?>

    <div id="buyNowModal" class="modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.7);">
        <div class="modal-content" style="background-color: #1e1e1e; margin: 2.6% auto; padding: 30px; border-radius: 12px; border: 2px solid #00ff62; width: 90%; max-width: 500px; color: white; position: relative; box-shadow: 0 0 20px #00ff62;">
            <span class="close" style="color: white; position: absolute; top: 10px; right: 15px; font-size: 28px; cursor: pointer;">&times;</span>
            <h4 class="text-center mb-4" style="color: #00ff62;">Place Your Order</h4>
            <form id="buyNowForm">
                <div style="margin-bottom: 15px;">
                    <label>Full Name:</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['name']) ?>" readonly class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Contact Number:</label>
                    <input type="text" name="contact" value="<?= htmlspecialchars($user['contact']) ?>" readonly class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Address:</label>
                    <textarea name="address" placeholder="Enter Your House No#, Area, City." required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444; resize: none;"></textarea>

                </div>
                <div style="margin-bottom: 15px;">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
                </div>
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <div id="loadingMsg" style="display: none; color: #00ff62; text-align:center; margin-top:10px;">
                    ⏳ Placing your order...
                </div>

                <div class="text-center">
                    <button type="submit" class="sp-btn" style="margin-top: 10px;"><span>Place Order</span></button>
                </div>
            </form>
        </div>
    </div>





    <?php include 'includes/footer.php'; ?>
</body>

</html>