<?php
include_once("./../src/php/login_system/database_connection.php");
include_once("./../src/php/login_system/utilities.php");

if (isset($_POST["change_password_button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    $form_errors = array();

    $required_fields = array("Aktuelles_Passwort", "Neues_Passwort", "Neues_Passwort_bestätigen");

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array("Neues_Passwort" => 8, "Neues_Passwort_bestätigen" => 8);

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    if (empty($form_errors)) {

      $id = $_POST["hidden_id"];
      $current_password = $_POST["Aktuelles_Passwort"];
      $password1 = $_POST["Neues_Passwort"];
      $password2 = $_POST["Neues_Passwort_bestätigen"];

      if ($password1 != $password2) {

        $result = flashMessage("Es wurde nicht zweimal das selbe neue Passwort eingegeben.");

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

                $result = flashMessage("Passwort konnte nicht geändert werden.");

              }


            } else {

              $result = flashMessage("Dein aktuelles Passwort ist nicht korrekt.");

            }

          } else {

            signout();

          }

        } catch (PDOException $ex) {

          $result = flashMessage("Ein Fehler ist aufgetreten: " . $ex->getMessage());

        }

      }

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
}


 ?>
