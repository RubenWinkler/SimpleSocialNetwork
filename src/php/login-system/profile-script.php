<?php
include_once("./src/php/login-system/database-connection-script.php");
include_once("./src/php/login-system/utilities-script.php");

if (isset($_GET["u"])) {

  $username = $_GET["u"];

  // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
  $sqlQuery = "SELECT * FROM users WHERE username = :username";
  // das SQL-Statement vorbereitet und
  $statement = $db->prepare($sqlQuery);
  // das SQL-Statement ausgeführt.
  $statement->execute(array(":username" => $username));

  // Wenn außerdem $statement->fetch() einen Rückgabewert liefert, wird dieser in $row gespeichert und
  if ($rs = $statement->fetch()) {

    // $username auf $row["username"] gesetzt,
    $member_username = $rs["username"];
    // $email auf $row["email"] gesetzt und
    $member_email = $rs["email"];
    // $avatar auf $row["avatar"] gesetzt und
    $member_avatar = $rs["avatar"];
	  // $banner auf $row["banner"] gesetzt und
    $member_banner = $rs["banner"];
    // das Beitrittsdatum auf $row["join_date"] gesetzt (die Funktionen dienen dazu aus time() ein Datum zu machen).
    $member_join_date = strftime("%d. %B %Y", strtotime($rs["join_date"]));

  }

}

// Wenn $_SESSION["id"] gesetzt ist (der Benutzer eingeloggt ist),
if ((isset($_SESSION["id"]) || isset($_GET["user-identity"])) && !isset($_POST["edit-profile-button"])) {

  if (isset($_GET["user-identity"])) {
    $url_encoded_id = $_GET["user-identity"];
    $decode_id = base64_decode($url_encoded_id);
    $user_id_array = explode("o9Öhs4Iqd1Üje8Ahf9g", $decode_id);
    $id = $user_id_array[1];

  } else {

    $id = $_SESSION["id"];

  }

  // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
  $sqlQuery = "SELECT * FROM users WHERE id = :id";
  // das SQL-Statement vorbereitet und
  $statement = $db->prepare($sqlQuery);
  // das SQL-Statement ausgeführt.
  $statement->execute(array(":id" => $id));

  // Wenn außerdem $statement->fetch() einen Rückgabewert liefert, wird dieser in $row gespeichert und
  if ($rs = $statement->fetch()) {

    // $username auf $row["username"] gesetzt,
    $username = $rs["username"];
    // $email auf $row["email"] gesetzt und
    $email = $rs["email"];
    // $avatar auf $row["avatar"] gesetzt und
    $avatar = $rs["avatar"];
	  // $banner auf $row["banner"] gesetzt und
    $banner = $rs["banner"];
    // das Beitrittsdatum auf $row["join_date"] gesetzt (die Funktionen dienen dazu aus time() ein Datum zu machen).
    $join_date = strftime("%d. %B %Y", strtotime($rs["join_date"]));

  }

  // Dann wird die User-ID enkodiert (verschlüsselt).
  $encode_id = base64_encode("o9Öhs4Iqd1Üje8Ahf9g{$id}");


} elseif (isset($_POST["edit-profile-button"], $_POST["token"])) {

  if (validate_token($_POST["token"])) {

    $form_errors = array();

    $required_fields_array = array("E-Mail", "Benutzername");

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields_array));

    $fields_to_check_length = array("Benutzername" => 2);

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    $form_errors = array_merge($form_errors, check_email());

    if (isset($_FILES["Profilbild"]["name"])) {

      $avatar = $_FILES["Profilbild"]["name"];

    } else {

      $avatar = NULL;

    }

    if ($avatar != NULL) {

      $form_errors = array_merge($form_errors, isValidImage($avatar));

    }

    if (isset($_FILES["Profilbanner"]["name"])) {

      $banner = $_FILES["Profilbanner"]["name"];

    } else {

      $banner = NULL;

    }

    if ($banner != NULL) {

      $form_errors = array_merge($form_errors, isValidImage($banner));

    }

    $email = $_POST["E-Mail"];

    $username = $_POST["Benutzername"];

    $hidden_id = $_POST["hidden-id"];

    if (empty($form_errors)) {

      try {

        $avatar_query = "SELECT avatar FROM users WHERE id = :id";
        $old_avatar_statement = $db->prepare($avatar_query);
        $old_avatar_statement->execute([":id" => $hidden_id]);

        if ($rs = $old_avatar_statement->fetch()) {

          $old_avatar = $rs["avatar"];

        }

        $banner_query = "SELECT banner FROM users WHERE id = :id";
        $old_banner_statement = $db->prepare($banner_query);
        $old_banner_statement->execute([":id" => $hidden_id]);

        if ($rs = $old_banner_statement->fetch()) {

          $old_banner = $rs["banner"];

        }

        $sqlUpdate = "UPDATE users SET username =:username, email =:email WHERE id =:id";

        $statement = $db->prepare($sqlUpdate);

        if ($avatar != NULL) {

          $sqlUpdate = "UPDATE users SET username =:username, email =:email, avatar =:avatar WHERE id =:id";

          $avatar_path = uploadProfilePicture($username);

          if (!$avatar_path) {

            $avatar_path = "avatar-uploads/default-avatar.jpg";

          }

          $statement = $db->prepare($sqlUpdate);

          $statement->execute(array(":username" => $username, ":email" => $email, ":avatar" => $avatar_path, ":id" => $hidden_id));

          if (isset($old_avatar)) {

            unlink($old_avatar);

          }

        } elseif ($banner != NULL) {

          $sqlUpdate = "UPDATE users SET username =:username, email =:email, banner =:banner WHERE id =:id";

          $banner_path = uploadProfileBanner($username);

          if (!$banner_path) {

            $banner_path = "banner-uploads/default-banner.jpg";

          }

          $statement = $db->prepare($sqlUpdate);

          $statement->execute(array(":username" => $username, ":email" => $email, ":banner" => $banner_path, ":id" => $hidden_id));

          if (isset($old_banner)) {

            unlink($old_banner);

          }

        } else {

          $statement->execute(array(":username" => $username, ":email" => $email, ":id" => $hidden_id));

        }

        if ($statement->rowCount() == 1) {

          $_SESSION["username"] = $username;

          $_SESSION["email"] = $email;

          $result = "<script type=\"text/javascript\">
                          swal({
                          title: \"Profil bearbeitet!\",
                          text: \"Super... deine Account-Daten wurden erfolrgeich geändert.\",
                          type: \"success\",
                          closeOnConfirm: false
                          },
                          function(){
                            window.location.href = 'profile.php';
                          });
                          </script>";

        } else {

          $result = "<script type=\"text/javascript\">
                          swal({
                          title: \"Profil nicht bearbeitet!\",
                          text: \"Ooops... die Änderungen konnten leider nicht gespeichert werden. Versuch es einfach noch einmal!\",
                          type: \"error\",
                          closeOnConfirm: false
                          },
                          function(){
                            window.location.replace(window.location.href);
                          });
                          </script>";
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

      if (count($form_errors) == 1) {

        $result = flashMessage("Eine deiner Angaben ist nicht korrekt: ");

      } else {

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
