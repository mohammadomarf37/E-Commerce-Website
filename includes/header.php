<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Clothify</title>

    <!-- Bootstrap 5 CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Bootstrap 5 CSS Offline -->
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/css/bootstrap.min.css">

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Loader -->
    <div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 bg-dark d-flex justify-content-center align-items-center flex-column" style="z-index: 9999;">
        <h4 class="text-white mb-3">Loading...</h4>
        <div class="progress w-75" style="height: 20px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 100%;"></div>
        </div>
    </div>





    <header>
        <nav class="py-4 navbar navbar-expand-lg navbar-dark bg-dark-bold">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">MyClothify</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="shop.php?category=men">Men</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="shop.php?category=women">Women</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="shop.php?category=kids">Kids</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">🛒 Cart</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>

                        <!-- After login you can replace with: -->
                        <!-- <li class="nav-item"><a class="nav-link" href="account.php">My Account</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>

    </header>