<?php
include_once("./../src/php/login_system/database_connection.php");
include_once("./../src/php/login_system/utilities.php");
include_once ("./../src/php/login_system/send-email-gmail.php");

// Wenn das Reset-Password-Formular abgeschickt wurde,
if (isset($_POST["password_reset_button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
    $form_errors = array();

    // werden alle Pflichfelder, die zu überprüfen sind, definiert,
    $required_fields = array("Neues_Passwort", "Neues_Passwort_bestätigen");

    // wird die Funktion check_empty_fields() aufgerufen und ihr Rückgabewert in das $form_errors-Array gemerged,
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    // wird ein assoziatives Array mit allen Feldern mit einer minimalen Zeichenanzahl erzeugt und
    $fields_to_check_length = array("Neues_Passwort" => 8, "Neues_Passwort_bestätigen" => 8);

    // wird die Funktion check_min_length() aufgerufen und ihr Rückgabewert in das $form_errors-Array gemerged.
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //Wenn dann noch immer das $form_errors-Array leer ist,
    if (empty($form_errors)) {

        // wird $id auf $_POST["user_id"] gesetzt,
        $id = $_POST["user_id"];
        // wird $password1 auf $_POST["Neues_Passwort"] gesetzt und
        $password1 = $_POST["Neues_Passwort"];
        // wird $password2 auf $_POST["Neues_Passwort_bestätigen"] gesetzt.
        $password2 = $_POST["Neues_Passwort_bestätigen"];

        // Wenn $password1 != $password2 ist,
        if ($password1 != $password2) {

          // wird eine Fehlermeldung ausgegeben.
          $result = "<p>Die eingegebenen Passwörter stimmen nicht überein.</p>";

          // Wenn die Passwörter übereinstimmen,
        } else {

          // wird
          try {

            // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
            $sqlQuery = "SELECT email FROM users WHERE id =:id";
            // das SQL-Statement vorbereitet und
            $statement = $db->prepare($sqlQuery);
            // das SQL-Statement ausgeführt.
            $statement->execute(array(":id" => $id));

            // Wenn eine Row durch die Ausführung des SQL-Statements betroffen ist,
            if ($statement->rowCount() == 1) {

              // wird das neue Passwort verschlüssel und in $hashed_password gespeichert,
              $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

              // ein SQL-Statement in der Variablen $sqlUpdate zusammengesetzt,
              $sqlUpdate = "UPDATE users SET password =:password WHERE id =:id";
              // das SQL-Statement vorbereitet,
              $statement = $db->prepare($sqlUpdate);
              // das SQL-Statement ausgeführt und
              $statement->execute(array(":password" => $hashed_password, ":id" => $id));

              // ein passender Success-Sweet-Alert ausgegeben.
              echo $password_changed = "<script type=\"text/javascript\">
                              swal({
                              title: \"Passwort wurde geändert!\",
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

              // wird eine Fehlermeldung ausgegeben.
              $result = flashMessage("Die von dir eingegebene E-Mail Adresse existiert nicht.");

            }

            // Jegliche PDO-Exceptions werden abgefangen und
          } catch (PDOException $ex) {

            // eine Fehlermeldung wird ausgegeben.
            $result = flashMessage("Passwort ändern fehlgeschlagen:" . $ex->getMessage());

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

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }

  // Wenn nicht der Passwort-Reset-Button, sondern der Passwort-Recovery-Button gedrückt wurde,
} elseif (isset($_POST["password_recovery_button"], $_POST["token"])) {

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
          // $user_id auf $row["id"] gesetzt,
          $user_id = $row["id"];
          // die User-ID enkodiert,
          $encode_id = base64_encode("JHf33QTa56afÜh32aURCdjY5H{$user_id}");

          // die Passwort-Recovery-Link E-Mail in $mail_body gespeichert,
          $mail_body = '<html>
                        <head>
                            <meta charset="utf-8">
                            <title>Passwort zurücksetzen</title>
                            <style type="text/css">
                            </style>
                        </head>
                        <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                            line-height:1.8em;">
                        <h2>Passwort zurücksetzen</h2>
                        <p>Hallo '.$username.',<br><br>Um dein Passwort zurückzusetzen, klicke einfach auf den folgenden Link:</p>
                        <p><a href="http://localhost/DIVISION-Network/pages/forgot-password.php?id='.$encode_id.'"> Passwort zurücksetzen</a></p>
                        <p><strong>&copy;2017 DIVISION Network</strong></p>
                        </body>
                        </html>';
          // der Adressat mit der im Formular eingegebenen E-Mail Adresse und dem Benutzernamen hinzugefügt,
          $mail->addAddress($email, $username);
          // der Betreff der E-Mail auf "DIVISION Network: Passwort zurücksetzen" gesetzt und
          $mail->Subject = "DIVISION Network: Passwort zurücksetzen";
          // der Inhalt (Body) der E-Mail auf den eben definierten $mail_body gesetzt.
          $mail->Body = $mail_body;

          // Wenn dann jedoch die E-Mail nicht erfolgreich versendet wurde,
          if (!$mail->Send()) {

            // wird ein Error-Sweet-Alert ausgegeben.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Passwort nicht zurückgesetzt!\",
                            text: \"Das Passwort konnte leider nicht zurückgesetzt werden.\",
                            type: \"error\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'signup.php';
                            });
                            </script>";

          // Wenn die E-Mail erfolgreich versendet wurde,
          } else {

            // wird ein Success-Sweet-Alert ausgegeben.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Passwort-Recovery-Link verschickt!\",
                            text: \"Wir haben dir eine E-Mail mit einem Passwort-Recovery-Link geschickt.\",
                            type: \"success\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'index.php';
                            });
                            </script>";

          }

          // Wenn $statement->fetch() keinen Rückgabewert liefert
        } else {

          // eine Fehlermeldung ausgegeben.
          $result = flashMessage("Die angegebene E-Mail Adresse wurde nicht in unserer Datenbank gefunden.");

        }

        // Jegliche PDO-Exceptions werden abgefangen und
      } catch (PDOException $ex) {

        // eine Fehlermeldung ausgegeben.
        $result = flashMessage("Ein Fehler ist aufgetreten: " . $ex->getMessage());

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

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }

}

 ?>
