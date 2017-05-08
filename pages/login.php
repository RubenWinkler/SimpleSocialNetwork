<?php
$page_title = "Anmelden - DIVISION Network";
include_once("./../src/assets/head.php");
include_once("./../src/php/login_system/login.php");
include_once("./../src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main_content_container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="text_container">
            <h3>Anmelden</h3>
            <p>Um dich anzumelden, gib einfach deinen Benutzernamen und dein Passwort ein.</p>
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
                <label for="login_username" class="sr-only">Benutzername:</label>
                  <input type="text" class="form-control" id="login_username" name="Benutzername" placeholder="Benutzername">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label for="login_password" class="sr-only">Passwort:</label>
                  <input type="password" class="form-control" id="login_password" name="Passwort" placeholder="Passwort">
                  <div id="show_login_again_text_cell">
                    <a href="password-recovery.php" id="show_login_again_text">Passwort vergessen?</a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="checkbox" id="remember_me_checkbox_container">
                  <div class="pull-right">
                    <label class="pull"><input class="" type="checkbox" value="yes" name="remember">Angemeldet bleiben</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="login_or_signup">
                  <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
                  <button type="submit" href="index.php" class="btn btn-danger pull-center" id="login_button" name="login_button">Anmelden</button>
                  <div id="or_between_login_and_signup">oder</div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <div class="login_or_signup">
                <a href="signup.php">
                  <button class="btn btn-default pull-center" id="go_to_signup_button">Registrieren</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right_sidebar_col">
      <div id="right_sidebar">
      <?php include_once("./../src/assets/widgets/social_nav_widget/social_nav_widget.php"); ?>
      </div>
    </div>
    <?php include_once("./../src/assets/widgets/chat_widget/chat_widget.php"); ?>
</div>
<?php include_once("./../src/assets/footer.php"); ?>
