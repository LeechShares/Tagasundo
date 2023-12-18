<?php
include "config.php";
// D2 MAG REREGISTER ANG MGA ADMIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rap_name = $_POST["rap_name"];
    $gender = $_POST["gender"];
    $bio = $_POST["bio"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $ytc = $_POST["ytc"];
    $fbp = $_POST["fbp"];
    $is_approved= $_POST["is_approved"];
    $is_admin = $_POST["is_admin"];
    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO users (name, rap_name, gender, bio, password, ytc, fbp, is_approved, is_admin, profile_image) VALUES ('$name', '$rap_name', '$gender', '$bio', '$password', '$ytc', '$fbp', '$is_approved', '$is_admin', '$targetFile')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_login.php?success=Registration successful. You can now log in.");
            exit;
        } else {
            header("Location: 01010010 01101001 01111010 01111010 01010010 01100001 01101011 01101011.php?error=Registration failed: " . $conn->error);
            //Edit na mahirap hanapin
            exit;
        }
    } else {
        header("Location: 01010010 01101001 01111010 01111010 01010010 01100001 01101011 01101011.php?error=Error uploading profile image.");
        exit;
    }

    $conn->close();
}
?>