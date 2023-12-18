<?php
include "config.php";

if (!isset($_GET["user_id"])) {
    header("Location: tagasundo.php"); // Redirect if user ID is not provided
    exit;
}

$userID = $_GET["user_id"];

// Retrieve user's information
$sql = "SELECT * FROM users WHERE id = $userID";
$result = $conn->query($sql);

if ($result === false || $result->num_rows !== 1) {
    die("Error retrieving user information.");
}

$row = $result->fetch_assoc();
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $row['rap_name']; ?></title>
  <meta property="og:title" content="<?php echo $row['rap_name']; ?>">
    <meta property="og:description" content="<?php echo $row['bio']; ?> ">
    <meta property="og:image" content="<?php echo $row['profile_image']; ?>">
    <meta property="og:url" content="http://tagasundo.hstn.me/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo $row['rap_name']; ?>">
    <meta property="og:locale" content="en_US">
  <link rel="stylesheet" href="./Profile-card.css" />
  <style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
    font-family: 'Times New Roman', Times, serif;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
 /*background: linear-gradient(#03a9f4, #03a9f4 45%, #fff 45%, #fff 100%); */
background-image: url('res/userbg.jpg'); 
  background-repeat: no-repeat; 
/*  background-size: 100% 220px; */
background-size: 100% 100%; 

}


.card {
  position: relative;
  width: 300px;
  height: 400px;
  border-radius: 10px; /* Adding rounded corners */
 /* background-color: white;*/
  background-image: url('res/flame.jpg');
  background-repeat: no-repeat;
  background-size: 100% 100%; /* Adjusted to fill the rounded area */
  border-top: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(15px);
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
} 
.img-bx {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  
  border-radius: 10px;
  overflow: hidden;
  transform: translateY(30px) scale(0.5);
  transform-origin: top;
}

.img-bx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.content {
  position: absolute;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  padding-bottom: 30px;
}

.content .detail {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
}

.content .detail h2 {
  color: lightgreen;
  font-size: 1.6em;
  font-weight: bolder;
}

.content .detail h2 span {
  font-size: 0.7em;
  /*color: #03a9f4; */
  color: white;
  font-weight: bold;
}


/*New rhhsnsjsjs */

    .floating-image {
  position: absolute;
  top: 0;
  left: 5%;
  transform: translateX(-50%);
  cursor: pointer;
  animation: float 4s infinite ease-in-out alternate, moveCenter 4s ease-in-out alternate;
  transition: transform 0.3s ease-in-out;
  z-index: 1; /* Added z-index to keep the image in front */
}

.floating-image:hover {
  transform: scale(1.1);
}

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-20px);
      }
    }
    
    @keyframes moveCenter {
      0%, 100% {
        top: 0;
      }
      50% {
        top: 50%;
      }
    } 
    
    .gender-image {
  width: 30px;
  height: 30px;
  margin-top: 5px;
}
  </style>
  <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
</head>
<body>
  <center>
  <img style="width: 100px; height:100px;" src="res/logo2.png" alt="Floating Image" class="floating-image" id="floatingImage">
  </center>
  <div class="card">


    <div class="img-bx">
      <img src="<?php echo $row['profile_image']; ?>" alt="img" />
      </div>    
    <br>
    <div>
    <div class="content">
      <div class="detail">
        <h2><?php echo $row['rap_name']; ?>  <?php
  if ($row['gender'] === 'male') {
    echo '<img src="res/lake.png" alt="Male">';
  } elseif ($row['gender'] === 'female') {
    echo '<img src="res/baye.png" alt="Female">';
  } else {
    echo '<img src="res/bayot.png" alt="Unknown">';
  }
?><!-- Add this line --><br /><span><center><p style="font-size:12px"><?php echo $row['bio']; ?></p></center></span>
        
        </h2>
      <br>
           
            <a href="<?php echo $row['fbp']; ?>"><img  style="width:200px ;height :50px"src="res/follow.png"></img></a>
         
         
            <a href="<?php echo $row['ytc']; ?>"><img style="width:200px ;height :50px" src="res/sub.png"></img></a>
        
     
      </div>
      </div>
    </div>
  </div>
  </div>
   <script>
    const floatingImage = document.getElementById("floatingImage");
    let isImage1 = true;

    floatingImage.addEventListener("click", () => {
      if (isImage1) {
        floatingImage.src = "res/logo2.png";
        isImage1 = false;
      } else {
        floatingImage.src = "res/logo2.png";
        isImage1 = true;
      }
      playClickSound();
      floatingImage.style.animation = "dodge 0.5s ease-in-out";
      setTimeout(() => {
        floatingImage.style.animation = "float 4s infinite ease-in-out alternate, moveCenter 4s ease-in-out alternate"; // Updated animation
      }, 500);
    });

    function playClickSound() {
      const audio = new Audio("res/snd_burning.mp3");
      audio.play();
    }
  </script>
</body>
</html>