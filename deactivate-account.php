<?php
if (isset($_SESSION["username"])) {$page_title = "{$_SESSION['username']} - DIVISION Network";} else {$page_title = "DIVISION Network";}
include_once("./src/assets/head.php");
include_once("./src/php/login-system/profile.php");
include_once("./src/php/login-system/account-deactivation.php");
include_once("./src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
      <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">
        <div class="profile-container">
          <h1>Account deaktivieren</h1>
          <div>
            <?php if (isset($result)) {echo $result;} ?>
            <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
            <?php if (isset($result)) {echo '</div>';} ?>
          </div>
          <?php if (!isset($_SESSION["username"])): ?>
            <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
                Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
          <?php else: ?>
            <form method="post" action="" enctype="multipart/form-data">
              <input type="hidden" name="hidden-id" value="<?php if(isset($id)) { echo $id; } ?>">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button onclick="return confirm('Willst du deinen Account wirklich deaktivieren?')" type="submit" name="deactivate-account-button" class="btn btn-danger btn-block pull-right">Account deaktivieren</button>
            </form>
            <br />
            <br />
            <p><a href="profile.php">Zurück zum Profil</a></p>
          <?php endif ?>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right-sidebar-col">
      <div id="right-sidebar">
      <?php include_once("./src/assets/widgets/social-nav-widget/social-nav-widget.php"); ?>
      </div>
    </div>
    <?php include_once("./src/assets/widgets/chat-widget/chat-widget.php"); ?>
</div>
<?php include_once("./src/assets/footer.php"); ?>
