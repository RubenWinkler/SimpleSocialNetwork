<?php
if (isset($_SESSION["username"])) {$page_title = "{$_SESSION['username']} - DIVISION Network";} else {$page_title = "DIVISION Network";}
include_once("./../src/assets/head.php");
include_once("./../src/php/login_system/profile.php");
include_once("./../src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
      <div class="col-md-6 col-sm-8 col-xs-12" id="main_content_container">
        <div class="profile_container">
          <h1>Profilbild ändern</h1>
          <div>
            <?php if (isset($result)) {echo $result;} ?>
            <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
            <?php if (isset($result)) {echo '</div>';} ?>
          </div>
          <?php if (!isset($_SESSION["username"])): ?>
            <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
                Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
          <?php else: ?>
            <h3>Profilbanner ändern</h3>
            <form method="post" action="" enctype="multipart/form-data">
              <div class="form-group">
                <lable for="Profilbanner" class="sr-only">Profilbanner</lable>
                <input type="file" name="Profilbanner" id="Profilbanner">
              </div>
              <div class="form-group">
                <input type="hidden" name="E-Mail" class="form-control" id="E-Mail" value="<?php if (isset($email)) { echo $email; } ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="Benutzername" class="form-control" id="Benutzername" value="<?php if (isset($username)) { echo $username; } ?>">
              </div>
              <input type="hidden" name="hidden_id" value="<?php if (isset($id)) { echo $id; } ?>">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" name="edit_profile_button" class="btn btn-default pull-right">Speichern</button><br />
            </form>
            <br />
            <br />
            <p><a href="profile.php">Zurück zum Profil</a></p>
          <?php endif ?>
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
