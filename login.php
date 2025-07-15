<?php
session_start();
ob_start();
include 'config.php';
$page = 'login'; // Change this on each page accordingly
mysqli_query($conn, "UPDATE page_views SET view_count = view_count + 1 WHERE page_name = '$page'");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    // $loginquery = mysqli_num_rows(mysqli_query($conn,$query));



    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "❌ Invalid email format. Please enter a valid email address.";
    } elseif (!str_ends_with($email, '@gmail.com')) {
        $error = "❌ Only Gmail addresses are allowed.";
    } else {
        // Login check
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if ($user = mysqli_fetch_assoc($result)) {
            if ($user['status'] === 'active') {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];
                header("Location: index.php");
                exit();
            } else {
                $error = "❌ Your account is currently Banned! Please contact support.";
            }
        } else {
            $error = "❌ No user found.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<head>
    <title>MyClothify - Login</title>
</head>
<style>
    .login-container {
        max-width: 400px;
        margin: 80px auto;
        background-color: #1c1c1c;
        padding: 40px;
        border-radius: 10px;
        color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        font-family: Arial, sans-serif;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .login-container input {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        outline: none;
        background: #333;
        color: #fff;
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        font-weight: bold;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .login-container button:hover {
        background-color: #218838;
    }

    .login-container p {
        text-align: center;
        margin-top: 15px;
    }

    .login-container a {
        color: #00d9ff;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ff4d4d;
        margin-bottom: 15px;
        text-align: center;
    }
</style>

<div class="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit">Login</button>
        <p>You're not registered? <a href="register.php?v=1">Register</a></p>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>