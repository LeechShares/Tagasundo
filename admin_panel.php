<?php
session_start();
include "config.php";

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php?error=only admin can access admin panel");
    exit;
}

// Process user approval or rejection
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userID = $_POST["user_id"];
    $action = $_POST["action"];
    
    if ($action === "approve") {
        // Update the user's approval status
        $updateSql = "UPDATE users SET is_approved = 1 WHERE id = $userID";
        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "User approved successfully!";
        } else {
            $errorMessage = "Error approving user: " . $conn->error;
        }
    } elseif ($action === "reject") {
        // Delete the user's record
        $deleteSql = "DELETE FROM users WHERE id = $userID";
        if ($conn->query($deleteSql) === TRUE) {
            $successMessage = "User rejected and deleted successfully!";
        } else {
            $errorMessage = "Error rejecting user: " . $conn->error;
        }
    }
}
?>

<?php
  include "_ulo.php";
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .user-box {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-details {
            flex: 1;
            padding-left: 10px;
        }

        .user-details h3 {
            margin: 0;
        }

        .user-details p {
            margin: 0;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .action-buttons form {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>Welcome, Admin</h2>

    <h3>Manage Users</h3>
      
    <div class="w3-panel w3-pale-green w3-bottombar w3-border-red w3-border">
  <p>Note: Hoi ikaw char admin ka dapat </p>
</div>
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    if (isset($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    }
    ?>
    <div>
        <?php
      
        // Retrieve non-approved users
        $sql = "SELECT id, name, rap_name FROM users WHERE is_approved = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user-box'>";
                echo "<div class='user-details'>";
                echo "<h3>" . $row["name"] . "</h3>";
                echo "<p>Rap Name: " . $row["rap_name"] . "</p>";
                echo "</div>";
                echo "<div class='action-buttons'>";
                echo "<form method='post' action='admin_panel.php'>";
                echo "<input type='hidden' name='user_id' value='" . $row["id"] . "'>";
                echo "<input type='hidden' name='action' value='approve'>";
                echo "<input type='submit' value='Approve'>";
                echo "</form>";
                echo "<form method='post' action='admin_panel.php'>";
                echo "<input type='hidden' name='user_id' value='" . $row["id"] . "'>";
                echo "<input type='hidden' name='action' value='reject'>";
                echo "<input type='submit' value='Reject'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No users to approve.</p>";
        }
        ?>
    </div>

    <p><a href="admin_logout.php">Logout</a></p>
<?php
  include "_tiil.php";
    ?>