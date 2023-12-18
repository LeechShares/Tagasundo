<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rapName = $_POST["rap_name"];

    // Check if the user and rap name match in the database
    $sql = "SELECT id FROM users WHERE name = '$name' AND rap_name = '$rapName'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Generate a random token
        $token = bin2hex(random_bytes(32));

        // Insert the token into the database
        $sqlInsert = "INSERT INTO password_reset_requests (user_name, rap_name, token) VALUES ('$name', '$rapName', '$token')";

        if ($conn->query($sqlInsert) === TRUE) {
            $successMessage = "Password reset token generated successfully! You can now proceed to reset password page";
        } else {
            $errorMessage = "Error generating token: " . $conn->error;
        }
    } else {
        $errorMessage = "Invalid user or rap name.";
    }
}

$conn->close();
?>
<?php
  include "_ulo.php";
    ?>
    <?php
    if (isset($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    }
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
    <form method="post" action=""class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h2 class="w3-center">Forgot Password?</h2>
  <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
  <p><strong>Note:</strong> Fill up nyu nalang yang forms tas generate token pag successful nakalagay PM mo yung admin para sya kukuha ng Token mo tas ibibigay sayo sa ganong paraan ay ma iverify ka hahaha 😂 </p>
<a href="reset_password.php">👉Reset Password Here </a>
</div>

    <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="name" name="name" type="text" placeholder="Name" required>
    </div>
</div>
        <!--end-->
        
         <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="rap_name" name="rap_name" type="text" placeholder="RapName" required>
    </div>
</div>


        <input type="submit" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Generate Token">
    </form>
<?php
  include "_tiil.php";
    ?>
