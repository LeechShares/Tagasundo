<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page based on the user type
if (isset($_GET['admin']) && $_GET['admin'] === 'true') {
    header("Location: admin_login.php?error=Saksipuly logout");
} else {
    header("Location: login1.php?error=Logout successfully");
}
exit;
?>