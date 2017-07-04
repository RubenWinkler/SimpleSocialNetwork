<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
include_once("./src/php/login-system/account-deactivation-script.php");
if (isset($_SESSION["username"])) {$page_title = "Your Page Title";} else {$page_title = "The Simple Social Network";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <?php if (!isset($_SESSION["username"])): ?>
  <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
      Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
  <?php else: ?>

  <!-- DEACTIVATE ACCOUNT ================================================== -->
    <h2 class="form-elements">Account deaktivieren</h2>
    <div class="row">
      <div class="col-xs-12">
          <?php if (isset($result)) {echo $result;} ?>
          <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
          <?php if (isset($result)) {echo '</div>';} ?>
      </div>
    </div>
    <form method="post" action="" enctype="multipart/form-data" class="form-elements">
      <input type="hidden" name="hidden-id" value="<?php if(isset($id)) { echo $id; } ?>">
      <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
      <button onclick="return confirm('Willst du deinen Account wirklich deaktivieren?')" type="submit" name="deactivate-account-button" class="btn btn-danger pull-right red-form-button">Account deaktivieren</button>
    </form>
    <br />
    <br />
    <p class="form-elements"><a href="profile.php">Zurück zum Profil</a></p>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
