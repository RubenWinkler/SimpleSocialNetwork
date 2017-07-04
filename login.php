<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
$page_title = "Login";
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div>
          <h3 class="form-elements">Anmelden</h3>
          <p class="form-elements">Um dich anzumelden, gib einfach deinen Benutzernamen und dein Passwort ein.</p>
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
    <div class="form-group">
      <form method="post" action="">
        <div class="row">
          <div class="col-xs-12">
            <label for="login-username" class="sr-only">Benutzername:</label>
              <input type="text" class="form-control form-elements form-spacer" name="Benutzername" placeholder="Benutzername">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="login-password" class="sr-only">Passwort:</label>
              <input type="password" class="form-control form-elements form-spacer" name="Passwort" placeholder="Passwort">
              <div id="show-login-again-text-cell">
                <a href="forgot-password.php" id="show-login-again-text">Passwort vergessen?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="checkbox" id="remember-me-checkbox-container">
              <div>
                <label><input type="checkbox" value="yes" name="remember">Angemeldet bleiben</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login-or-signup">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" href="index.php" class="btn btn-danger pull-center red-form-button" name="login-button">Anmelden</button>
              <div id="or-between-login-and-signup">oder</div>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-xs-12">
          <div class="login-or-signup">
            <a href="signup.php">
              <button class="btn btn-default pull-center grey-form-button">Registrieren</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-end.php"); ?>
