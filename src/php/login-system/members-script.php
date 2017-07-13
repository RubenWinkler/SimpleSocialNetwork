<?php

  try {

    $query = "SELECT * FROM users WHERE activated = '1'";

    $statement = $db->prepare($query);

    $statement->execute();

    $members = $statement->fetchAll(PDO::FETCH_ASSOC);

    $members_count = count($members);

  } catch (PDOException $ex) {

    $result = "<script type=\"text/javascript\">
                    swal({
                    title: \"Datenbank?! Wo bist du?\",
                    text: \"Oha... unsere Datenbank scheint im Moment andersweitig beschäftigt zu sein, tut uns leid! Versuch es später noch einmal!\",
                    type: \"error\"
                    });
                    </script>";

  }

 ?>
