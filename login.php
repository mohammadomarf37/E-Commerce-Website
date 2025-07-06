<?php
session_start();
// include 'includes/header.php';

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        
            $_SESSION['user'] = $user;
            header('Location: index.php'); // Redirect after login
            exit();
        
    } else {
        echo "❌ No user found.";
    }
}
?>


<form method="POST" action="login.php">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
    <p>You're not registered? <a href="register.php">Register</a></p>
</form>
