<?php
include "config.php";

// Get and validate the embedded link and description
$embedded_link = $_POST['embedded_link'];
$description = $_POST['description'];

// Extract the video ID from the embedded link
$video_id = '';
$pattern = '/\/embed\/([a-zA-Z0-9_-]+)/';
if (preg_match($pattern, $embedded_link, $matches)) {
    $video_id = $matches[1];
}

// Insert the video ID and description into the shared_videos table
$sql = "INSERT INTO shared_videos (video_id, description) VALUES ('$video_id', '$description')";

if ($conn->query($sql) === TRUE) {
    header("Location: share_yt_embedded.php?success=Video link shared successfully!");
} else {
    header("Location: share_yt_embedded.php?error=Error: " . $conn->error);
}

$conn->close();
?>