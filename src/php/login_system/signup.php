<?php
include_once ("./../src/php/login_system/database_connection.php");
include_once ("./../src/php/login_system/utilities.php");
include_once ("./../src/php/login_system/send-email-gmail.php");

// Wenn $_POST["E-Mail"] gesetzt ist (also das Signup-Formular abgeschickt wurde),
if(isset($_POST["E-Mail"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
    $form_errors = array();

    // werden alle Pflichfelder, die zu überprüfen sind, definiert,
    $required_fields = array("E-Mail", "Benutzername", "Passwort");

    // wird die Funktion check_empty_fields() aufgerufen und der Rückgabewert in das $form_errors Array gemerged,
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    // wird ein assoziatives Array mit allen Pflichtfeldern mit einer minimalen Zeichenanzahl definiert,
    $fields_to_check_length = array("Benutzername" => 2, "Passwort" => 8);

    // wird die Funktion check_min_length() aufgerufen und der Rückgabewert in das $form_errors Array gemerged,
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    // wird die Funktion check_email() aufgerufen und der Rückgabewert in das $form_errors Array gemerged,
    $form_errors = array_merge($form_errors, check_email());

    // wird $email auf den im Formular eingegebenen Wert gesetzt,
    $email = $_POST["E-Mail"];
    // wird $username auf den im Formular eingegebenen Wert gesetzt und
    $username = $_POST["Benutzername"];
    // wird $password auf den im Formular eingegebenen Wert gesetzt.
    $password = $_POST["Passwort"];

    // Wenn die Funktion checkDuplicateEntries() true zurückgibt (also die E-Mail Adresse schon verwendet wird),
    if (checkDuplicateEntries("users", "email", $email, $db)) {

      // wird eine Fehlermeldung ausgegeben.
      $result = flashMessage("Registrierung nicht möglich: E-Mail Adresse ist bereits vergeben, bitte verwende eine andere.");

      // Sonst (wenn die E-Mail nicht schon in Verwendung ist) wird geprüft, ob der Benutzername schon vergeben ist und
    } elseif (checkDuplicateEntries("users", "username", $username, $db)) {

      // eine Fehlermeldung wird ausgegeben.
      $result = flashMessage("Registrierung nicht möglich: Benutzername ist bereits vergeben, bitte verwende einen anderen.");

    // Sind die E-Mail Adresse oder der Benutzername nicht schon vergeben, so wird geprüft, ob es sonst Fehler gibt und
    } elseif (empty($form_errors)) {

      // das eingegebene Passwort verschlüsselt in $hashed_password gespeichert.
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      //Im try-Block wird versucht die Daten aus dem Registrierungs-Formular in die Datenbank zu speichern. Schlägt dies fehl werden die Exceptions im catch-Block abgefangen.
      try {

        // Das SQL-Statement wird in der Variablen $sqlInsert gespeichert.
        $sqlInsert = "INSERT INTO users (username, email, password, join_date) VALUES (:username, :email, :password, now())";

        // Das SQL-Statement wird vorbereitet.
        $statement = $db->prepare($sqlInsert);

        // Das SQL-Statement wird ausgeführt.
        $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

        // Wenn $statement->rowCount() nur eine Zeile als Rückgabewert liefert (das Einfügen der Daten in die Database also geklappt hat),
        if ($statement->rowCount() == 1) {

          // wird $user_id auf die ID des eben eingefügten Benutzers gesetzt,
          $user_id = $db->lastInsertId();

          // wird die $user_id enkodiert (verschlüsselt),
          $encode_id = base64_encode("je77ÖPÜhJtE65tHqpHB009Dldbn{$user_id}");

          // wird die Account-Aktivierungs E-Mail in $mail_body gespeichert,
          $mail_body = '<html>
                        <head>
                            <meta charset="utf-8">
                            <title>Herzlich Willkommen im DIVISION Network</title>
                            <style type="text/css">
                            </style>
                        </head>
                        <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                            line-height:1.8em;">
                        <h2>Herzlich Willkommen im DIVISION Network</h2>
                        <p>Hallo '.$username.',<br><br>Vielen Dank für deine Registrierung. Klicke auf den folgenden Link, um deine E-Mail Adresse zu bestätigen und damit deinen Account zu aktivieren:</p>
                        <p><a href="http://localhost/DIVISION-Network/pages/activate.php?id='.$encode_id.'"> Account aktivieren</a></p>
                        <p><strong>&copy;2017 DIVISION Network</strong></p>
                        </body>
                        </html>';

          // wird der Adressat mit der im Formular eingegebenen E-Mail Adresse und dem Benutzernamen hinzugefügt,
          $mail->addAddress($email, $username);

          // wird der Betreff der E-Mail auf "DIVISION Network: Aktiviere deinen Account" gesetzt und
          $mail->Subject = "DIVISION Network: Aktiviere deinen Account";

          // wird der Inhalt (Body) der E-Mail auf den eben definierten $mail_body gesetzt.
          $mail->Body = $mail_body;

          // Wenn dann jedoch die E-Mail nicht erfolgreich versendet wurde,
          if (!$mail->Send()) {

            // wird als $result ein Error-Alert gesetzt.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Registrierung fehlgeschlagen!\",
                            text: \"Die Registrierung ist leider fehlgeschlagen.\",
                            type: \"error\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'signup.php';
                            });
                            </script>";
            // Wenn die E-Mail erfolgreich versendet wurde,
          } else {

            // wird als $result ein Success-Alert gesetzt.
            $result = "<script type=\"text/javascript\">
                            swal({
                            title: \"Registrierung erfolgreich!\",
                            text: \"Wir haben dir eine E-Mail mit einem Aktivierungslink für deinen Account geschickt.\",
                            type: \"success\",
                            closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'index.php';
                            });
                            </script>";
            }

        }

        // Es wird jegliche PDO-Exceptions abgefangen
      } catch (PDOException $ex) {

        // und "Registrierung fehlgeschlagen:" mit der dazugehörigen Fehlermeldung ausgegeben.
        $result = flashMessage("Registrierung fehlgeschlagen: " . $ex->getMessage());

      }

      // Wenn das $form_errors-Array nicht leer ist (also Fehler vorliegen),
    } else {

      // wird, wenn nur ein Fehler vorliegt,
      if (count($form_errors) == 1) {

        // die Fehlermeldung für einen Fehler ausgegeben und
        $result = flashMessage("Eine deiner Angaben ist nicht korrekt: ");

        // bei mehr als einem Fehler,
      } else {

        // die Fehlermeldung für mehrere Fehler ausgegeben.
        $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");

      }

    }

  } else {

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }

  // Wenn nicht das Formular abgeschickt wurde, sondern $_GET['id'] gesetzt ist (also der Benutzer über den Aktivierungslink in der E-Mail zur activate.php-Seite gekommen ist)
} elseif (isset($_GET['id'])) {

  // wird die in $_GET['id'] gelieferte, enkodierte User-ID in $encoded_id gespeichert,
  $encoded_id = $_GET['id'];

  // die enkodierte User-ID dekodiert,
  $decode_id = base64_decode($encoded_id);

  // die dekodierte User-ID in seine Teile (Delimiter-String und User-ID) geteilt,
  $user_id_array = explode("je77ÖPÜhJtE65tHqpHB009Dldbn", $decode_id);

  // die eigentliche User-ID in $id gespeichert,
  $id = $user_id_array[1];

  // das SQL-Statement zusammengesetzt, um den Account zu aktivieren,
  $sql = "UPDATE users SET activated =:activated WHERE id=:id AND activated='0'";

  // das SQL-Statement vorbereitet und
  $statement = $db->prepare($sql);

  // das SQL-Statement ausgeführt.
  $statement->execute(array(':activated' => "1", ':id' => $id));

  // Wenn $statement->rowCount() nur eine Row zurückgibt (also das SQL-Statement erfolgreich ausgeführt wurde),
  if ($statement->rowCount() == 1) {

    // wird eine Erfolgsnachricht angezeigt.
    $result = "<h2>Dein Account wurde erfolgreich aktivert!</h2>
              <p>Du hast deinen Account erfolgreich aktiviert und kannst dich nun mit deinem Benutzernamen und deinem Passwort <a href='login.php'>einloggen</a>.</p>";

    // Sonst,
  } else {

    // wird eine Fehlernachricht angezeigt.
    $result = "<p>Da ist leider etwas schief gegangen. Solltest du deinen Account nicht schon bereits aktiviert haben, kontaktiere uns bitte.</p>";

    }

}

?>
