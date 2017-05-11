<?php
$page_title = "Registrieren - DIVISION Network";
include_once("./src/assets/head.php");
include_once("./src/assets/header.php");
include_once("./src/php/login-system/signup-script.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-container">
            <h3>Registriere dich jetzt!</h3>
            <p>Werde jetzt Mitglied im DIVISION Network und werde Teil einer stetig wachsenden Community aus begeisterten YouTubern.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <?php if (isset($result)) {echo $result;} ?>
            <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
            <?php if (isset($result)) {echo '</div>';} ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <form method="post" action="">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12">
                <label for="signup-username" class="sr-only">E-Mail:</label>
                  <input type="text" class="form-control" id="signup-email" placeholder="E-Mail" name="E-Mail">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label for="signup-username" class="sr-only">Benutzername:</label>
                  <input type="text" class="form-control" id="signup-username" placeholder="Benutzername" name="Benutzername">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label for="signup-password" class="sr-only">Passwort:</label>
                  <input type="password" class="form-control" id="signup-password" placeholder="Passwort" name="Passwort">
                  <div id="show-login-again-text-cell">
                    <a href="./login.php" id="show-login-again-text">Doch anmelden?</a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="login-or-signup">
                  <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
                  <button type="submit" class="btn btn-default pull-center" id="signup-button" name="signup-button">Registrieren</button>
                </div>
              </div>
            </div>
          </div>
        </form>
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
