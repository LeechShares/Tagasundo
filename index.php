<?php
  include "_ulo.php";
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .shared-videos {
            margin-top: 20px;
        }

        .shared-video {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Shared Videos</h3>
         <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
  <p><strong>Note:</strong> Supportahan natin mga par☺️</p>
</div>
        <div class="shared-videos">
            <?php
            include "config.php";

            // Retrieve up to 7 shared videos
            $sql = "SELECT * FROM shared_videos ORDER BY id DESC LIMIT 7";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='shared-video'>";
                    echo "<iframe width='100%' height='315' src='https://www.youtube.com/embed/" . $row["video_id"] . "' frameborder='0' allowfullscreen></iframe>";
                    echo "<p><strong>Title:</strong> " . $row["description"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No shared videos yet.</p>";
            }
            ?>
        </div>
    </div>
<?php
  include "_tiil.php";
    ?>