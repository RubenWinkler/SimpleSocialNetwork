<?php
if (isset($_SESSION["username"])) {$page_title = "Edit Profile";} else {$page_title = "The Simple Social Network";}
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

  <!-- EDIT PROFILE ================================================== -->
    <h2 class="form-elements">Profil bearbeiten</h2>
    <div class="row">
      <div class="col-xs-12">
          <?php if (isset($result)) {echo $result;} ?>
          <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
          <?php if (isset($result)) {echo '</div>';} ?>
      </div>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group form-elements">
        <lable for="E-Mail">E-Mail</lable>
        <input type="text" name="E-Mail" class="form-control" id="E-Mail" value="<?php if (isset($email)) { echo $email; } ?>">
      </div>
      <div class="form-group form-elements">
        <lable for="Benutzername">Benutzername</lable>
        <input type="text" name="Benutzername" class="form-control" id="Benutzername" value="<?php if (isset($username)) { echo $username; } ?>">
      </div>
      <div class="form-elements">
        <input type="hidden" name="hidden-id" value="<?php if (isset($id)) { echo $id; } ?>">
        <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
        <button type="submit" name="edit-profile-button" class="btn btn-default pull-right">Speichern</button><br />
      </div>
    </form>
    <br />
    <br />
    <p class="form-elements"><a href="profile.php">Zurück zum Profil</a></p>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
