<?php
session_start();

include "config.php";
include "_ulo.php";

// Check if the user is logged in
if (!isset($_SESSION["user_logged_in"]) || $_SESSION["user_logged_in"] !== true) {
    die("Access denied. Please log in.");
}

$userID = $_SESSION["user_id"];

// Retrieve user's information
$sql = "SELECT * FROM users WHERE id = $userID";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing SQL query: " . $conn->error);
}

$row = $result->fetch_assoc();
?>

<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif} .sundobg {  background-image: url('res/logo.jpg');
  background-repeat: no-repeat;
  background-size: 100% 100%; height: 300px}   a {
         
            text-decoration: none; 
            }
</style>
</head>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
        <div  class="sundobg">
        
       
         
          <div class="w3-display-bottomleft w3-container w3-text-black">
             <img src="<?php echo $row['profile_image']; ?>" style="width:100px;50px;" alt="Avatar">
            <h2 style="color:white"><?php echo $row['rap_name']; ?><?php
  if ($row['gender'] === 'male') {
    echo '<img src="res/lake.png" alt="Male">';
  } elseif ($row['gender'] === 'female') {
    echo '<img src="res/baye.png" alt="Female">';
  } else {
    echo '<img src="res/bayot.png" alt="Unknown">';
  }
?></h2>
            </div>
          </div>
        </div>
        <div class="w3-container">
            <p><i class="fa fa-info fa-fw w3-margin-right w3-large w3-text-teal"></i><i><?php echo $row['bio']; ?></i></p>
          <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $row['name']; ?></p>
          <p><i class="fa fa-youtube fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="<?php echo $row['ytc']; ?>">: <?php echo $row['ytc']; ?></a></p>
          <p><i class="fa fa-facebook fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="<?php echo $row['fbp']; ?>">: <?php echo $row['fbp']; ?></a></p>
      
          <hr>
     <div class="w3-container">
          <h5 class="w3-opacity"><b>Members Features:</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-pencil fa-fw w3-margin-right"></i>Tools</h6>
       <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true) : ?>
        <p><a href="admin_panel.php">Admin Panel</a></p>
    <?php else : ?>
        <p><a href="edit_user_profile.php">Edit Your Profile</a></p>
    <?php endif; ?>
    
    <br>
        </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
<?php
  include "_tiil.php";
    ?> 