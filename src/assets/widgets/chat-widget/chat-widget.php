<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
<script type="text/javascript" src="./src/assets/widgets/chat-widget/chat-widget.js"></script>
<script> var username = "<?php echo $_SESSION["username"]?>"; </script>

<?php include_once("./src/php/login-system/members-script.php") ?>

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

    <div id="test"></div>

    <div id="chat-sidebar-online">Online (3)</div>
    <?php foreach ($members AS $member): ?>
      <div class="sidebar-name" onclick="getMessages(<?php echo $member['username'] ?>, <?php echo $_SESSION['username'] ?>)">
          <a class="chat-ident-form-link" href="javascript:register_popup('<?php echo $member['username'] ?>', '<?php echo $member['username'] ?>');">
             <img class="img-circle chat-sidebar-user-avatar" src="<?php echo $member["avatar"]; ?>" />
             <span><?php echo $member['username'] ?></span>
          </a>
       </div>
    <?php endforeach; ?>
    <div id="chat-sidebar-offline">Offline (3)</div>
    <?php foreach ($members AS $member): ?>
      <div class="sidebar-name" onclick="getMessages(<?php echo $member['username'] ?>, username)">
        <a href="javascript:register_popup('<?php echo $member['username'] ?>', '<?php echo $member['username'] ?>');">
           <img class="img-circle chat-sidebar-user-avatar" src="<?php echo $member["avatar"]; ?>" />
           <span><?php echo $member['username'] ?></span>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</aside>

<?php endif ?>

<script>

</script>
