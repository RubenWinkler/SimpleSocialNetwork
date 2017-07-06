<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <?php if (!isset($_SESSION["username"])): ?>
  <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
      Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
  <?php else: ?>

  <?php if (isset($member_username)) {$page_title = "Profile: {$member_username}";} else {$page_title = "User Profile";} ?>

  <!-- PROFILE ================================================== -->
  <section class="banner-picture-container">
    <div class="profile-banner" style="background-image: url(<?php if (isset($member_banner)) { echo $member_banner; } ?>)">
    </div>
    <div class="profile-picture-container img-thumbnail">
      <div class="profile-picture" style="background-image: url(<?php if (isset($member_avatar)) { echo $member_avatar; } ?>)">
      </div>
    </div>
  </section>
  <section>
    <h3><?php if (isset($member_username)) {echo $member_username;} ?></h3>
    <table class="profile-table">
      <tr><th>Benutzername:</th><td><?php if (isset($member_username)) {echo $member_username;} ?></td></tr>
      <tr><th>E-Mail:</th><td><?php if (isset($member_email)) {echo $member_email;} ?></td></tr>
      <tr><th>Mitglied seit:</th><td><?php if (isset($member_join_date)) {echo translateDateToGerman($member_join_date);} ?></td></tr>
    </table>
  </section>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
