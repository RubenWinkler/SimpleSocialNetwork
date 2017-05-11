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
    $posted_at = strftime("%d. %B %Y um %H:%I Uhr", strtotime($single_post["posted_at"]));

    $get_user_query = "SELECT * FROM users WHERE id = :user_id LIMIT 1";

    $get_user_statement = $db->prepare($get_user_query);

    $get_user_statement->execute(array(":user_id" => $user_id));

    if ($user = $get_user_statement->fetch()) {

      $username = $user["username"];

      $user_avatar = "avatar-uploads/{$username}.jpg";

      $default_avatar = "avatar-uploads/default-avatar.jpg";

      if (file_exists($user_avatar)) {

        $avatar = $user_avatar;

      } else {

        $avatar = $default_avatar;

      }

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

      $post = '<div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <img src="'.$avatar.'" class="img-rounded">
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
                    <h4 class="posted-by-username">'.$username.'</h4>
                    <h5 class="posted-at-text">'.$posted_at.'</h5><br />
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 post-text">'.$text.'</div>
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
              </div>';

      echo $post;

    } elseif ($post_type === "video") {

      $youtube_link = $single_post["youtube_link"];

      $post = '<div class="container-fluid post">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="post-avatar-cell">
                      <img src="'.$avatar.'" class="img-rounded post-user-avatar">
                    </div>
                    <div class="dropdown pull-right">
                      <button class="btn btn-default dropdown-toggle btn-xs post-options-btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post-options-symbol" aria-hidden="true"></i></button>
                      <ul class="dropdown-menu post-options-dropdown">
                        <li>
                        <form method="post" action="">
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
                    <h4 class="posted-by-username">'.$username.'</h4>
                    <h5 class="posted-at-text">'.$posted_at.'</h5><br />
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 post-text">'.$text.'</div>
                </div>
                <div class="video-container-container">
                  <div class="video-container">
                    <iframe frameBorder="0" src="'.$youtube_link.'" allowfullscreen></iframe>
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
                      <label for="textpost-textarea" class="sr-only">Eingabefeld für Posts</label>
                      <textarea class="form-control" name="Post-Text" id="textpost-textarea-mobile" placeholder="Kommentieren"></textarea>
                    </div>
                  </form>
                </div>
              </div>';

      echo $post;

    } elseif ($post_type === "link") {

      $link = $single_post["link"];

      $post = '<div class="container-fluid post">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="post-avatar-cell">
                      <img src="'.$avatar.'" class="img-rounded post-user-avatar">
                    </div>
                    <div class="dropdown pull-right">
                      <button class="btn btn-default dropdown-toggle btn-xs post-options-btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post-options-symbol" aria-hidden="true"></i></button>
                      <ul class="dropdown-menu post-options-dropdown">
                        <li>
                        <form method="post" action="">
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
                    <h4 class="posted-by-username">'.$username.'</h4>
                    <h5 class="posted-at-text">'.$posted_at.'</h5><br />
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 post-text">'.$text.'</div>
                </div>
                  <a class="btn btn-default comment-btn" href="'.$link.'" target="-blank"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i>'." ".$link.'</a>
                <div class="row post-interaction-row">
                <a class="btn btn-default btn-sm comment-btn" role="button" data-toggle="collapse" href="#'.$alphanumToken.'" aria-expanded="false" aria-controls="'.$alphanumToken.'">
                Kommentieren (3)
                </a>
                <button type="button" class="btn btn-default btn-sm like-button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike-button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
                  <form class="collapse collapse-write-comment" id="'.$alphanumToken.'">
                    <div class="form-group">
                      <label for="textpost-textarea" class="sr-only">Eingabefeld für Posts</label>
                      <textarea class="form-control" name="Post-Text" id="textpost-textarea-mobile" placeholder="Kommentieren..."></textarea>
                    </div>
                  </form>
                </div>
              </div>';

      echo $post;

    } else {

      $image_name = $single_post["image_directory"];

      $image_directory_path = "./image-uploads/{$image_name}.jpg";

      $post = '<div class="container-fluid post">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="post-avatar-cell">
                      <img src="'.$avatar.'" class="img-rounded post-user-avatar">
                    </div>
                    <div class="dropdown pull-right">
                      <button class="btn btn-default dropdown-toggle btn-xs post-options-btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post-options-symbol" aria-hidden="true"></i></button>
                      <ul class="dropdown-menu post-options-dropdown">
                        <li>
                        <form method="post" action="">
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
                    <h4 class="posted-by-username">'.$username.'</h4>
                    <h5 class="posted-at-text">'.$posted_at.'</h5><br />
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 post-text">'.$text.'</div>
                </div>
                  <img src="'.$image_directory_path.'" class="posted-image">
                <div class="row post-interaction-row">
                <a class="btn btn-default btn-sm comment-btn" role="button" data-toggle="collapse" href="#'.$alphanumToken.'" aria-expanded="false" aria-controls="'.$alphanumToken.'">
                Kommentieren (3)
                </a>
                <button type="button" class="btn btn-default btn-sm like-button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike-button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
                  <form class="collapse collapse-write-comment" id="'.$alphanumToken.'">
                    <div class="form-group">
                      <label for="textpost-textarea" class="sr-only">Eingabefeld für Posts</label>
                      <textarea class="form-control" name="Post-Text" id="textpost-textarea-mobile" placeholder="Kommentieren..."></textarea>
                    </div>
                  </form>
                </div>
              </div>';

      echo $post;

    }

  }

} catch (PDOException $ex) {

  $result = flashMessage("Es können keine Posts generiert werden: " . $ex->getMessage());

}