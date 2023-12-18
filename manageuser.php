<?php
session_start();

include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Process user removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove"])) {
    $userId = $_POST["remove"];
    $sql = "DELETE FROM users WHERE id = $userId";
    $conn->query($sql);
}

// Retrieve all users
$sql = "SELECT id, name FROM users WHERE is_approved = 1"; // Exclude admins
$result = $conn->query($sql);
?>
<?php
  include "_ulo.php";
    ?>
    <h2>Manage Users</h2>
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin'>";
            echo "<p>User: " . $row["name"] . "</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='remove' value='" . $row["id"] . "'>";
            echo "<input type='submit' value='Remove'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No users found.";
    }
    ?>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
    <br>
    <a href="admin_logout.php">Logout</a>
<?php
  include "_tiil.php";
    ?>