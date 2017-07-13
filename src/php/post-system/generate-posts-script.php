<?php

try {

  $get_posts_query = "SELECT * FROM posts ORDER BY id DESC";

  $get_posts_statement = $db->prepare($get_posts_query);

  $get_posts_statement->execute();

  foreach ($get_posts_statement AS $single_post) {

    $post_id = $single_post["id"];
    $user_id = $single_post["user_id"];
    $post_type = $single_post["post_type"];
    $text = $single_post["post_text"];
    $posted_at = translateDateToGerman(strftime("%d. %B %Y um %H:%I Uhr", strtotime($single_post["posted_at"])));

    $get_user_query = "SELECT * FROM users WHERE id = :user_id LIMIT 1";

    $get_user_statement = $db->prepare($get_user_query);

    $get_user_statement->execute(array(":user_id" => $user_id));

    if ($user = $get_user_statement->fetch()) {

      $username = $user["username"];

      $avatar = $user["avatar"];

      $alphanumToken = _alphanumToken();

      $post_id = encodeAnything($post_id);

      $post_user_id = encodeAnything($user_id);

      if (isset($_SESSION["id"])) {

        $current_user_id = encodeUserID();

      } else {

        $current_user_id = NULL;

      }

      $securityToken = _securityToken();

    }

    if ($post_type === "text") {

      $post = '<article class="posts box-with-padding">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12 no-padding">';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="dropdown pull-right">
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
                          <button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                        </span>
                      </form>
                      </li>
                      <li><button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</button></li>
                    </ul>
                  </div>';
      }

      $post .= '<img src="'.$avatar.'" class="img-rounded post-avatar">
                <h4 class="posted-by-username">'.$username.'</h4>
                <h5 class="posted-at-text">'.$posted_at.'</h5><br />
              </div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 post-text no-padding">'.$text.'</div>
            </div>';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="row post-interaction-row">
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
        </div>';

      }

      $post .= '</div></article>';

      echo $post;

    } elseif ($post_type === "video") {

      $youtube_link = $single_post["youtube_link"];

      $post = '<article class="posts box-with-padding">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12 no-padding">';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="dropdown pull-right">
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
                          <button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                        </span>
                      </form>
                      </li>
                      <li><button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</button></li>
                    </ul>
                  </div>';
      }

      $post .= '<img src="'.$avatar.'" class="img-rounded post-avatar">
                <h4 class="posted-by-username">'.$username.'</h4>
                <h5 class="posted-at-text">'.$posted_at.'</h5><br />
              </div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 post-text no-padding">'.$text.'</div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 no-padding">
                <div class="post-video-container-container">
                  <div class="post-video-container">
                      <iframe frameBorder="0" src="'.$youtube_link.'" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </div>';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="row post-interaction-row">
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
        </div>';

      }

      $post .= '</div></article>';

      echo $post;

    } elseif ($post_type === "link") {

      $link = $single_post["link"];

      $post = '<article class="posts box-with-padding">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12 no-padding">';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="dropdown pull-right">
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
                          <button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                        </span>
                      </form>
                      </li>
                      <li><button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</button></li>
                    </ul>
                  </div>';
      }

      $post .= '<img src="'.$avatar.'" class="img-rounded post-avatar">
                <h4 class="posted-by-username">'.$username.'</h4>
                <h5 class="posted-at-text">'.$posted_at.'</h5><br />
              </div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 post-text no-padding">'.$text.'</div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 no-padding">
                <a class="btn btn-default post-link" href="'.$link.'" target="_blank"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i> '.$link.'</a>
              </div>
            </div>';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="row post-interaction-row">
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
        </div>';

      }

      $post .= '</div></article>';

      echo $post;

    } else {

      $image_name = $single_post["image_directory"];

      $image_directory_path = "./image-uploads/{$image_name}.jpg";

      $post = '<article class="posts box-with-padding">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12 no-padding">';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="dropdown pull-right">
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
                          <button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</button>
                        </span>
                      </form>
                      </li>
                      <li><button type="submit" class="form-control post-meta-dropdown-button" name="delete-post"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</button></li>
                    </ul>
                  </div>';
      }

      $post .= '<img src="'.$avatar.'" class="img-rounded post-avatar">
                <h4 class="posted-by-username">'.$username.'</h4>
                <h5 class="posted-at-text">'.$posted_at.'</h5><br />
              </div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 post-text no-padding">'.$text.'</div>
            </div>
            <div class="row post-row">
              <div class="col-xs-12 no-padding">
                <img src="'.$image_directory_path.'" class="posted-image">
              </div>
            </div>';

      if (isset($_SESSION["username"]) || isCookieValid($db)) {

        $post .= '<div class="row post-interaction-row">
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
        </div>';

      }

      $post .= '</div></article>';

      echo $post;

    }

  }

} catch (PDOException $ex) {

  $result = "<script type=\"text/javascript\">
                  swal({
                  title: \"Datenbank?! Wo bist du?\",
                  text: \"Oha... unsere Datenbank scheint gerade andersweitig beschäftigt zu sein, tut uns leid! Versuch es einfach später noch einmal!\",
                  type: \"error\"
                  });
                  </script>";

}
