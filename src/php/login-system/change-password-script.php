<?php
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");

if (isset($_POST["change-password-button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    $form_errors = array();

    $required_fields = array("Aktuelles-Passwort", "Neues-Passwort", "Neues-Passwort-bestätigen");

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array("Neues-Passwort" => 8, "Neues-Passwort-bestätigen" => 8);

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    if (empty($form_errors)) {

      $id = $_POST["hidden-id"];
      $current_password = $_POST["Aktuelles-Passwort"];
      $password1 = $_POST["Neues-Passwort"];
      $password2 = $_POST["Neues-Passwort-bestätigen"];

      if ($password1 != $password2) {

        $result = flashMessage("Es wurden zwei verschiedene neue Passwörter eingegeben.");

      } else {

        try {

          $sqlQuery = "SELECT password FROM users WHERE id = :id";

          $statement = $db->prepare($sqlQuery);

          $statement->execute(array(":id" => $id));

          if ($row = $statement->fetch()) {

            $password_from_db = $row["password"];

            if (password_verify($current_password, $password_from_db)) {

              $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

              $sqlUpdate = "UPDATE users SET password = :password WHERE id = :id";

              $statement = $db->prepare($sqlUpdate);

              $statement->execute(array(":password" => $hashed_password, ":id" => $id));

              if ($statement->rowCount() === 1) {

                $result = "<script type=\"text/javascript\">
                                swal({
                                title: \"Passwort geändert!\",
                                text: \"Deine Passwort wurde erfolrgeich geändert.\",
                                type: \"success\",
                                closeOnConfirm: false });
                                </script>";

              } else {

                $result = "<script type=\"text/javascript\">
                                swal({
                                title: \"Ooops... Passwort nicht geändert!\",
                                text: \"Tut uns leid, aber dein Passwort konnte nicht geändert werden. Versuch es einfach noch einmal!\",
                                type: \"error\"
                                });
                                </script>";

              }


            } else {

              $result = flashMessage("Dein aktuelles Passwort ist nicht korrekt.");

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

      }

    } else {

      // und wenn nur ein Element im form_errors-Array existiert,
      if (count($form_errors) == 1) {

        // wird die Fehlermeldung für einen Fehler ausgegeben,
        $result = flashMessage("Eine deiner Angaben ist leider nicht korrekt:<br />");

        //sonst, wenn mehrere Fehler im form_errors-Array gespeichert sind,
      } else {

        // wird die fehlermeldung für mehrere Fehler ausgegeben.
        $result = flashMessage(count($form_errors) . " deiner Angaben sind leider nicht korrekt:");

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
