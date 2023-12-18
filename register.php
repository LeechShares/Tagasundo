<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rap_name = $_POST["rap_name"];
    $gender = $_POST["gender"];
    $bio = $_POST["bio"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $ytc = $_POST["ytc"];
    $fbp = $_POST["fbp"];

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        // Insert user data into the database
        $sql = "INSERT INTO users (name, rap_name, gender, bio, password, ytc, fbp, profile_image) VALUES ('$name', '$rap_name', '$gender', '$bio', '$password', '$ytc', '$fbp', '$targetFile')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login1.php?success=Registration successful. You can now log in.");
            exit;
        } else {
            header("Location: register1.php?error=Registration failed: " . $conn->error);
            exit;
        }
    } else {
        header("Location: register1.php?error=Error uploading profile image.");
        exit;
    }

    $conn->close();
}
?>