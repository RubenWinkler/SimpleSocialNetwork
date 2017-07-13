<?php
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");
include_once ("./src/php/login-system/send-email-gmail.php");

// Wenn das Reset-Password-Formular abgeschickt wurde,
if (isset($_POST["password-reset-button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
    $form_errors = array();

    // werden alle Pflichfelder, die zu überprüfen sind, definiert,
    $required_fields = array("E-Mail", "Token", "Neues-Passwort", "Neues-Passwort-bestätigen", );

    // wird die Funktion check_empty_fields() aufgerufen und ihr Rückgabewert in das $form_errors-Array gemerged,
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    // wird ein assoziatives Array mit allen Feldern mit einer minimalen Zeichenanzahl erzeugt und
    $fields_to_check_length = array("Neues-Passwort" => 8, "Neues-Passwort-bestätigen" => 8);

    // wird die Funktion check_min_length() aufgerufen und ihr Rückgabewert in das $form_errors-Array gemerged.
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //Wenn dann noch immer das $form_errors-Array leer ist,
    if (empty($form_errors)) {

        // wird $email auf $_POST["E-Mail"] gesetzt,
        $email = $_POST["E-Mail"];
        // wird $reset_token auf $_POST["Token"] gesetzt,
        $reset_token = $_POST["Token"];
        // wird $password1 auf $_POST["Neues_Passwort"] gesetzt und
        $password1 = $_POST["Neues-Passwort"];
        // wird $password2 auf $_POST["Neues_Passwort_bestätigen"] gesetzt.
        $password2 = $_POST["Neues-Passwort-bestätigen"];

        // Wenn $password1 != $password2 ist,
        if ($password1 != $password2) {

          // wird eine Fehlermeldung ausgegeben.
          $result = "Die eingegebenen Passwörter stimmen nicht überein.";

          // Wenn die Passwörter übereinstimmen,
        } else {

          // wird
          try {

            // Token und E-Mail Adresse validiert
            $query = "SELECT * FROM password_recovery WHERE email = :email";

            $queryStatement = $db->prepare($query);

            $queryStatement->execute([":email" => $email]);

            $isValid = true;

            if ($rows = $queryStatement->fetch()) {

              $stored_token = $rows["token"];

              $expire_time = $rows["expire_time"];

              if ($stored_token !== $reset_token) {

                $isValid = false;

                $result = "<script type=\"text/javascript\">
                                swal({
                                title: \"Ungültiges Token!\",
                                text: \"Du hast ein ungültiges Token eingegben. Versuch es einfach noch einmal!\",
                                type: \"error\"
                                });
                                </script>";

              }

              if ($expire_time < date("Y-m-d H-i-s")) {

                $isValid = false;

                $result = "<script type=\"text/javascript\">
                                swal({
                                title: \"Token abgelaufen!\",
                                text: \"Dein Token ist leider abgelaufen. Fordere einfach ein neues an!\",
                                type: \"error\"
                                });
                                </script>";

                // Token löschen
                $db->exec("DELETE FROM password_recovery WHERE email = '$email' AND token = '$reset_token'");

              }

            } else {

              $isValid = false;

              goto invalid_email;

            }

            // Wenn das Token valide ist
            if ($isValid) {

              // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
              $sqlQuery = "SELECT email FROM users WHERE email =:email";
              // das SQL-Statement vorbereitet und
              $statement = $db->prepare($sqlQuery);
              // das SQL-Statement ausgeführt.
              $statement->execute([":email" => $email]);

              // Wenn eine Row durch die Ausführung des SQL-Statements betroffen ist,
              if ($rs = $statement->fetch()) {

                // wird das neue Passwort verschlüssel und in $hashed_password gespeichert,
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                // ein SQL-Statement in der Variablen $sqlUpdate zusammengesetzt,
                $sqlUpdate = "UPDATE users SET password =:password WHERE email =:email";
                // das SQL-Statement vorbereitet,
                $statement = $db->prepare($sqlUpdate);
                // das SQL-Statement ausgeführt und
                $statement->execute(array(":password" => $hashed_password, ":email" => $email));

                if ($statement->rowCount() == 1) {

                  // Token löschen
                  $db->exec("DELETE FROM password_recovery WHERE email = '$email' AND token = '$reset_token'");

                }

                // ein passender Success-Sweet-Alert ausgegeben.
                $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Passwort erfolgreich geändert!\",
                            text: \"Du kannst dich jetzt mit deinem neuen Passwort anmelden.\",
                            type: \"success\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'login.php';
                            });
                            </script>";

                // Wenn mehr als eine Row oder keine Row durch die Ausführung des SQL-Statements betroffen ist,
              } else {

                invalid_email:

                // wird eine Fehlermeldung ausgegeben.
                $result = flashMessage("Die von dir eingegebene E-Mail Adresse existiert nicht.");

              }

            }

            // Jegliche PDO-Exceptions werden abgefangen und
          } catch (PDOException $ex) {

            // eine Fehlermeldung wird ausgegeben.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Datenbank?! Wo bist du?\",
                            text: \"Oha... unsere Datenbank scheint im Moment andersweitig beschäftigt zu sein, tut uns leid! Versuch es später noch einmal!\",
                            type: \"error\"
                            });
                            </script>";

          }

        }

        // Wenn das form_errors-Array nicht leer ist,
      } else {

        // und wenn nur ein Element im form_errors-Array existiert,
        if (count($form_errors) == 1) {

          // wird die Fehlermeldung für einen Fehler ausgegeben,
          $result = flashMessage("Eine deiner Angaben ist nicht korrekt:<br />");

          //sonst, wenn mehrere Fehler im form_errors-Array gespeichert sind,
        } else {

          // wird die fehlermeldung für mehrere Fehler ausgegeben.
          $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");

          }

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

  // Wenn nicht der Passwort-Reset-Button, sondern der Passwort-Recovery-Button gedrückt wurde,
} elseif (isset($_POST["password-recovery-button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
    $form_errors = array();

    // werden alle Pflichfelder, die zu überprüfen sind, definiert,
    $required_fields = array("E-Mail");

    // wird die Funktion check_empty_fields() aufgerufen und ihr Rückgabewert in das $form_errors-Array gemerged und
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    // wird die Funktion check_email() aufgerufen und ihr Rückgabewert in das form_errors-Array gemerged.
    $form_errors = array_merge($form_errors, check_email($_POST));

    // Wenn das form_errors-Array dann noch immer leer ist,
    if (empty($form_errors)) {

      // wird $email auf $_POST["E-Mail"] gesetzt,
      $email = $_POST["E-Mail"];

      // und es wird
      try {

        // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
        $sqlQuery = "SELECT * FROM users WHERE email = :email";
        // das SQL-Statement vorbereitet und
        $statement = $db->prepare($sqlQuery);
        // das SQL-Statement ausgeführt.
        $statement->execute(array(":email" => $email));

        // Wenn $statement->fetch() einen Rückgabewert liefert,
        if ($row = $statement->fetch()) {

          // wird $username auf $row["username"] gesetzt,
          $username = $row["username"];
          // $email auf $row["email"] gesetzt,
          $email = $row["email"];
          // Auslaufzeit des Tokens wird generiert
          $expire_time = date("Y-m-d H-i-s", strtotime("1 hour"));
          // Zufälligen String aus Großbuchstaben ohne Sonderzeichen erzeugen
          $reset_token = strtoupper(preg_replace("/[^A-Za-z0-9\-]/", "", base64_encode(openssl_random_pseudo_bytes(10))));

          $insertToken = "INSERT INTO password_recovery (email, token, expire_time) VALUES (:email, :token, :expire_time)";

          $token_statement = $db->prepare($insertToken);

          $token_statement->execute([":email" => $email, ":token" => $reset_token, ":expire_time" => $expire_time]);

          // die Passwort-Recovery-Link E-Mail in $mail_body gespeichert,
          $mail_body = '<html>
                        <head>
                            <meta charset="utf-8">
                            <title>Passwort Recovery</title>
                            <style type="text/css">
                            </style>
                        </head>
                        <body style="color:#000; font-family: Arial, Helvetica, sans-serif;
                                            line-height:1.8em;">
                        <h2>Simple Social Network: Passwort zurücksetzen</h2>
                        <p>Hello '.$username.',<br><br>um dein Passwort zurückzusetzen, kopiere bitte das Authetifizierungs-Token und klicke auf den Link weiter unten.</p>
                        <p>Authetifizierungs-Token: '.$reset_token.'
                        <p><a href="http://localhost/SimpleSocialNetwork/password-recovery.php">Passwort zurücksetzen</a></p>
                        <p><strong>&copy; '.date("Y").' The Simple Social Network</strong></p>
                        </body>
                        </html>';
          // der Adressat mit der im Formular eingegebenen E-Mail Adresse und dem Benutzernamen hinzugefügt,
          $mail->addAddress($email, $username);
          // der Betreff der E-Mail auf "DIVISION Network: Passwort zurücksetzen" gesetzt und
          $mail->Subject = "Simple Social Network: Passwort zurücksetzen";
          // der Inhalt (Body) der E-Mail auf den eben definierten $mail_body gesetzt.
          $mail->Body = $mail_body;

          // Wenn dann jedoch die E-Mail nicht erfolgreich versendet wurde,
          if (!$mail->Send()) {

            // wird ein Error-Sweet-Alert ausgegeben.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Passwort nicht zurückgesetzt!\",
                            text: \"Ooops... dein Passwort konnte leider nicht zurückgesetzt werden, tut uns leid. Versuch es einfach noch einmal!\",
                            type: \"error\",
                            closeOnConfirm: false
                            });
                            </script>";

          // Wenn die E-Mail erfolgreich versendet wurde,
          } else {

            // wird ein Success-Sweet-Alert ausgegeben.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Jetzt dein Passwort zurücksetzen!\",
                            text: \"Wir haben dir eine E-Mail mit einem Passwort-Zurücksetzen-Link und einem Authentifizierungs-Token gesendet. Schau doch mal in deinem E-Mail Postfach nach!\",
                            type: \"success\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'password-recovery.php';
                            });
                            </script>";

          }

          // Wenn $statement->fetch() keinen Rückgabewert liefert
        } else {

          // eine Fehlermeldung ausgegeben.
          $result = "<script type=\"text/javascript\">
                          swal({
                          title: \"E-Mail Adresse nicht gefunden!\",
                          text: \"Wir konnten leider deine E-Mail Adresse nicht in unserer Datenbank finden. Versuch es noch einmal!\",
                          type: \"error\"
                          });
                          </script>";

        }

        // Jegliche PDO-Exceptions werden abgefangen und
      } catch (PDOException $ex) {

        // eine Fehlermeldung ausgegeben.
        $result = "<script type=\"text/javascript\">
                        swal({
                        title: \"Datenbank?! Wo bist du?\",
                        text: \"Oha... unsere Datenbank scheint gerade andersweitig beschäftigt zu sein, tut uns leid! Versuch es einfach noch einmal!\",
                        type: \"error\"
                        });
                        </script>";

      }

    } else {

      // und nur ein Fehler vorliegt,
      if (count($form_errors) == 1) {

        // wird die Fehlermeldung für einen Fehler ausgegeben.
        $result = flashMessage("Eine deiner Angaben ist nicht korrekt:");

        // Sonst,
       } else {

         // wird die Fehlermeldung für mehrere Fehler ausgegeben.
         $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");

       }

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
