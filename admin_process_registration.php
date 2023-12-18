<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $bio = $_POST["bio"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $ytc = $_POST["ytc"];
    $fbp = $_POST["fbp"];
    $is_admin = $_POST["is_admin"];

    $sql = "INSERT INTO users (name, gender, bio, password, ytc, fbp, is_approved, is_admin)
            VALUES ('$name', '$gender', '$bio', '$password', '$ytc', '$fbp', 0, '$is_admin')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>