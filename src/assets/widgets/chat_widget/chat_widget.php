<!-- Wenn der Benutzer eingeloggt ist oder der "Remember me"-Cookie gültig ist, wird das Chat-Widget angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
  <!-- Chat.js wird eingebunden -->
  <script type="text/javascript" src="./../src/assets/widgets/chat_widget/chat_widget.js"></script>

  <div class="col-md-2 hidden-sm hidden-xs" id="chat_sidebar_col">
    <div id="chat_sidebar">
      <form>
        <div class="input-group" id="chat_sidebar_search">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="chat_sidebar_search_button"><i class="glyphicon glyphicon-search"></i></button>
          </span>
          <input type="text" class="form-control" id="chat_sidebar_search_input" placeholder="Suchen...">
        </div>
      </form>
      <div id="chat_sidebar_online">Online (3)</div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('ruben', 'RUBEN');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>RUBEN</span>
          </a>
      </div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('jan', 'JAN');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>JAN</span>
          </a>
      </div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('chris', 'CHRIS');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>CHRIS</span>
          </a>
      </div>
      <div id="chat_sidebar_offline">Offline (3)</div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('ruben', 'RUBEN');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>RUBEN</span>
          </a>
      </div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('jan', 'JAN');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>JAN</span>
          </a>
      </div>
      <div class="sidebar_name">
          <a href="javascript:register_popup('chris', 'CHRIS');">
              <img class="img-circle chat_sidebar_user_avatar" src="./../src/img/Profilbild.jpg" />
              <span>CHRIS</span>
          </a>
      </div>
    </div>
  </div>
<?php endif ?>
