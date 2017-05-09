<?php
if (isset($_SESSION["username"])) {$page_title = "{$_SESSION["username"]} - DIVISION Network";} else {$page_title = "DIVISION Network";}
include_once("./src/assets/head.php");
include_once("./src/assets/header.php");
include_once("./src/php/login-system/profile.php");
?>
<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">
      <div class="profile-container">
        <?php if (!isset($_SESSION["username"])): ?>
          <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
              Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
        <?php else: ?>
          <div class="banner-and-avatar-container">
            <img src="<?php if (isset($profile-banner)) { echo $profile-banner; } ?>" alt="Profilbanner" class="profile-banner img">
            <a href="change-profile-banner.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-banner-glyphicon"></span></a>
            <div class="profile-picture-container">
              <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } ?>" alt="Profile Picture" class="profile-picture img img-thumbnail">
              <a href="change-profile-picture.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-avatar-glyphicon"></span></a>
            </div>
          </div>
          <div class="user-profile-table-container">
            <table class="user-profile-table">
              <tr><th>Benutzername:</th><td><?php if (isset($username)) {echo $username;} ?></td></tr>
              <tr><th>E-Mail:</th><td><?php if (isset($email)) {echo $email;} ?></td></tr>
              <tr><th>Mitglied seit:</th><td><?php if (isset($join_date)) {echo $join_date;} ?></td></tr>
              <tr><th></th><td>
                <a class="pull-right" href="deactivate-account.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-trash" id="edit-profile-glyphicon"></span> Account deaktivieren</a>
                <a class="" href="edit-profile.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-profile-glyphicon"></span> Profil bearbeiten</a> &nbsp; &nbsp;
                <a class="" href="change-password.php?user_identity=<?php if (isset($encode_id)) {echo $encode_id;} ?>"><span class="glyphicon glyphicon-edit" id="edit-profile-glyphicon"></span> Passwort ändern</a>
              </td></tr>
            </table>
          </div>
        <?php endif ?>
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
