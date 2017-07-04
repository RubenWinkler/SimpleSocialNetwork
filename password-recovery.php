<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/password-recovery-script.php");
$page_title = "Password Recovery";
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->
  <div class="container-fluid">
    <h2 class="form-elements">Password Recovery</h2>
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
            <label for="email" class="sr-only">E-Mail:</label>
              <input type="text" class="form-control form-elements form-spacer" placeholder="E-Mail" name="E-Mail">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="Token" class="sr-only">Token:</label>
              <input type="text" class="form-control form-elements form-spacer" placeholder="Token" name="Token">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="password-reset-new-password" class="sr-only">Neues Passwort:</label>
              <input type="password" class="form-control form-elements form-spacer" placeholder="Neues Passwort" name="Neues-Passwort">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="password-reset-confirm-password" class="sr-only">Neues Passwort (wiederholen):</label>
              <input type="password" class="form-control form-elements form-spacer" placeholder="Neues Passwort (wiederholen)" name="Neues-Passwort-bestätigen">
              <div id="show-login-again-text-cell">
                <a href="./login.php" id="show-login-again-text">Doch anmelden?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login-or-signup">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" class="btn btn-danger pull-center red-form-button" name="password-reset-button">Passwort ändern</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-end.php"); ?>
