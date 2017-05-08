<?php $page_title = "Account aktivieren - DIVISION Network";
include_once("./../src/assets/head.php");
include_once("./../src/php/login_system/signup.php");
include_once("./../src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="main_content_container">
      <div class="activate_container">
        <?php if (isset($result)) { echo $result; } ?>
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
