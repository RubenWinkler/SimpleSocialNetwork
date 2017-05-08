<?php
$page_title = "Mitglieder - DIVISION Network";
include_once("./../src/assets/head.php");
include_once("./../src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main_content_container">
    <div class="container-fluid members_member_container">
      <table>
        <tr>
          <td>
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members_member_user_avatar">
          </td>
          <td class="members_member_info_td">
            <div>
              <span class="members_member_username">RUBEN</span>
              <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members_member_go_to_channel_button">Zum Kanal</button>
            </div>
            <div class="members_member_short_info">
              Lifestyle, Gaming & Vlogs | 194 Abonneten
            </div>
            <div class="members_member_interaction_container">
              <button type="button" class="btn btn-default btn-sm members_member_follow_btn">Folgen</button>
              <button type="button" class="btn btn-default btn-sm members_member_send_message_btn">Nachricht schreiben</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div class="container-fluid members_member_container">
      <table>
        <tr>
          <td>
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members_member_user_avatar">
          </td>
          <td class="members_member_info_td">
            <div>
              <span class="members_member_username">RUBEN</span>
              <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members_member_go_to_channel_button">Zum Kanal</button>
            </div>
            <div class="members_member_short_info">
              Lifestyle, Gaming & Vlogs | 194 Abonneten
            </div>
            <div class="members_member_interaction_container">
              <button type="button" class="btn btn-default btn-sm members_member_follow_btn">Folgen</button>
              <button type="button" class="btn btn-default btn-sm members_member_send_message_btn">Nachricht schreiben</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div class="container-fluid members_member_container">
      <table>
        <tr>
          <td>
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members_member_user_avatar">
          </td>
          <td class="members_member_info_td">
            <div>
              <span class="members_member_username">RUBEN</span>
              <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members_member_go_to_channel_button">Zum Kanal</button>
            </div>
            <div class="members_member_short_info">
              Lifestyle, Gaming & Vlogs | 194 Abonneten
            </div>
            <div class="members_member_interaction_container">
              <button type="button" class="btn btn-default btn-sm members_member_follow_btn">Folgen</button>
              <button type="button" class="btn btn-default btn-sm members_member_send_message_btn">Nachricht schreiben</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div class="container-fluid members_member_container">
      <table>
        <tr>
          <td>
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded members_member_user_avatar">
          </td>
          <td class="members_member_info_td">
            <div>
              <span class="members_member_username">RUBEN</span>
              <button href="https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw" class="btn btn-danger btn-xs members_member_go_to_channel_button">Zum Kanal</button>
            </div>
            <div class="members_member_short_info">
              Lifestyle, Gaming & Vlogs | 194 Abonneten
            </div>
            <div class="members_member_interaction_container">
              <button type="button" class="btn btn-default btn-sm members_member_follow_btn">Folgen</button>
              <button type="button" class="btn btn-default btn-sm members_member_send_message_btn">Nachricht schreiben</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right_sidebar_col">
      <?php include_once("./../src/assets/widgets/social_nav_widget/social_nav_widget.php"); ?>
    </div>
    <?php include_once("./../src/assets/widgets/chat_widget/chat_widget.php"); ?>
</div>
<?php include_once("./../src/assets/footer.php"); ?>
