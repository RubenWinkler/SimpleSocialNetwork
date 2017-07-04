<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
if (isset($_SESSION["username"])) {$page_title = "Your Page Title";} else {$page_title = "The Simple Social Network";}
?>

<!-- FOUR COLUMN LAYOUT START ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-start.php"); ?>

  <!-- ADD YOUR CONTENT HERE ================================================== -->


<!-- FOUR COLUMN LAYOUT END ================================================== -->
<?php include_once("./src/assets/one-column-layout/one-column-layout-end.php"); ?>
