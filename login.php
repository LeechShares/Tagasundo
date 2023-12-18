<?php
session_start(); // Start the session
include "config.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, is_approved, is_admin FROM users WHERE name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            // Password matches, set session variables
            $_SESSION["user_id"] = $row["id"]; // Set the user's ID in the session
            $_SESSION["user_logged_in"] = true; // Set the user as logged in

            if ($row["is_admin"] == 1) {
                // Redirect admin to admin panel
                header("Location: admin_panel.php");
                exit;
            } elseif ($row["is_approved"] == 1) {
                // Redirect approved user to members area
                header("Location: membersarea.php");
                exit;
            } else {
                // Redirect user to not approved page
               header("Location: login1.php?error=Account Not Yet Approved.");
                exit;
            }
        } else {
            // Invalid password
            header("Location: login1.php?error=Invalid username or password.");
            exit;
        }
    } else {
        // User not found
        header("Location: login1.php?error=Invalid username or password.");
        exit;
    }
}

$conn->close();
?>