<?php
include_once ("./src/php/login-system/database-connection-script.php");
include_once ("./src/php/login-system/utilities-script.php");
include_once ("./src/php/login-system/send-email-gmail.php");

if (isset($_POST["deactivate-account-button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    $id = $_POST["hidden-id"];

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
                              <title>Simple Social Network: Account deaktiviert</title>
                              <style type="text/css">
                              </style>
                          </head>
                          <body style="color:#000; font-family: Arial, Helvetica, sans-serif;
                                              line-height:1.8em;">
                          <h2>Simple Social Network: Account deaktiviert</h2>
                          <p>Hallo '.$username.',<br><br>Schade, dass du gehst! Wir gewünscht, haben wir deinen Account soeben deaktiviert. Deine Benutzerdaten werden für weitere 14 Tage gespeichert.
                          Solltest du es dir anders überlegen, brauchst du dich nur erneut wie gewohnt mit Benutzernamen und Passwort anzumelden.
                          Nach Ablauf der 14 Tage werden deine Benutzerdaten natürlich entgültig aus unserem System gelöscht.</p>
                          <br />
                          <p><a href="http://localhost/SimpleSocialNetwork/index.php"> Doch Mitglied bleiben?</a></p>
                          <p><strong>&copy; 'date("Y")' Simple Social Network</strong></p>
                          </body>
                          </html>';

            $mail->addAddress($email, $username);
            $mail->Subject = "Simple Social Network: Account deaktiviert";
            $mail->Body = $mail_body;

            if (!$mail->Send()) {

              $result = "<script type=\"text/javascript\">
                        swal({
                        title: \"Account nicht deaktiviert!\",
                        text: \"Ooops... Dein Account konnte leider nicht deaktiviert werden. Versuch es noch einmal!\",
                        type: \"error\",
                        confirmButtonText: \"Okay!\" });
                        });
                        </script>";

            } else {

              $result = "<script type=\"text/javascript\">
                        swal({
                        title: \"Account deaktiviert!\",
                        text: \"Dein Account wurde erfolgreich deaktiviert. Wir haben dir hierzu soeben auch eine E-Mail gesendet.\",
                        type: \"success\",
                        confirmButtonText: \"Okay!\" });
                        </script>";

            }

          } else {

            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Da ist etwas schief gegangen! =/\",
                            text: \"Ooops... tut uns leid, aber dein Account konnte nicht deaktiviert werden. Versuch es noch einmal!\",
                            type: \"error\"
                            });
                            </script>";

          }

        } else {

          $result = "<script type=\"text/javascript\">
                          swal({
                          title: \"Da ist etwas schief gegangen! =/\",
                          text: \"Ooops... tut uns leid, aber dein Account konnte nicht deaktiviert werden. Versuch es noch einmal!\",
                          type: \"error\"
                          });
                          </script>";

        }

      } else {

        signout();

      }

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
                    title: \"Ähhhmmm... wer bist du?!\",
                    text: \"Diese Anfrage stammt von einer unbekannten Quelle. Aber keine Sorge, hierbei handelt es sich nur um einen Sicherheitsmechanismus. Versuch es einfach noch einmal!\",
                    type: \"error\"
                    });
                    </script>";

  }

}

 ?>
