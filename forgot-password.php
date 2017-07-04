<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
include_once("./src/php/login-system/password-recovery-script.php");
$page_title = "Forgot Password";
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="text-container">
          <h3 class="form-elements">Passwort vergessen? Kein Problem!</h3>
          <p class="form-elements">Gib einfach die E-Mail Adresse ein mit der du dich registriert hast und wir senden dir einen Passwort-Recovery-Link zu mit dem du ein neues Passwort für deinen Account festlegen kannst.</p>
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
            <label for="password-recovery-email" class="sr-only">E-Mail:</label>
              <input type="text" class="form-control form-elements" placeholder="E-Mail" name="E-Mail">
              <div id="show-login-again-text-cell">
                <a href="./login.php" id="show-login-again-text">Doch anmelden?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login-or-signup">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" class="btn btn-danger pull-center red-form-button" name="password-recovery-button">Passwort ändern</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>


<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-end.php"); ?>
