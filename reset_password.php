<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $token = $_POST["token"];
    $newPassword = $_POST["new_password"];

    // Check if the token is correct
    $sql = "SELECT user_name FROM password_reset_requests WHERE token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userName = $row["user_name"];

        // Update the user's password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE name = '$userName'";

        if ($conn->query($updateSql) === TRUE) {
            // Password updated successfully, delete the token from the table
            $deleteTokenSql = "DELETE FROM password_reset_requests WHERE token = '$token'";
            $conn->query($deleteTokenSql);

            // Redirect to login page
            header("Location: login1.php?error=PASSWORD CHANGE SUCCESSFULLY.");
            exit;
        } else {
            $errorMessage = "Error updating password: " . $conn->error;
        }
    } else {
        $errorMessage = "Invalid token.";
    }
}

$conn->close();
?>
-->
<?php
  include "_ulo.php";
    ?>
  
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
    <form method="post" action=""class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h2 class="w3-center">Reset Password </h2>
 <div class="w3-panel w3-pale-red w3-bottombar w3-border-red w3-border">
  <p><strong>Note:</strong> Ask Admin for the token🙂🌱</p>
</div>
 <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="name" name="name" type="text" placeholder="Name" required>
    </div>
</div>
    
        <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="token" name="token" type="text" placeholder="Token" required>
    </div>
</div>
        
         <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-eye"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="reset_password" name="new_password" type="password" placeholder="New Password 
      " required>
    </div>
</div>
        
      
        <input type="submit" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Reset Password">
    </form>
    <p style="color:red;text-align: center;">©️TAGASUNDO 2023</p>
<?php
  include "_tiil.php";
    ?>