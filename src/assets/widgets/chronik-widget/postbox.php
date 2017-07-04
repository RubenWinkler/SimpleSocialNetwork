<?php
include_once("./src/php/post-system/post-utilities-script.php");
if (isset($_SESSION["username"]) || isCookieValid($db)):
include_once("./src/php/post-system/posten-script.php");
include_once("./src/php/post-system/delete-post-script.php"); ?>

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
            </div>
          </div>
        </div>
      </div>
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
        </div>
      </div>
    </form>
  </div>
</section>

<script type="text/javascript" src="./src/js/postbox.js"></script>

<?php endif ?>
