<?php
session_start();
include 'config.php';
include 'includes/header.php';
$page = 'cart'; // Change this on each page accordingly
mysqli_query($conn, "UPDATE page_views SET view_count = view_count + 1 WHERE page_name = '$page'");




if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];  // assuming you're storing user details as array
$sql = "SELECT cart.id AS cart_id, cart.product_id, products.name, products.price, products.image, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<head>
    <title>MyClothify - Cart</title>
</head>
<div class="container py-5">
    <h2 class="text-center mb-4">Your Cart</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-white">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    while ($row = mysqli_fetch_assoc($result)):
                        $total = $row['price'] * $row['quantity'];
                        $grandTotal += $total;
                    ?>
                        <tr>
                            <td><img src="assets/images/<?= $row['image'] ?>" width="60" height="60" class="rounded"></td>
                            <td><?= $row['name'] ?></td>
                            <td>$<?= number_format($row['price'], 2) ?></td>
                            <td>
                                <form method="POST" action="update_cart.php" class="d-flex">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                                    <input type="number" name="quantity" value="<?= $row['quantity'] ?>" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>$<?= number_format($total, 2) ?></td>
                            <td>
                                <form method="POST" action="delete_cart.php">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    <a href="product.php?id=<?= $row['product_id'] ?>" class="btn btn-info btn-sm">View Product</a>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr class="table-dark">
                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                        <td colspan="2">
                            <strong>$<?= number_format($grandTotal, 2) ?></strong>
                            <button id="checkoutBtn" class="btn btn-success btn-sm ms-2">Checkout</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-warning">Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php
// Fetch user info for modal
$email = $_SESSION['user']['email'];
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
$user_info = mysqli_fetch_assoc($user_query);
?>
<!-- Checkout Modal -->
<!-- <div id="checkoutModal" class="modal">
    <div class="modal-content" style="background-color:#121212; padding: 30px; border-radius: 12px; max-width: 500px; margin: auto; box-shadow: 0 0 15px rgba(0,0,0,0.5);">
        <span class="close" style="float:right; font-size:20px; color:white; cursor:pointer;">&times;</span>
        <h4 class="mb-3 text-white">Checkout</h4>
        <form method="POST" action="checkout_order.php" id="checkoutForm">
            <input type="text" name="full_name" class="form-control mb-3" value="<?= htmlspecialchars($user_info['name']) ?>" readonly>
            <input type="email" name="email" class="form-control mb-3" value="<?= htmlspecialchars($user_info['email']) ?>" readonly>
            <input type="text" name="contact" class="form-control mb-3" value="<?= htmlspecialchars($user_info['contact']) ?>" readonly>
            <textarea name="address" class="form-control mb-3" placeholder="Enter Delivery Address" required></textarea>
            <button type="submit" class="btn btn-success w-100">Place Order</button>
        </form>
    </div>
</div> -->



<div id="checkoutModal" class="modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.7);">
    <div class="modal-content" style="background-color: #1e1e1e; margin: 2.6% auto; padding: 30px; border-radius: 12px; border: 2px solid #00ff62; width: 90%; max-width: 500px; color: white; position: relative; box-shadow: 0 0 20px #00ff62;">
        <span class="close" style="color: white; position: absolute; top: 10px; right: 15px; font-size: 28px; cursor: pointer;">&times;</span>
        <h4 class="text-center mb-4" style="color: #00ff62;">Place Your Order</h4>
        <form method="POST" action="checkout_order.php" id="checkoutForm">
            <div style="margin-bottom: 15px;">
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($user_info['name']) ?>" required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user_info['email']) ?>" readonly class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Contact Number:</label>
                <input pattern="\d{11}" minlength="11" maxlength="11" title="Contact number must be exactly 11 digits" type="text" name="contact" value="<?= htmlspecialchars($user_info['contact']) ?>" required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Address:</label>
                <textarea name="address" placeholder="Enter Your House No#, Area, City." required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444; resize: none;"><?= htmlspecialchars($user_info['address']) ?></textarea>
                <style>
                    #checkoutModal textarea::placeholder {
                        color: #999;
                    }
                </style>
            </div>
            <!-- <div style="margin-bottom: 15px;">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" required class="form-control" style="background-color: #2c2c2c; color: white; border: 1px solid #444;">
                </div> -->
            <div id="loadingMsg" style="display: none; color: #00ff62; text-align:center; margin-top:10px;">
                ⏳ Placing your order...
            </div>

            <div class="text-center">
                <button id="checkoutbtn2" type="submit" class="sp-btn" style="margin-top: 10px;"><span>Checkout</span></button>
            </div>
        </form>
    </div>
</div>



<link rel="stylesheet" href="assets/css/modal.css">


<?php include 'includes/footer.php'; ?>
<script src="assets/js/modal.js?v=1"></script>