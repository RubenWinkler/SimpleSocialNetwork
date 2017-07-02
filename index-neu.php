<?php
include_once("./src/php/login-system/session-script.php");
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once("./src/php/login-system/profile-script.php");
include_once("./src/php/post-system/post-utilities-script.php");
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
  <link rel="stylesheet" htype="text/css" href="./src/css/styles-neu.css">
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

<body>

<!-- HEADER-NAVIGATION ================================================== -->

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
        <a class="navbar-brand" href="index-neu.php">SimpleSocialNetwork</a>
      </div><!-- /.navbar-header -->
      <div class="collapse navbar-collapse">
        <form class="navbar-form navbar-left" id="header-navigation-search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Suchen nach...">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div><!-- /.input-group-btn -->
          </div><!-- /.input-group -->
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index-neu.php">Startseite</a></li>
          <li>
            <a href="profile.php" id="user">
              <img class="img-rounded hidden-xs" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" id="header-navigation-avatar">
              <span id="username"><?php if (isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?></span>
            </a>
          </li>
          <li><a href="notifications.php"><i class="header-fa-icons fa fa-globe fa-lg"></i></a></li>
          <li><a href="einstellungen.php"><i class="header-fa-icons fa fa-cog fa-lg"></i></a></li>
          <li><a href="logout.php">Abmelden</a></li>
         </ul>
       </div><!-- /.collapse navbar-collapse -->
     </div><!-- /.container -->
   </nav>
</header>

<div class="container-fluid content">
  <div class="row content-row">

<!-- LEFT-SIDEBAR ================================================== -->

    <aside class="left-sidebar col-lg-2 hidden-md hidden-sm hidden-xs">
    </aside>

<!-- CHRONIK ================================================== -->

    <main class="chronik col-lg-6 col-md-8 col-sm-9 col-xs-12">

<!-- POSTBOX ================================================== -->

      <section class="postbox">
        <div class="container-fluid box-with-padding" id="postbox">

          <form method="post" action="" enctype="multipart/form-data">

            <div class="row">
              <div class="col-sm-12">

                  <span><h4 id="whats-new-text">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
                  <div id="postbox-textarea">
                    <div class="form-group">
                      <label for="textpost-textarea" class="sr-only">Eingabefeld für Posts</label>
                      <textarea class="form-control" name="Posttext" id="expanding-textarea" placeholder="Schreibe etwas..."></textarea>
                      <input type="hidden" name="post-category" value="text">
                    </div><!-- /.form-group -->
                  </div>

              </div><!-- /.col-sm-12 hidden-xs -->
            </div><!-- /.row -->

            <div class="row">
              <div class="col-xs-12">

                <span id="postbox-button-area">
                  <button class="btn btn-default" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default" onclick="change_postbox('image');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
                </span>

                <input type="hidden" name="hidden-id" value="<?php if (function_exists('encodeUserID')) { echo encodeUserID(); } ?>">
                <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
                <button type="submit" class="btn btn-default pull-right" name="post-box-posten-button">Posten</button>

              </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->

          </form>

        </div><!-- /#postbox -->
      </section>

<!-- FILTER-WELL ================================================== -->

      <section class="filter-well">
      </section>

<!-- POSTS ================================================== -->

      <article class="posts box-with-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 no-padding">
              <!-- POST ACTIONS DROPDOWN ================================================== -->
              <div class="dropdown pull-right">
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post-options-symbol" aria-hidden="true"></i></button>
                <ul class="dropdown-menu">
                  <li>
                  <form action="" method="post">
                    <span class="form-group">
                      <input type="hidden" name="post-id" value="'.$post_id.'">
                      <input type="hidden" name="post-user-id" value="'.$post_user_id.'">
                      <input type="hidden" name="current-user-id" value="'.$current_user_id.'">
                      <input type="hidden" name="securityToken" value="'.$securityToken.'">
                      <label for="delete-post" class="sr-only">Post löschen</label>
                      <button type="submit" class="form-control delete-post-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                    </span>
                  </form>
                  </li>
                  <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                </ul>
              </div>
              <!-- POST HEADER ================================================== -->
              <img src="avatar-uploads/RUBEN.jpg" class="img-rounded post-avatar">
              <h4 class="posted-by-username">RUBEN</h4>
              <h5 class="posted-at-text">14. Mai 2017</h5><br />
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 post-text no-padding">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
          </div>
          <div class="row post-interaction-row">
            <a class="btn btn-default btn-sm comment-btn" role="button" data-toggle="collapse" href="#'.$alphanumToken.'" aria-expanded="false" aria-controls="'.$alphanumToken.'">
            Kommentieren (3)
            </a>
            <button type="button" class="btn btn-default btn-sm like-button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
            <button type="button" class="btn btn-default btn-sm dislike-button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              <form class="collapse collapse-write-comment" id="'.$alphanumToken.'">
                <div class="form-group">
                  <label for="textpost-textarea" class="sr-only">Eingabefeld für Kommentar zum Post</label>
                  <textarea class="form-control" name="Post-Text" id="textpost-textarea-mobile" placeholder="Kommentieren..."></textarea>
                </div>
              </form>
          </div>
        </div>
      </article>

      <article class="posts box-with-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 no-padding">
              <!-- POST ACTIONS DROPDOWN ================================================== -->
              <div class="dropdown pull-right">
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post-options-symbol" aria-hidden="true"></i></button>
                <ul class="dropdown-menu">
                  <li>
                  <form action="" method="post">
                    <span class="form-group">
                      <input type="hidden" name="post-id" value="'.$post_id.'">
                      <input type="hidden" name="post-user-id" value="'.$post_user_id.'">
                      <input type="hidden" name="current-user-id" value="'.$current_user_id.'">
                      <input type="hidden" name="securityToken" value="'.$securityToken.'">
                      <label for="delete-post" class="sr-only">Post löschen</label>
                      <button type="submit" class="form-control delete-post-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                    </span>
                  </form>
                  </li>
                  <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                </ul>
              </div>
              <!-- POST HEADER ================================================== -->
              <img src="avatar-uploads/RUBEN.jpg" class="img-rounded post-avatar">
              <h4 class="posted-by-username">RUBEN</h4>
              <h5 class="posted-at-text">14. Mai 2017</h5><br />
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 post-text no-padding">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
          </div>
          <div class="row post-interaction-row">
            <a class="btn btn-default btn-sm comment-btn" role="button" data-toggle="collapse" href="#'.$alphanumToken.'" aria-expanded="false" aria-controls="'.$alphanumToken.'">
            Kommentieren (3)
            </a>
            <button type="button" class="btn btn-default btn-sm like-button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
            <button type="button" class="btn btn-default btn-sm dislike-button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              <form class="collapse collapse-write-comment" id="'.$alphanumToken.'">
                <div class="form-group">
                  <label for="textpost-textarea" class="sr-only">Eingabefeld für Kommentar zum Post</label>
                  <textarea class="form-control" name="Post-Text" id="textpost-textarea-mobile" placeholder="Kommentieren..."></textarea>
                </div>
              </form>
          </div>
        </div>
      </article>

    </main><!-- /.chronik -->

<!-- RIGHT-SIDEBAR ================================================== -->

    <aside class="right-sidebar col-lg-2 hidden-xs col-md-3">
        right-sidebar
    </aside>

<!-- RIGHT-SIDEBAR ================================================== -->

    <aside class="chat-sidebar col-lg-2 hidden-md">
        chat-sidebar
    </aside>

  </div><!-- /.row -->
</div><!-- /.container -->

<!-- FOOTER ================================================== -->

<footer>
  <script src="./src/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./src/js/header-active-highlighting.js"></script>
  <script type="text/javascript" src="./src/js/postbox.js"></script>
  <script type="text/javascript" src="./src/assets/widgets/chat_widget/chat-widget.js"></script>
</footer>

</body>
</html>
