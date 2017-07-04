<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
if (isset($_SESSION["username"])) {$page_title = "Your Page Title";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <?php if (!isset($_SESSION["username"])): ?>
  <p> Die Profile sind nur für Mitglieder sichtbar. <a href="login.php">Melde dich bitte an!</a><br /><br />
      Du bist noch kein Mitglied? <a href="signup.php">Registriere dich jetzt!</a></p>
  <?php else: ?>

  <!-- MEMBERS LIST ================================================== -->
  <div class="container-fluid members-member-container">
    <table>
      <tr>
        <td>
          <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./avatar-uploads/{$_SESSION['username']}.jpg")) { echo "./avatar-uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members-member-user-avatar">
        </td>
        <td class="members-member-info-td">
          <div>
            <span class="members-member-username">RUBEN</span>
            <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members-member-go-to-channel-button">Zum Kanal</button>
          </div>
          <div class="members-member-short-info">
            Lifestyle, Gaming & Vlogs | 194 Abonneten
          </div>
          <div class="members-member-interaction-container">
            <button type="button" class="btn btn-default btn-sm members-member-follow-btn">Folgen</button>
            <button type="button" class="btn btn-default btn-sm members-member-send-message-btn">Nachricht schreiben</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div class="container-fluid members-member-container">
    <table>
      <tr>
        <td>
          <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./avatar-uploads/{$_SESSION['username']}.jpg")) { echo "./avatar-uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members-member-user-avatar">
        </td>
        <td class="members-member-info-td">
          <div>
            <span class="members-member-username">RUBEN</span>
            <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members-member-go-to-channel-button">Zum Kanal</button>
          </div>
          <div class="members-member-short-info">
            Lifestyle, Gaming & Vlogs | 194 Abonneten
          </div>
          <div class="members-member-interaction-container">
            <button type="button" class="btn btn-default btn-sm members-member-follow-btn">Folgen</button>
            <button type="button" class="btn btn-default btn-sm members-member-send-message-btn">Nachricht schreiben</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div class="container-fluid members-member-container">
    <table>
      <tr>
        <td>
          <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./avatar-uploads/{$_SESSION['username']}.jpg")) { echo "./avatar-uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members-member-user-avatar">
        </td>
        <td class="members-member-info-td">
          <div>
            <span class="members-member-username">RUBEN</span>
            <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members-member-go-to-channel-button">Zum Kanal</button>
          </div>
          <div class="members-member-short-info">
            Lifestyle, Gaming & Vlogs | 194 Abonneten
          </div>
          <div class="members-member-interaction-container">
            <button type="button" class="btn btn-default btn-sm members-member-follow-btn">Folgen</button>
            <button type="button" class="btn btn-default btn-sm members-member-send-message-btn">Nachricht schreiben</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div class="container-fluid members-member-container">
    <table>
      <tr>
        <td>
          <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./avatar-uploads/{$_SESSION['username']}.jpg")) { echo "./avatar-uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members-member-user-avatar">
        </td>
        <td class="members-member-info-td">
          <div>
            <span class="members-member-username">RUBEN</span>
            <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members-member-go-to-channel-button">Zum Kanal</button>
          </div>
          <div class="members-member-short-info">
            Lifestyle, Gaming & Vlogs | 194 Abonneten
          </div>
          <div class="members-member-interaction-container">
            <button type="button" class="btn btn-default btn-sm members-member-follow-btn">Folgen</button>
            <button type="button" class="btn btn-default btn-sm members-member-send-message-btn">Nachricht schreiben</button>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <?php endif ?>

<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
