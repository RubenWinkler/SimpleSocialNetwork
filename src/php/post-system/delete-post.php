<?php

if (isset($_POST["delete-post"]) && isset($_POST["securityToken"])) {

  $decoded_post_user_id = decodeAnything($_POST["post_user_id"]);

  $decoded_current_user_id = decodeUserID($_POST["current_user_id"]);

  $decoded_post_id = decodeAnything($_POST["post_id"]);

  if ($decoded_post_user_id === $decoded_current_user_id) {

    try {

      $db->exec("DELETE FROM posts WHERE id = $decoded_post_id LIMIT 1");

    } catch (PDOException $ex) {

    }

  } else {

    $result = "<script type='text/javascript'>swal('Error', 'Du hast nicht die Berechtigung diesen Post zu löschen.', 'error');</script>";

  }

}

 ?>
