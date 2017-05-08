<?php
include_once ("./../src/php/login_system/database_connection.php");
include_once ("./../src/php/login_system/utilities.php");

// Wenn der Login-Button gedrückt wurde,
if (isset($_POST['login_button'], $_POST["token"])) {

    //token validieren
    if (validate_token($_POST["token"])) {

      // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
      $form_errors = array();

      // werden alle Pflichfelder, die zu überprüfen sind, definiert.
      $required_fields = array('Benutzername', 'Passwort');

      // wird die Funktion check_empty_fields() aufgerufen und die Rückgabewerte werden in das $form_errors-Array gemerged.
      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      // Wenn das $form_errors-Array bis hierhin leer ist (also keine Fehler vorliegen),
      if (empty($form_errors)){

          // wird $username auf $_POST['Benutzername']
          $username = $_POST['Benutzername'];
          // und $password auf $_POST['Passwort'] gesetzt.
          $password = $_POST['Passwort'];

          // Wenn auch $_POST["remember"] ("Remember me"-Funktion) gesetzt ist,
          if (isset($_POST["remember"])) {

            // wird $remember auf $_POST["remember"] (also: "yes") gesetzt.
            $remember = $_POST["remember"];

          } else {

            // Sonst wird $remember auf einen leeren String gesetzt.
            $remember = "";

          }

          // Es wird ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt.
          $sqlQuery = "SELECT * FROM users WHERE username = :username";

          // Das SQL-Statement wird mit prepare($sqlQuery) vorbereitet.
          $statement = $db->prepare($sqlQuery);

          // Das SQL-Statement wird ausgeführt.
          $statement->execute(array(':username' => $username));

          // Wenn $statement->fetch() einen Rückgabewert liefert, wird die gefetchte Row in $row gespeichert und
          if ($row = $statement->fetch()) {

            // wird $id auf $row['id'] (die User-ID) gesetzt,
            $id = $row['id'];
            // wird das übermittelte Passwort enkodiert und in $hashed_password gespeichert,
            $hashed_password = $row['password'];
            // wird $username auf $row['username'] (den Benutzernamen) gesetzt
            $username = $row['username'];
            // und $activated auf $row['activated'] gesetzt.
            $activated = $row['activated'];

            // Wenn $activated === "0" ist (also der Account noch nicht aktiviert wurde),
            if ($activated === "0") {

              if (checkDuplicateEntries("deactivated_accounts", "user_id", $id, $db)) {

                $db->exec("UPDATE users SET activated = '1' WHERE id = $id LIMIT 1");

                $db->exec("DELETE FROM deactivated_accounts WHERE user_id = $id LIMIT 1");

                prepareLogin($id, $username, $remember);

              } else {

                // wird die Fehlermeldung "Bitte aktiviere deinen Account." ausgegeben.
                $result = flashMessage("Bitte aktiviere deinen Account.");

              }

              // Wenn $activated != "0" ist (also der Account bereits aktiviert wurde),
            } else {

              // wird, wenn password_verify() true zurückgibt (also $password [das eingegebene Passwort] und $hashed_password [das in der Database gespeicherte Passwort] übereinstimmen),
              if (password_verify($password, $hashed_password)){

                prepareLogin($id, $username, $remember);

                // Wenn password_verify() false zurückgibt (also $password [das eingegebene Passwort] und $hashed_password[das in der Database gespeicherte Passwort] nicht übereinstimmen),
              } else {

                // wird eine Fehlermeldung ausgegeben.
                $result = flashMessage("Benutzername und/oder Passwort nicht korrekt!");

              }

            }

            // Wenn $statement->fetch() keine Row zurückgibt (also ein Falscher Benutzername angegeben wurde),
          } else {

            // wird eine Fehlermeldung ausgegeben.
            $result = flashMessage("Benutzername und/oder Passwort nicht korrekt!");

         }

         // Wenn das $form_errors-Array nicht leer ist (also Fehler vorliegen),
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
