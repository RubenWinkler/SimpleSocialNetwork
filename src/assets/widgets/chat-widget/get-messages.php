<?php

include_once("chat-utilities-script.php");
include_once("./../../../../src/php/login-system/database-connection-script.php");

if (isset($_GET["from_user"]) && isset($_GET["to_user"])) {

  // Daten aus DB auslesen
  try {

    $from_user = $_GET["from_user"];
    $to_user = $_GET["to_user"];

    $query = "SELECT * FROM chat WHERE from_user = :from_user AND to_user = :to_user";

    $statement = $db->prepare($query);

    $statement->execute(array(':from_user' => $from_user, ':to_user' => $to_user));

    $to_messages = $statement->fetchAll(PDO::FETCH_ASSOC);

    $from_user = $_GET["to_user"];
    $to_user = $_GET["from_user"];

    $query = "SELECT * FROM chat WHERE from_user = :from_user AND to_user = :to_user";

    $statement = $db->prepare($query);

    $statement->execute(array(':from_user' => $from_user, ':to_user' => $to_user));

    $from_messages = $statement->fetchAll(PDO::FETCH_ASSOC);

    $all_messages = array_merge($to_messages, $from_messages);

    usort($all_messages, "sortFunction");

    $html_messages = "";

    foreach ($all_messages AS $message) {

        if ($message["from_user"] == $to_user) {

          $html_messages .= "<div class='chat-massage-container'><div class='chat-massage-a'>". $message["message"] ."</div></div>";

        } else {

          $html_messages .= "<div class='chat-massage-container'><div class='chat-massage-b'>". $message["message"] ."</div></div>";

        }

    }

    echo $html_messages;



  } catch (PDOException $ex) {

    echo "Es ist ein Fehler aufgetreten!";

  }

}





 ?>
