<?php
session_start();

include "config.php";

// Check if the user is logged in
if (!isset($_SESSION["user_logged_in"]) || $_SESSION["user_logged_in"] !== true) {
    header("Location: user_login.php");
    exit;
}

$userID = $_SESSION["user_id"];

// Retrieve user's information
$sql = "SELECT * FROM users WHERE id = $userID";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing SQL query: " . $conn->error);
}

$row = $result->fetch_assoc();

// Process profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $newBio = $_POST["new_bio"];
    $newRapName = $_POST["new_rap_name"];
    $newYTC = $_POST["new_ytc"];
    $newFBP = $_POST["new_fbp"];

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        $updateSql = "UPDATE users SET bio = '$newBio', rap_name = '$newRapName', ytc = '$newYTC', fbp = '$newFBP', profile_image = '$targetFile' WHERE id = $userID";
        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "Profile updated successfully!";
            $_SESSION["user_rap_name"] = $newRapName;
            $_SESSION["user_bio"] = $newBio;
            $_SESSION["user_ytc"] = $newYTC;
            $_SESSION["user_fbp"] = $newFBP;
            $_SESSION["user_profile_image"] = $targetFile;
        } else {
            $errorMessage = "Error updating profile: " . $conn->error;
        }
    } else {
        $errorMessage = "Error uploading profile image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Your Profile</h2>
        <?php
        if (isset($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        if (isset($successMessage)) {
            echo "<p style='color: green;'>$successMessage</p>";
        }
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="new_bio">New Bio:</label>
            <textarea id="new_bio" name="new_bio"><?php echo $row['bio']; ?></textarea>

            <label for="new_rap_name">New Rap Name:</label>
            <input type="text" id="new_rap_name" name="new_rap_name" value="<?php echo $row['rap_name']; ?>" required>

            <label for="new_ytc">New YouTube Channel:</label>
            <input type="text" id="new_ytc" name="new_ytc" value="<?php echo $row['ytc']; ?>">

            <label for="new_fbp">New Facebook Profile:</label>
            <input type="text" id="new_fbp" name="new_fbp" value="<?php echo $row['fbp']; ?>">

            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image">

            <input type="submit" value="Update Profile">
        </form>
        <br>
        <a href="membersarea.php">Back to Members Area</a>
        <br>
        <a href="user_logout.php">Logout</a>

        <!-- Display profile image -->
        <?php if (!empty($row['profile_image'])) : ?>
            <h3>Your Profile Image:</h3>
            <img src="<?php echo $row['profile_image']; ?>" alt="Profile Image">
        <?php endif; ?>
    </div>
</body>
</html>