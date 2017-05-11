<!-- Wenn der Benutzer eingeloggt ist oder der "Remember me"-Cookie gültig ist, wird das Chat-Widget angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
  <!-- Chat.js wird eingebunden -->
  <script type="text/javascript" src="./src/assets/widgets/chat_widget/chat-widget.js"></script>

  <div class="col-md-2 hidden-sm hidden-xs" id="chat-sidebar-col">
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
  </div>
<?php endif ?>
