<!-- Wenn der Benutzer eingeloggt ist oder der "Remember me"-Cookie gültig ist, wird das Social-Nav-Widget angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
    <ul class="list-group" id="social-nav">
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">3</span><a href="members.php" class="right-sidebar-nav-text">Mitglieder</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">3</span><a href="index.php" class="right-sidebar-nav-text">Nachrichten</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">5</span><a href="index.php" class="right-sidebar-nav-text">Benachrichtigungen</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">7</span><a href="index.php" class="right-sidebar-nav-text">Folge ich</a></li>
      <li class="list-group-item right-sidebar-nav-li"><span class="badge">2</span><a href="index.php" class="right-sidebar-nav-text">Gruppen</a></li>
    </ul>
<?php endif ?>
