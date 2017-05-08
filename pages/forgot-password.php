<?php
$page_title = "Passwort vergessen - DIVISION Network";
include_once("./../src/assets/head.php");
include_once("./../src/assets/header.php");
include_once("./../src/php/login_system/password-recovery.php");
?>

<?php

// Wenn $_GET["id"] gesetzt ist,
if (isset($_GET["id"])) {

  // wird $encoded_id auf $_GET["id"] gesetzt,
  $encoded_id = $_GET["id"];

  // $encoded_id dekodiert und in $decoded_id gespeichert,
  $decoded_id = base64_decode($encoded_id);

  // die $decoded_id in Delimiter [0] und die eigentliche User-ID [1] gespalten und im Array $id_array gespeichert und
  $id_array = explode("JHf33QTa56afÜh32aURCdjY5H", $decoded_id);

  // $id auf $id_array["1"], also die eigentliche User-ID gesetzt.
  $id = $id_array["1"];

}

 ?>
<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main_content_container">
      <div id="login_or_signup_container">
        <div class="container-fluid">
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
                  <label for="password_reset_new_password" class="sr-only">Neues Passwort:</label>
                    <input type="password" class="form-control" id="password_reset_new_password" placeholder="Neues Passwort" name="Neues_Passwort">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <label for="password_reset_confirm_password" class="sr-only">Neues Passwort:</label>
                    <input type="password" class="form-control" id="password_reset_confirm_password" placeholder="Neues Passwort" name="Neues_Passwort_bestätigen">
                    <div id="show_login_again_text_cell">
                      <a href="./login.php" id="show_login_again_text">Doch anmelden?</a>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="login_or_signup">
                    <input type="hidden" name="user_id" value="<?php if (isset($id)) { echo $id; } ?>">
                    <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
                      <button type="submit" class="btn btn-default pull-center" id="password_reset_button" name="password_reset_button">Passwort ändern</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
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
