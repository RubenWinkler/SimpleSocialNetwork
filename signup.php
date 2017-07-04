<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
$page_title = "Signup";
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="text-container">
        <h3 class="form-elements">Registriere dich jetzt!</h3>
        <p class="form-elements">Werde jetzt Mitglied im DIVISION Network und werde Teil einer stetig wachsenden Community aus begeisterten YouTubern.</p>
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
            <label for="signup-username" class="sr-only">E-Mail:</label>
              <input type="text" class="form-control form-elements form-spacer" placeholder="E-Mail" name="E-Mail">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="signup-username" class="sr-only">Benutzername:</label>
              <input type="text" class="form-control form-elements form-spacer" placeholder="Benutzername" name="Benutzername">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="signup-password" class="sr-only">Passwort:</label>
              <input type="password" class="form-control form-elements form-spacer" placeholder="Passwort" name="Passwort">
              <div id="show-login-again-text-cell">
                <a href="./login.php" id="show-login-again-text">Doch anmelden?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login-or-signup">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" class="btn btn-danger pull-center red-form-button" name="signup-button">Registrieren</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-end.php"); ?>
