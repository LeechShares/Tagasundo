<?php
session_start();
include "config.php";

// Check if user is logged in or admin
if (!isset($_SESSION["user_logged_in"]) && !isset($_SESSION["admin_logged_in"])) {
    header("Location: login1.php"); // Redirect to login page
    exit;
}
?>
<?php
  include "_ulo.php";
    ?>
<form method="post" action="process_link.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h2 class="w3-center">Share YouTube Embedded Video</h2>
 
  <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
  <?php
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
  <p><strong>Note:</strong> ang Link na Ilagay mo sa Baba ay ang <i>Embedded </i>na link, Click mo  <a href="ytembedgen.php">Dito</a>  para makuha ang embedded na link mo</p>
</div>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-link"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="embedded_link" type="text" placeholder="https://www.youtube.com/embed/BcbVKJp2q_w" required>
    </div>
</div>



<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="description" type="text" maxlength="25" placeholder="Title" required>
    </div>
</div>

  <input type="submit" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Share">
</form>
<script>
const embeddedInput = document.getElementById('embeddedInput');
const submitButton = document.getElementById('submitButton');

embeddedInput.addEventListener('input', () => {
    const embeddedText = "embed text"; // The text you want to detect
    if (embeddedInput.value.includes(embeddedText)) {
        submitButton.removeAttribute('disabled');
    } else {
        submitButton.setAttribute('disabled', 'true');
    }
});
</script>
<?php
  include "_tiil.php";
    ?> 