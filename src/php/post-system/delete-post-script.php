<?php

if (isset($_POST["delete-post"]) && isset($_POST["securityToken"])) {

  $decoded_post_user_id = decodeAnything($_POST["post-user-id"]);

  $decoded_current_user_id = decodeUserID($_POST["current-user-id"]);

  $decoded_post_id = decodeAnything($_POST["post-id"]);

  if ($decoded_post_user_id === $decoded_current_user_id) {

    try {

      $db->exec("DELETE FROM posts WHERE id = $decoded_post_id LIMIT 1");

    } catch (PDOException $ex) {

      $result = "<script type=\"text/javascript\">
                      swal({
                      title: \"Datenbank?! Wo bist du?\",
                      text: \"Oha... unsere Datenbank scheint gerade andersweitig beschäftigt zu sein, tut uns leid! Versuch es einfach noch einmal!\",
                      type: \"error\"
                      });
                      </script>";
    }

  } else {

    $result = "<script type=\"text/javascript\">
                    swal({
                    title: \"Nope! Nicht dein Post!\",
                    text: \"Tut uns leid, aber das scheint nicht dein eigener Post zu sein. Solltest du mit den Inhalten nicht einverstanden sein, dann kann du diesen Post einfach melden.\",
                    type: \"error\"
                    });
                    </script>";

  }

}

 ?>
