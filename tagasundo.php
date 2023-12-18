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
            background-image: url('res/bg.png');
            background-repeat: no-repeat;
            background-size: 100% 220px;
        /*    border-radius: 5%; */
            border: 1px solid #ccc;
            margin: 10px;
        }

        .user-image {
            flex: 0 0 auto;
            margin-right: 10px;
        }

        .user-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .user-details {
            flex: 1 1 auto;
        }

        h3 {
            margin: 0;
        }

        p {
            margin: 0;
        }

        .clickable {
            cursor: pointer;
        }
    </style>
</head>
    <h2>TAGASUNDO OFFICIAL</h2>
     <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
  <p><strong>Note:</strong> Lahat ng nakalista dito ay <i>Official Na Myembro</i>  ng <strong>TAGASUNDO</strong></p>
</div> 
    <?php
    include "config.php";

    // Retrieve approved users
    $sql = "SELECT id, rap_name, profile_image FROM users WHERE is_approved = 1 ORDER BY id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='user-box clickable' onclick='redirectToUserProfile(" . $row["id"] . ")'>";
            echo "<div class='user-image'>";
            
            // Check if the profile image is empty
            if (!empty($row["profile_image"])) {
                echo "<img src='" . $row["profile_image"] . "' alt='Profile Image'>";
            } else {
                echo "<img src='https://w7.pngwing.com/pngs/205/731/png-transparent-default-avatar-thumbnail.png' alt='Default Profile Image'>";
            }
            
            echo "</div>";
            echo "<div class='user-details'>";
            echo "<strong style='color:white'>" . $row["rap_name"] . "</strong>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No approved users found.</p>";
    }
    ?>

    <script>
        function redirectToUserProfile(userId) {
            window.location.href = "user_profile.php?user_id=" + userId;
        }
    </script>
<?php
  include "_tiil.php";
    ?>