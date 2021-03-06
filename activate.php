<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
include_once("./src/php/login-system/signup-script.php");
if (isset($_SESSION["username"])) {$page_title = "Activate Account";} else {$page_title = "The Simple Social Network";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->
  <div class="activate-container">
    <?php if (isset($result)) { echo $result; } ?>
  </div>


<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/four-column-layout/four-column-layout-end.php"); ?>
