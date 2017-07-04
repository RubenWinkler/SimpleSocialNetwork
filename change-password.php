<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/profile-script.php");
include_once("./src/php/login-system/change-password-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
if (isset($_SESSION["username"])) {$page_title = "{$_SESSION['username']} - DIVISION Network";} else {$page_title = "The Simple Social Network";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <?php if (!isset($_SESSION["username"])): ?>
  <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
      Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
  <?php else: ?>

  <!-- CHANGE PASSWORD ================================================== -->
  <div class="row">
    <div class="col-xs-12">
        <?php if (isset($result)) {echo $result;} ?>
        <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
        <?php if (isset($result)) {echo '</div>';} ?>
    </div>
  </div>
  <h2 class="form-elements">Passwort ändern</h3>
  <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group form-elements">
      <lable for="Aktuelles Passwort">Aktuelles Passwort</lable>
      <input type="password" name="Aktuelles-Passwort" class="form-control" placeholder="Aktuelles Passwort">
    </div>
    <div class="form-group form-elements">
      <lable for="Neues Passwort">Neues Passwort</lable>
      <input type="password" name="Neues-Passwort" class="form-control" placeholder="Neues Passwort">
    </div>
    <div class="form-group form-elements">
      <lable for="Neues Passwort bestätigen">Neues Passwort bestätigen</lable>
      <input type="password" name="Neues-Passwort-bestätigen" class="form-control" placeholder="Neues Passwort bestätigen">
    </div>
    <div class="form-elements">
      <input type="hidden" name="hidden-id" value="<?php if (isset($id)) { echo $id; } ?>">
      <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
      <button type="submit" name="change-password-button" class="btn btn-default pull-right">Speichern</button>
    </div>
  </form>
  <br />
  <br />
  <p class="form-elements"><a href="profile.php">Zurück zum Profil</a></p>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>





<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
      <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">

    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right-sidebar-col">
      <div id="right-sidebar">
      <?php include_once("./src/assets/widgets/social-nav-widget/social-nav-widget.php"); ?>
      </div>
    </div>
    <?php include_once("./src/assets/widgets/chat-widget/chat-widget.php"); ?>
</div>
<?php include_once("./src/assets/footer.php"); ?>
