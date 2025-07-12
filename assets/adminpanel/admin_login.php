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
    <title>Admin Login</title>
    <style>
        body {
            background: #111;
            color: white;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #222;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<form method="POST">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <input type="text" name="username" placeholder="Username" required autocomplete="off">
    <input type="password" name="password" placeholder="Password" required autocomplete="off">
    <button type="submit">Login</button>
</form>
</body>
</html>
