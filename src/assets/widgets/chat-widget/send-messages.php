<?php

include_once("./../../../../src/php/login-system/database-connection-script.php");

if (isset($_POST["chat_message"]) && isset($_POST["chat_target_user"]) && isset($_POST["chat_user"])) {

  try {

    $message = $_POST["chat_message"];
    $encodedMessage = base64_encode("uh63hsUz78jjnehF2358ßdFbbsaAjhgfc{$message}");
    $from_user = $_POST["chat_user"];
    $to_user = $_POST["chat_target_user"];

    $query = "INSERT INTO chat (from_user, to_user, message) VALUES (:from_user, :to_user, :message)";

    $statement = $db->prepare($query);

    $statement->execute([":from_user" => $from_user, ":to_user" => $to_user, ":message" => $encodedMessage]);

  } catch (PDOException $ex) {

    echo "Ein Fehler ist aufgetreten!";

  }

}

 ?>
