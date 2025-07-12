<?php
ob_start();
// session_start();
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $contact  = $_POST['contact'];
    $address  = $_POST['address'];

    $query = "INSERT INTO users (name, email, password, contact, address) 
              VALUES ('$name', '$email', '$password', '$contact', '$address')";

    if (mysqli_query($conn, $query)) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Registration failed.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<style>
.register-form {
    max-width: 400px;
    margin: 100px auto;
    padding: 25px;
    /* background: #222; */
    background-color: #1c1c1c;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
    font-family: Arial, sans-serif;
    border-radius: 10px;
    color: white;
}
.register-form h2 {
    text-align: center;
    margin-bottom: 25px;
}
.register-form input {
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 20px;
    border: none;
    border-radius: 5px;
    outline: none;
    background: #333;
    color: #fff;
}

.register-form button {
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
.register-form button:hover {
    background-color: #218838;
}
.register-form p {
    text-align: center;
    margin-top: 15px;
}
.register-form a {
    color: #00d9ff;
    text-decoration: none;
}
.register-form a:hover {
    text-decoration: underline;
}
.error-message {
    color: #ff4d4d;
    margin-bottom: 15px;
    text-align: center;
}
</style>

<form method="POST" class="register-form">
    <h2 class="text-center">Register</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>

    <div style="position: relative;">
        <input type="password" id="password" name="password" placeholder="Password" required>
    </div>

    <input type="text" name="contact" placeholder="Contact Number" required>
    <input type="text" name="address" placeholder="Address" required>

    <button type="submit">Register</button>
    <p>Already registered? <a href="login.php">Login</a></p>
</form>



<?php include 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>
