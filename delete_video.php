<?php
session_start();
include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Check if video_id is provided in the URL
if (!isset($_GET["video_id"])) {
    header("Location: shared_videos.php"); // Redirect to shared_videos page
    exit;
}

$videoID = $_GET["video_id"];

// Delete the video from the shared_videos table
$sql = "DELETE FROM shared_videos WHERE id = $videoID";
if ($conn->query($sql) === TRUE) {
    $_SESSION["success_message"] = "Video deleted successfully!";
} else {
    $_SESSION["error_message"] = "Error deleting video: " . $conn->error;
}

header("Location: shared_videos.php"); // Redirect back to shared_videos page
exit;
?>