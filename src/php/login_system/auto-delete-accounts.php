<?php
include_once ("./database_connection.php");
include_once ("./utilities.php");
include_once ("./send-email-gmail.php");

try {

  $statement = $db->query("SELECT user_id FROM deactivated_accounts WHERE deactivated_at <= CURRENT_DATE - INTERVAL  14 DAY");

  while ($resultSet = $statement->fetch()) {

    $user_id = $resultSet["user_id"];

    $userRecord = $db->prepare("SELECT * FROM users WHERE id = :id");

    $userRecord->execute(array(":id" => $user_id));

    if ($row = $userRecord->fetch()) {

      $username = $row["username"];

      $id = $row["id"];

      $user_avatar = "./../../../avatar_uploads/" . $username . ".jpg";
      $user_banner = "./../../../banner_uploads/" . $username . ".jpg";

      if (file_exists($user_avatar)) {

        unlink($user_avatar);

      }

      if (file_exists($user_banner)) {

        unlink($user_banner);

      }

      $db->exec("DELETE FROM deactivated_accounts WHERE user_id = $id LIMIT 1");

      $result = $db->exec("DELETE FROM users WHERE id = $id AND activated = '0' LIMIT 1");

      echo "$result Account(s) deleted.";

      $mail_body = '<html>
                    <head>
                        <meta charset="utf-8">
                        <title>Deaktivierter Account gelöscht [Admin]</title>
                        <style type="text/css">
                        </style>
                    </head>
                    <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                        line-height:1.8em;">
                    <h2>Deaktivierter Account gelöscht [Admin]</h2>
                    <p>Der deaktivierte Account von '.$username.' wurde gelöscht.</p>
                    </body>
                    </html>';

      $emailAddress = "r.winkler1412@gmail.com";
      $mail->addAddress($emailAddress, $username);
      $mail->Subject = "Deaktivierter Account gelöscht [Admin]";
      $mail->Body = $mail_body;

      $mail->Send();

    }

  }

} catch (PDOException $ex) {

  $mail_body = '<html>
                <head>
                    <meta charset="utf-8">
                    <title>PDOException: Deaktivierter Account konnte nicht gelöscht werden [Admin]</title>
                    <style type="text/css">
                    </style>
                </head>
                <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                    line-height:1.8em;">
                <h2>PDOException: Deaktivierter Account konnte nicht gelöscht werden [Admin]</h2>
                <p>Der deaktivierte Account von '.$username.' konnte nicht gelöscht werden. Grund: ' . $ex . '</p>
                </body>
                </html>';

  $emailAddress = "r.winkler1412@gmail.com";
  $mail->addAddress($emailAddress, $username);
  $mail->Subject = "PDOException: Deaktivierter Account konnte nicht gelöscht werden [Admin]";
  $mail->Body = $mail_body;

  $mail->Send();

}

try {

  $statement1 = $db->query("SELECT id, username FROM users WHERE join_date <= CURRENT_DATE - INTERVAL 5 DAY AND activated = '0'");

  while ($rs = $statement1->fetch()) {

    $user_id = $rs["id"];

    $username = $rs["username"];

    if (!checkDuplicateEntries("deactivated_accounts", "user_id", $user_id, $db)) {

      $result = $db->exec("DELETE FROM users WHERE id = $user_id AND activated = '0' LIMIT 1");

      echo "$result Account(s) deleted.";

      $mail_body = '<html>
                    <head>
                        <meta charset="utf-8">
                        <title>Nicht aktivierter Account gelöscht [Admin]</title>
                        <style type="text/css">
                        </style>
                    </head>
                    <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                        line-height:1.8em;">
                    <h2>Nicht aktivierter Account gelöscht [Admin]</h2>
                    <p>Der nicht aktivierte Account von '.$username.' wurde gelöscht.</p>
                    </body>
                    </html>';

      $emailAddress = "r.winkler1412@gmail.com";
      $mail->addAddress($emailAddress, $username);
      $mail->Subject = "Nicht aktivierter Account gelöscht [Admin]";
      $mail->Body = $mail_body;

      $mail->Send();

    }

  }

} catch (PDOException $exc) {

  $mail_body = '<html>
                <head>
                    <meta charset="utf-8">
                    <title>PDOException: Nicht aktivierter Account konnte nicht gelöscht werden [Admin]</title>
                    <style type="text/css">
                    </style>
                </head>
                <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                    line-height:1.8em;">
                <h2>PDOException: Nicht aktivierter Account konnte nicht gelöscht werden [Admin]</h2>
                <p>Der nicht aktivierte Account von '.$username.' konnte nicht gelöscht werden. Grund: ' . $exc . '</p>
                </body>
                </html>';

  $emailAddress = "r.winkler1412@gmail.com";
  $mail->addAddress($emailAddress, $username);
  $mail->Subject = "PDOException: Nicht aktivierter Account konnte nicht gelöscht werden [Admin]";
  $mail->Body = $mail_body;

  $mail->Send();

}

 ?>
