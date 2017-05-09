<?php
$page_title = "Mitglieder - DIVISION Network";
include_once("./src/assets/head.php");
include_once("./src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./src/assets/left-sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main-content-container">
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
  </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right-sidebar-col">
      <?php include_once("./src/assets/widgets/social-nav-widget/social-nav-widget.php"); ?>
    </div>
    <?php include_once("./src/assets/widgets/chat-widget/chat-widget.php"); ?>
</div>
<?php include_once("./src/assets/footer.php"); ?>
