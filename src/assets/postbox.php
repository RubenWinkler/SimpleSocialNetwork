<!-- postbox.js wird eingebunden -->
<script type="text/javascript" src="./../src/js/postbox.js"></script>
<!-- Wenn der Benutzer eingeloggt ist, wird die Postbox angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
  <div class="container-fluid" id="post_box">
    <form action="" method="post">
      <input type="hidden" name="hidden_id" value="<?php if (isset($id)) { echo $id; } ?>">
      <input type="hidden" name="token" value="<?php if (function_exists('_token')) { echo _token(); } ?>">
      <div class="row">
        <div class="col-sm-12 hidden-xs">
          <div id="post_box_avatar_cell">
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded" id="post_box_avatar">
          </div>
          <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
          <div id="textpost_textarea_container">
            <div class="form-group">
              <label for="textpost_textarea" class="sr-only">Eingabefeld für Posts</label>
              <textarea class="form-control" name="Post-Text" id="textpost_textarea" placeholder="Post"></textarea>
            </div>
          </div>
        </div>
        <div class="hidden-lg hidden-md hidden-sm col-xs-12">
          <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
          <div id="textpost_textarea_container_mobile">
            <div class="form-group">
              <label for="textpost_textarea" class="sr-only">Eingabefeld für Posts</label>
              <textarea class="form-control" name="Post-Text" id="textpost_textarea_mobile" placeholder="Post"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="hidden-xs" id="select_post_content_and_post_button">
            <span id="postbox_buttons_container">
              <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            </span>
            <button class="btn btn-default" name ="post_box_posten_button" id="post_box_posten_button" type="submit">Posten</button>
          </div>
          <div class="hidden-lg hidden-md hidden-sm" id="select_post_content_and_post_button_mobile">
            <span id="postbox_buttons_container_mobile">
              <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            </span>
            <button class="btn btn-default" name ="post_box_posten_button" id="post_box_posten_button" type="submit">Posten</button>
          </div>
        </div>
      </div>
    </form>
  </div>
<?php endif ?>
