<?php
session_start();
include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php?error=Login ka muna para malaman kung admin ka");
    exit;
}

// Retrieve user account recovery details
$sql = "SELECT user_name, rap_name, token FROM password_reset_requests";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Account Recovery</title>
</head>
<body>
    <h2>User Account Recovery Details</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Rap Name</th>
            <th>Token</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['rap_name'] . "</td>";
            echo "<td>" . $row['token'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
    <br>
    <a href="user_logout.php">Logout</a>
</body>
</html>