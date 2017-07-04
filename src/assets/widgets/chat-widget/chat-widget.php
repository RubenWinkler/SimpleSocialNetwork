<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
<script type="text/javascript" src="./src/assets/widgets/chat-widget/chat-widget.js"></script>

<aside class="col-lg-2 col-md-2 hidden-sm hidden-xs" id="chat-sidebar-col">
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
        <a href="javascript:register_popup('ruben', 'RUBEN');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>RUBEN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register_popup('jan', 'JAN');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>JAN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register_popup('chris', 'CHRIS');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>CHRIS</span>
        </a>
    </div>
    <div id="chat-sidebar-offline">Offline (3)</div>
    <div class="sidebar-name">
        <a href="javascript:register_popup('ruben', 'RUBEN');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>RUBEN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register_popup('jan', 'JAN');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>JAN</span>
        </a>
    </div>
    <div class="sidebar-name">
        <a href="javascript:register_popup('chris', 'CHRIS');">
            <img class="img-circle chat-sidebar-user-avatar" src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists('./avatar-uploads/{$_SESSION["username"]}.jpg')) { echo './avatar-uploads/{$_SESSION["username"]}.jpg'; } ?>" />
            <span>CHRIS</span>
        </a>
    </div>
  </div>
</aside>

<?php endif ?>
