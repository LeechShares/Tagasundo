<?php
session_start();

include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page
    exit;
}

// Check if the user ID is provided in the URL
if (!isset($_GET["user_id"])) {
    header("Location: addinfo.php"); // Redirect to addinfo page
    exit;
}

$userID = $_GET["user_id"];

// Retrieve user's information
$sql = "SELECT * FROM users WHERE id = $userID";
$result = $conn->query($sql);

if ($result === false || $result->num_rows !== 1) {
    die("Error retrieving user information.");
}

$row = $result->fetch_assoc();

// Process user info update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newRapName = $_POST["new_rap_name"];

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        $updateSql = "UPDATE users SET rap_name = '$newRapName', profile_image = '$targetFile' WHERE id = $userID";
        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "User profile updated successfully!";
        } else {
            $errorMessage = "Error updating user profile: " . $conn->error;
        }
    } else {
        $errorMessage = "Error uploading profile image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin: Update User Profile</title>
</head>
<body>
    <h2>Update User Profile</h2>
    <h3>User: <?php echo $row['name']; ?></h3>
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    if (isset($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    }
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="new_rap_name">New Rap Name:</label>
        <input type="text" id="new_rap_name" name="new_rap_name" value="<?php echo $row['rap_name']; ?>" required><br><br>

        <label for="profile_image">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image"><br><br>

        <input type="submit" value="Update User Profile">
    </form>
    <br>
    <a href="addinfo.php">Back to User List</a>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
    <br>
    <a href="admin_logout.php">Logout</a>

    <!-- Display user's profile image -->
    <?php if (!empty($row['profile_image'])) : ?>
        <h3>User's Profile Image:</h3>
        <img src="<?php echo $row['profile_image']; ?>" alt="User's Profile Image">
    <?php endif; ?>
</body>
</html>
