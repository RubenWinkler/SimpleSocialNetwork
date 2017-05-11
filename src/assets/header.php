<?php include_once("./src/php/login-system/utilities-script.php"); ?>
<?php include_once("./src/php/login-system/profile-script.php"); ?>
<!-- Wenn der Benutzer eingeloggt ist wird der Header für eingeloggte Nutzer angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
  <nav class="navbar navbar-inverse navbar-fixed-top" id="header">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div id="header-logo-und-schriftzug">
        <!-- Logo und "DIVISION Network"-Schriftzug -->
          <a class="navbar-brand" id="header-logo" href="index.php">
            <img alt="DIVISION Network" src="./src/img/header-logo.png">
          </a>
        <!-- /Logo und "DIVISION Network"-Schriftzug -->
        </div>
        <form class="navbar-form navbar-left hidden-xs" id="header-search-form">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Suchen nach...">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div id="navbar" class="collapse navbar-collapse nav navbar-nav navbar-right" id="header-nav">
          <ul class="nav navbar-nav">
            <i class="hide"><?php echo guard(); ?></i>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="index.php">Startseite</a></li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="blog.php">YouTube-Blog</a></li>
            <li class="header-nav-li">
              <a href="profile.php" class="header-nav-li-profile-element">
                <img class="img-rounded hidden-xs" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" id="navbar-user-avatar">
                <?php if (isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?>
              </a>
            </li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="nachrichten.php">Nachrichten</a></li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="mitglieder.php">Mitglieder</a></li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="gruppen.php">Gruppen</a></li>
            <li class="header-nav-li hidden-xs"><a href="index.php">Startseite</a></li>
            <li class="header-nav-li hidden-xs"><a href="benachrichtigungen.php"><i class="header-fa-icons fa fa-globe fa-lg"></i></a></li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="benachrichtigungen.php">Benachrichtigungen</a></li>
            <li class="header-nav-li hidden-xs"><a href="einstellungen.php"><i class="header-fa-icons fa fa-cog fa-lg"></i></a></li>
            <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="einstellungen.php">Einstellungen</a></li>
            <li class="header-nav-li"><a href="logout.php">Abmelden</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Wenn der Benutzer nicht eingeloggt ist wird der Header für nicht eingeloggte Nutzer angezeigt. -->
  <?php else: ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" id="header">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div id="header-logo-und-schriftzug">
          <!-- Logo und "DIVISION Network"-Schriftzug -->
            <a class="navbar-brand" id="header-logo" href="index.php">
              <img alt="DIVISION Network" src="./src/img/header-logo.png">
            </a>
          <!-- /Logo und "DIVISION Network"-Schriftzug -->
          </div>
          <form class="navbar-form navbar-left hidden-xs" id="header-search-form">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Suchen nach...">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
            </div>
          </form>
          <div id="navbar" class="collapse navbar-collapse nav navbar-nav navbar-right" id="header-nav">
            <ul class="nav navbar-nav">
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="index.php">Startseite</a></li>
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="signup.php">Registrieren</a></li>
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="login.php">Anmelden</a></li>
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="index.php">Über</a></li>
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="index.php">F.A.Q</a></li>
              <li class="header-nav-li hidden-lg hidden-md hidden-sm"><a href="index.php">Impressum</a></li>
              <li class="header-nav-li hidden-xs"><a href="index.php">Startseite</a></li>
              <li class="header-nav-li hidden-md hidden-sm hidden-xs"><a href="about.php">DIVISION Network</a></li>
              <li class="header-nav-li hidden-xs"><a href="signup.php">Registrieren</a></li>
              <li class="header-nav-li hidden-xs"><a href="login.php">Anmelden</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
<?php endif ?>
