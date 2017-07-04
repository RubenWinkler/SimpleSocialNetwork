<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
if (isset($_SESSION["username"])) {$page_title = "Profile: {$_SESSION["username"]}";} else {$page_title = "User Profile";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <?php if (!isset($_SESSION["username"])): ?>
  <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
      Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
  <?php else: ?>

  <!-- PROFILE ================================================== -->
  <section class="banner-picture-container">
    <div class="profile-banner" style="background-image: url(<?php if (isset($profile_banner)) { echo $profile_banner; } ?>)">
      <a href="change-profile-banner.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-banner-glyphicon"></span></a>
    </div>
    <div class="profile-picture-container img-thumbnail">
      <div class="profile-picture" style="background-image: url(<?php if (isset($profile_picture)) { echo $profile_picture; } ?>)">
        <a href="change-profile-picture.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-profile-picture-glyphicon"></span></a>
      </div>
    </div>
  </section>
  <section>
    <h3>Dein Profil</h3>
    <table class="profile-table">
      <tr><th>Benutzername:</th><td><?php if (isset($username)) {echo $username;} ?></td></tr>
      <tr><th>E-Mail:</th><td><?php if (isset($email)) {echo $email;} ?></td></tr>
      <tr><th>Mitglied seit:</th><td><?php if (isset($join_date)) {echo translateDateToGerman($join_date);} ?></td></tr>
      <tr><th></th><td>
        <a class="pull-right" href="deactivate-account.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-trash" id="edit-profile-glyphicon"></span> Account deaktivieren</a>
        <a class="" href="edit-profile.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-profile-glyphicon"></span> Profil bearbeiten</a> &nbsp; &nbsp;
        <a class="" href="change-password.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-profile-glyphicon"></span> Passwort ändern</a>
    </table>
  </section>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
