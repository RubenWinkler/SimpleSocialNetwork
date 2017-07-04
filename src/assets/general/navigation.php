<?php
include_once("./src/php/login-system/login-script.php");
include_once("./src/php/login-system/profile-script.php");
?>

<header>
  <nav class="navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">SimpleSocialNetwork</a>
      </div><!-- /.navbar-header -->
      <div class="collapse navbar-collapse">
        <?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
        <form class="navbar-form navbar-left" id="header-navigation-search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Suchen nach...">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
        <?php endif ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Startseite</a></li>
          <?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
          <li>
            <a href="profile.php" id="user">
              <img class="img-rounded hidden-xs" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" id="header-navigation-avatar">
              <span id="username"><?php if (isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?></span>
            </a>
          </li>
          <?php endif ?>
          <?php if (!isset($_SESSION["username"])): ?>
            <li><a href="register.php">About</a></li>
          <?php endif ?>
          <?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
            <li><a href="notifications.php"><i class="header-fa-icons fa fa-globe fa-lg"></i></a></li>
          <?php endif ?>
          <?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
            <li><a href="einstellungen.php"><i class="header-fa-icons fa fa-cog fa-lg"></i></a></li>
          <?php endif ?>
          <?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
            <li><a href="logout.php">Abmelden</a></li>
          <?php endif ?>
          <?php if (!isset($_SESSION["username"])): ?>
            <li><a href="login.php">Login</a></li>
          <?php endif ?>
          <?php if (!isset($_SESSION["username"])): ?>
            <li><a href="Signup.php">Signup</a></li>
          <?php endif ?>
         </ul>
       </div>
     </div>
   </nav>
</header>
