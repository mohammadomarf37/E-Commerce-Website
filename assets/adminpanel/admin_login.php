<?php
session_start();

$admin_username = "admin";
$admin_password = "secure123"; // Strong hardcoded password

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #121212;
            color: #ffffff;
        }

        h1,
        h2,
        h3 {
            font-family: "Oswald", sans-serif;
            font-weight: 700;
        }

        * {
            box-sizing: border-box;
        }

        .login-container {
            max-width: 400px;
            margin: 160px auto;
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
</head>
<div class="login-container">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" autocomplete="off" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>

</html>