<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to login or homepage
header("Location: index.php");
exit;
?>
