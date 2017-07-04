<?php if (!isset($_SESSION["username"])): ?>
<div id="login-widget-container">
  <div class="form-group">
    <form method="post" action="">
      <div class="row">
        <div class="col-xs-12">
          <label for="login-username" class="sr-only">Benutzername:</label>
            <input type="text" class="form-control form-elements" id="login-username" name="Benutzername" placeholder="Benutzername">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label for="login-password" class="sr-only">Passwort:</label>
            <input type="password" class="form-control form-elements" id="login-password" name="Passwort" placeholder="Passwort">
            <div id="forgot-password-cell">
              <a href="forgot-password.php" id="forgot-password-text">Passwort vergessen?</a>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox" id="remember-me-checkbox-container">
            <label><input class="" type="checkbox" value="yes" name="remember">Angemeldet bleiben</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="login-or-signup">
            <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
            <button type="submit" href="index.php" class="btn btn-danger pull-center login-widget-button red-form-button" name="login-button">Anmelden</button>
            <div id="or-between-login-and-signup">oder</div>
          </div>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-xs-12">
        <div class="login-or-signup">
          <a href="signup.php">
            <button class="btn btn-default pull-center login-widget-button">Registrieren</button>
          </a>
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
</div>
<?php endif ?>
