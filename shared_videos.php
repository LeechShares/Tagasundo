<?php
session_start();
include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php?error=Login ka muna para malaman kung admin ka");
    exit;
}

// Retrieve shared videos
$sql = "SELECT * FROM shared_videos";
$result = $conn->query($sql);

$videos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
}
?>

<?php
  include "_ulo.php";
    ?>
    <title>Shared Videos</title>
</head>
<body>
    <h2>Shared Videos</h2>

    <?php if (!empty($_SESSION["success_message"])) : ?>
        <p style="color: green;"><?php echo $_SESSION["success_message"]; ?></p>
        <?php unset($_SESSION["success_message"]); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION["error_message"])) : ?>
        <p style="color: red;"><?php echo $_SESSION["error_message"]; ?></p>
        <?php unset($_SESSION["error_message"]); ?>
    <?php endif; ?>

    <table>
        <tr>
            <th>Video ID</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($videos as $video) : ?>
            <tr>
                <td><?php echo $video["video_id"]; ?></td>
                <td><?php echo $video["description"]; ?></td>
                <td>
                    <a href="delete_video.php?video_id=<?php echo $video["id"]; ?>" onclick="return confirm('Are you sure you want to delete this video?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
    <br>
    <a href="admin_logout.php">Logout</a>
<?php
  include "_tiil.php";
    ?>