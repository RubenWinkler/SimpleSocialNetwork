<?php
$page_title = "Passwort vergessen - DIVISION Network";
include_once("./src/assets/head.php");
include_once("./src/assets/header.php");
include_once("./src/php/login-system/password-recovery-script.php");
?>
<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-container">
              <h3>Passwort vergessen? Kein Problem!</h3>
              <p>Gib einfach die E-Mail Adresse ein mit der du dich registriert hast und wir senden dir einen Passwort-Recovery-Link zu mit dem du ein neues Passwort für deinen Account festlegen kannst.</p>
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
                <label for="password-recovery-email" class="sr-only">E-Mail:</label>
                  <input type="text" class="form-control" id="password-recovery-email" placeholder="E-Mail" name="E-Mail">
                  <div id="show-login-again-text-cell">
                    <a href="./login.php" id="show-login-again-text">Doch anmelden?</a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="login-or-signup">
                  <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
                  <button type="submit" class="btn btn-default pull-center" id="password-recovery-button" name="password-recovery-button">Passwort ändern</button>
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
