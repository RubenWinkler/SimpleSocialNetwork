<?php
include_once ("./../src/php/login_system/database_connection.php");
include_once ("./../src/php/login_system/utilities.php");
include_once ("./../src/php/login_system/send-email-gmail.php");

if (isset($_POST["deactivate_account_button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    $id = $_POST["hidden_id"];

    try {

      $sqlQuery = "SELECT * FROM users WHERE id = :id";

      $statement = $db->prepare($sqlQuery);

      $statement->execute(array(":id" => $id));

      if ($row = $statement->fetch()) {

        $username = $row["username"];
        $email = $row["email"];
        $user_id = $row["id"];

        $deactivateQuery = "UPDATE users SET activated = :activated WHERE id = :id";

        $deactivateStatement = $db->prepare($deactivateQuery);

        $deactivateStatement->execute(array(":activated" => 0, ":id" => $user_id));

        if ($deactivateStatement->rowCount() === 1) {

          $insertQuery = "INSERT INTO deactivated_accounts (user_id, deactivated_at) VALUES (:id, now())";

          $insertStatement = $db->prepare($insertQuery);

          $insertStatement->execute(array(":id" => $user_id));

          if ($insertStatement->rowCount() === 1) {

            $mail_body = '<html>
                          <head>
                              <meta charset="utf-8">
                              <title>Dein Account wurde deaktiviert</title>
                              <style type="text/css">
                              </style>
                          </head>
                          <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                              line-height:1.8em;">
                          <h2>Dein Account wurde deaktiviert</h2>
                          <p>Hallo '.$username.',<br><br>Dein Account wurde erfolgreich deaktiviert. Deine Benutzerdaten werden für weitere 14 Tage gespeichert.
                          Solltest du es dir anders überlegen, brauchst du dich nur erneut wie gewohnt mit Benutzernamen und Passwort anzumelden.
                          Nach Ablauf der 14 Tage werden deine Benutzerdaten entgültig aus unserem System gelöscht.</p>
                          <br />
                          <p><a href="http://localhost/DIVISION-Network/pages/login.php"> Doch Mitglied bleiben?</a></p>
                          <p><strong>&copy;2017 DIVISION Network</strong></p>
                          </body>
                          </html>';

            $mail->addAddress($email, $username);
            $mail->Subject = "DIVISION Network: Account erfolgreich deaktiviert";
            $mail->Body = $mail_body;

            if (!$mail->Send()) {

              $result = "<script type=\"text/javascript\">
                        swal({
                        title: \"Account nicht deaktiviert!\",
                        text: \"Dein Account konnte leider nicht deaktiviert werden. Probier es noch einmal.\",
                        type: \"error\",
                        confirmButtonText: \"Nochmal probieren!\" });
                        });
                        </script>";

            } else {

              $result = "<script type=\"text/javascript\">
                        swal({
                        title: \"Account deaktiviert!\",
                        text: \"Dein Account wurde erfolgreich deaktiviert. Deine Benutzerdaten werden für weitere 14 Tage gespeichert. Solltest du es dir anders überlegen, brauchst du dich nur erneut wie gewohnt mit Benutzernamen und Passwort anzumelden. Nach Ablauf der 14 Tage werden deine Benutzerdaten entgültig aus unserem System gelöscht.\",
                        type: \"success\",
                        confirmButtonText: \"Okay!\" });
                        </script>";

            }

          } else {

            $result = flashMessage("Account konnte nicht deaktiviert werden. Versuch es noch einmal.");

          }

        } else {

          $result = flashMessage("Account konnte nicht deaktiviert werden. Versuch es noch einmal.");

        }

      } else {

        signout();

      }

    } catch (PDOException $ex) {

      $result = flashMessage("Ein Fehler ist aufgetreten: " . $ex->getMessage());

    }

  } else {

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }

}
 ?>
