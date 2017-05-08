<!-- Wenn der Benutzer eingeloggt ist oder der "Remember me"-Cookie gültig ist, wird das Social-Nav-Widget angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
    <ul class="list-group" id="social_nav">
      <li class="list-group-item right_sidebar_nav_li"><span class="badge">3</span><a href="members.php" class="right_sidebar_nav_text">Mitglieder</a></li>
      <li class="list-group-item right_sidebar_nav_li"><span class="badge">3</span><a href="index.php" class="right_sidebar_nav_text">Nachrichten</a></li>
      <li class="list-group-item right_sidebar_nav_li"><span class="badge">5</span><a href="index.php" class="right_sidebar_nav_text">Benachrichtigungen</a></li>
      <li class="list-group-item right_sidebar_nav_li"><span class="badge">7</span><a href="index.php" class="right_sidebar_nav_text">Folge ich</a></li>
      <li class="list-group-item right_sidebar_nav_li"><span class="badge">2</span><a href="index.php" class="right_sidebar_nav_text">Gruppen</a></li>
    </ul>
<?php endif ?>
