<?php
include_once("./src/php/post-system/post-utilities-script.php");
include_once("./src/php/post-system/posten-script.php");
include_once("./src/php/post-system/delete-post-script.php"); ?>
<!-- Wenn der Benutzer eingeloggt ist, wird die Postbox angezeigt. -->
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
        <!-- Ende: Post-Inputs für Mobile -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- select-post-content-buttons für Desktop -->
          <div class="hidden-xs" id="select-post-content-and-post-button">
            <span id="postbox-buttons-container">
              <button class="btn btn-default select-post-content-buttons" id="post-box-video-button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select-post-content-buttons" id="post-box-photo-button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select-post-content-buttons" id="post-box-link-button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            </span>
            <button class="btn btn-default" name ="post-box-posten-button" id="post-box-posten-button" type="submit">Posten</button>
          </div>
          <!-- Ende: select-post-content-buttons für Desktop -->
          <!-- select-post-content-buttons für Mobile -->
          <div class="hidden-lg hidden-md hidden-sm" id="select-post-content-and-post-button-mobile">
            <span id="postbox-buttons-container-mobile">
              <button class="btn btn-default select-post-content-buttons" id="post-box-video-button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select-post-content-buttons" id="post-box-photo-button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
              <button class="btn btn-default select-post-content-buttons" id="post-box-link-button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            </span>
            <button class="btn btn-default" name ="post-box-posten-button-mobile" id="post-box-posten-button" type="submit">Posten</button>
          </div>
          <!-- Ende: select-post-content-buttons für Mobile -->
        </div>
      </div>
    </form>
  </div>
<?php endif ?>
