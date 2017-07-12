<?php

  try {

    $statement = $db->query("SELECT * FROM users WHERE activated = '1' LIMIT 1");

    $members = $statement->fetchAll(PDO::FETCH_ASSOC);

    $members_count = count($members);

  } catch (PDOException $ex) {

    $result = flashMessage("Es ist ein Fehler aufgereten: " . $ex->getMessage());

  }

 ?>
