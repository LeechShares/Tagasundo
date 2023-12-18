<?php
  include "_ulo.php";
    ?>
  <form method="post" action="register2.php" class="w3-container w3-card-4 w3-light-blue w3-text-blue w3-margin" enctype="multipart/form-data">
<h2 class="w3-center">Register | Admin</h2>
 
  <div class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">
   <?php if (isset($_GET['error'])) : ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php endif; ?><p><strong>Note:</strong>  D2 mag reregister ang mga Admin Forbidden justu po eto 🌱</p>
</div>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="name" name="name" type="text" placeholder="Username" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="rap_name" name="rap_name" type="text" placeholder="rapname" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-key"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="password" id="password" name="password"  placeholder="Password" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    <div class="w3-rest">
        <textarea class="w3-input w3-border" id="bio" name="bio" placeholder= "BIO"></textarea>
    </div>
</div>
  <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Bayot</option>
        </select><br><br>

<label for="ytc">YouTube Channel:</label>
        <input type="text" id="ytc" name="ytc"><br><br>
        
        <label for="fbp">Facebook Profile:</label>
        <input type="text" id="fbp" name="fbp"><br><br>
        
        <label for="profile_image">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image"><br><br>
<!--ADDING THIS MDF-->
 <input type="hidden" name="is_approved" value="1">
        <input type="hidden" name="is_admin" value="1">

  <input type="submit" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Register">
</form>
<?php
  include "_tiil.php";
    ?>