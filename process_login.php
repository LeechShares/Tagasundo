<?php
session_start();

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, is_approved, is_admin FROM users WHERE name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"]) && $row["is_admin"] == 0 && $row["is_approved"] == 1) {
            $_SESSION["user_logged_in"] = true;
            header("Location: membersarea.php");
            exit;
        } else {
            echo "Login failed. Please check your credentials or account status.";
        }
    } else {
        echo "Login failed. Please check your credentials.";
    }
}
?>