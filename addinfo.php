<?php
session_start();

include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page
    exit;
}

// Retrieve approved users' names
$sql = "SELECT id, name FROM users WHERE is_approved = 1";
$result = $conn->query($sql);

if ($result === false) {
    die("Error retrieving user information.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin: Update User Info</title>
</head>
<body>
    <h2>Update User Info</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <li><a href="update_user.php?user_id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
        <?php endwhile; ?>
    </ul>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
    <br>
    <a href="admin_logout.php">Logout</a>
</body>
</html>