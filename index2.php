<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <!-- Die folgenden 3 Meta-Tags müssen als erste im Header erscheinen. Alles andere im Header muss nach diesen Meta-Tags kommen! -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- DIVISION Network Meta -->
  <title><?php if (isset($page_title)) {echo $page_title;} else {echo "DIVISION Network";} ?></title>
  <meta name="description" content="Social Network und YouTube-Blog">
  <meta name="author" content="DIVISION Network">
  <!-- jQuery -->
  <script src="./src/js/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./src/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./src/css/font-awesome/css/font-awesome.min.css">
  <!-- Sweetalert -->
  <script src="./src/js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./src/css/sweetalert.css">
  <!-- DIVISION Network Stylesheet -->
  <link rel="stylesheet" htype="text/css" href="./src/css/styles.css">
  <!-- DIVISION Network Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="./src/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./src/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./src/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./src/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./src/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./src/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./src/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./src/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./src/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="./src/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./src/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./src/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./src/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>

<!-- BODY ================================================== -->

<body class="container-fluid" id="body">

<!-- NAVIGATION ================================================== -->

  <?php include_once("./src/php/login-system/utilities-script.php"); ?>
  <?php include_once("./src/php/login-system/profile-script.php"); ?>


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
            <a class="navbar-brand" id="header-logo" href="index.php">
              <img alt="DIVISION Network" src="./src/img/header-logo.png">
            </a>
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
              <a class="navbar-brand" id="header-logo" href="index.php">
                <img alt="DIVISION Network" src="./src/img/header-logo.png">
              </a>
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

<!-- LEFT-SIDEBAR ================================================== -->

<aside class="col-lg-2 hidden-md hidden-sm hidden-xs" id="left-sidebar-col">
</aside>

<!-- MAIN ================================================== -->

<main class="container-fluid" id="content">
  <div class="row" id="content-row">

<!-- CHRONIK ================================================== -->
<div class="col-md-6 col-sm-8 col-xs-12" id="chronik">

  <?php
  include_once("./src/php/post-system/post-utilities-script.php");
  include_once("./src/php/post-system/posten-script.php");
  include_once("./src/php/post-system/delete-post-script.php");
  ?>

<!-- POSTBOX ================================================== -->

<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
<div class="container-fluid" id="post-box">
  <div>
    <?php if (isset($result)) {echo $result;} ?>
    <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
    <?php if (isset($result)) {echo '</div>';} ?>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="hidden-id" value="<?php if (function_exists('encodeUserID')) { echo encodeUserID(); } ?>">
    <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
    <div class="row">
      <!-- Post-Inputs für Desktop -->
      <div class="col-sm-12 hidden-xs">
        <div id="post-box-avatar-cell">
          <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./avatar-uploads/{$_SESSION['username']}.jpg")) { echo "./avatar-uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded" id="post-box-avatar">
        </div>
        <span id="whats-new-text-span"><h4 id="whats-new-text">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
        <div id="textpost-textarea-container">
          <div class="form-group">
            <label for="textpost-textarea" class="sr-only">Eingabefeld für Posts</label>
            <textarea class="form-control" name="Posttext" id="textpost-textarea" placeholder="Schreibe etwas..."></textarea>
            <input type="hidden" name="post-category" value="text">
          </div>
        </div>
      </div>
      <!-- Ende: Post-Inputs für Desktop -->
      <!-- Post-Inputs für Mobile -->
      <div class="hidden-lg hidden-md hidden-sm col-xs-12">
        <span id="whats-new-text-span-mobile"><h4 id="whats-new-text-mobile">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
        <div id="textpost-textarea-container-mobile">
          <div class="form-group">
            <label for="textpost-textarea-mobile" class="sr-only">Eingabefeld für Posts</label>
            <textarea class="form-control" name="Posttext-mobile" id="textpost-textarea-mobile" placeholder="Schreibe etwas..."></textarea>
            <input type="hidden" name="post-category" value="text">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="hidden-xs" id="select-post-content-and-post-button">
          <span id="postbox-buttons-container">
            <button class="btn btn-default select-post-content-buttons" id="post-box-video-button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select-post-content-buttons" id="post-box-photo-button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select-post-content-buttons" id="post-box-link-button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
          </span>
          <button class="btn btn-default" name ="post-box-posten-button" id="post-box-posten-button" type="submit">Posten</button>
        </div>
        <div class="hidden-lg hidden-md hidden-sm" id="select-post-content-and-post-button-mobile">
          <span id="postbox-buttons-container-mobile">
            <button class="btn btn-default select-post-content-buttons" id="post-box-video-button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select-post-content-buttons" id="post-box-photo-button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select-post-content-buttons" id="post-box-link-button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
          </span>
          <button class="btn btn-default" name ="post-box-posten-button-mobile" id="post-box-posten-button" type="submit">Posten</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php endif ?>

<!-- FILTER-WELL ================================================== -->

<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
<div class="container-fluid" id="chronik-filter-button-container">
  <div class="col-xs-12" id="chronik-filter-button-cell">
    <a class="btn btn-default btn-xs" id="chronik-filter-button" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Sortieren nach: <span class="caret"></span>
    </a>
    <div class="collapse" id="collapseExample">
      <div class="well" id="filter-optionen-well">
        <form>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Gaming</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Vlog</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Lifestyle</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Beauty</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Essen & Trinken</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Game</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif ?>

<!-- POSTS-SECTION ================================================== -->

<div class="posts">
  <?php include_once("./src/php/post-system/delete-post-script.php"); ?>
  <?php include_once("./src/php/post-system/generate-posts-script.php"); ?>
</div>

<!-- /MAIN ================================================== -->
</main>

<!-- RIGHT-SIDEBAR ================================================== -->

<div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right-sidebar-col">

<!-- LOGIN-WIDGET ================================================== -->
<?php if (!isset($_SESSION["username"])): ?>
<div id="login-widget-container">
  <div class="form-group">
    <form method="post" action="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <label for="login-username" class="sr-only">Benutzername:</label>
              <input type="text" class="form-control" id="login-username" name="Benutzername" placeholder="Benutzername">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="login-password" class="sr-only">Passwort:</label>
              <input type="password" class="form-control" id="login-password" name="Passwort" placeholder="Passwort">
              <div id="forgot-password-cell">
                <a href="password-recovery.php" id="forgot-password-text">Passwort vergessen?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="checkbox" id="remember-me-checkbox-container">
              <div class="pull-right">
                <label class="pull"><input class="" type="checkbox" value="yes" name="remember">Angemeldet bleiben</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login-or-signup">
              <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
              <button type="submit" href="index.php" class="btn btn-danger pull-center" id="login-button" name="login-button">Anmelden</button>
              <div id="or-between-login-and-signup">oder</div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="login-or-signup">
            <a href="signup.php">
              <button class="btn btn-default pull-center" id="go-to-signup-button">Registrieren</button>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <?php if (isset($result)) {echo $result;} ?>
          <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
          <?php if (isset($result)) {echo '</div>';} ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>

<!-- SIDEBAR-NAVIGATION ================================================== -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
    <ul class="list-group" id="social-nav">
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">3</span><a href="members.php" class="right-sidebar-nav-text">Mitglieder</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">3</span><a href="index.php" class="right-sidebar-nav-text">Nachrichten</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">5</span><a href="index.php" class="right-sidebar-nav-text">Benachrichtigungen</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">7</span><a href="index.php" class="right-sidebar-nav-text">Folge ich</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">2</span><a href="index.php" class="right-sidebar-nav-text">Gruppen</a></li>
    </ul>
<?php endif ?>
</div>

<!-- CHAT-SIDEBAR ================================================== -->

<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>

<aside class="col-md-2 hidden-sm hidden-xs" id="chat-sidebar-col">
  <div id="chat-sidebar">
    <form>
      <div class="input-group" id="chat-sidebar-search">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" id="chat-sidebar-search-button"><i class="glyphicon glyphicon-search"></i></button>
        </span>
        <input type="text" class="form-control" id="chat-sidebar-search-input" placeholder="Suchen...">
      </div>
    </form>
    <div id="chat-sidebar-online">Online (3)</div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('ruben', 'RUBEN');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>RUBEN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('jan', 'JAN');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>JAN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('chris', 'CHRIS');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>CHRIS</span>
        </a>
    </div>
    <div id="chat-sidebar-offline">Offline (3)</div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('ruben', 'RUBEN');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>RUBEN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('jan', 'JAN');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>JAN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register-popup('chris', 'CHRIS');">
            <img class="img-circle chat-sidebar-user-avatar" src="./src/img/Profilbild.jpg" />
            <span>CHRIS</span>
        </a>
    </div>
  </div>
</aside>
<?php endif ?>

<!-- FOOTER ================================================== -->
<footer>
  <script src="./src/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./src/js/header-active-highlighting.js"></script>
  <script type="text/javascript" src="./src/js/postbox.js"></script>
  <script type="text/javascript" src="./src/assets/widgets/chat_widget/chat-widget.js"></script>
</footer>

</body>
</html>
