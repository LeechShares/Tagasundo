<?php
  include "_ulo.php";
    ?>
 <form method="post" action="login.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h2 class="w3-center">Login</h2>
 
  <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
  <?php
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
  <p><strong>Note:</strong>  PM mo admin ng sundo  para ma approved yung account mo</p>
</div>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="username" name="username" type="text" placeholder="Username" required>
    </div>
</div>



<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-key"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="password" id="password" name="password"  placeholder="Password" required>
    </div>
</div>

  <input type="submit" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Login">
</form>
<?php
  include "_tiil.php";
    ?>