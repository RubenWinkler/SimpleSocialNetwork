<?php
include_once("./../src/php/login_system/database_connection.php");
include_once("./../src/php/login_system/utilities.php");

// Wenn $_SESSION["id"] gesetzt ist (der Benutzer eingeloggt ist),
if ((isset($_SESSION["id"]) || isset($_GET["user_identity"])) && !isset($_POST["edit_profile_button"])) {

  if (isset($_GET["user_identity"])) {
    $url_encoded_id = $_GET["user_identity"];
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
    // das Beitrittsdatum auf $row["join_date"] gesetzt (die Funktionen dienen dazu aus time() ein Datum zu machen).
    $join_date = strftime("%d. %B %Y", strtotime($rs["join_date"]));
  }

  $user_pic = "./../avatar_uploads/" . $username . ".jpg";

  $default_user_pic = "./../avatar_uploads/default_avatar.jpg";

  if (file_exists($user_pic)) {

    $profile_picture = $user_pic;

  } else {

    $profile_picture = $default_user_pic;

  }

  $user_banner = "./../banner_uploads/" . $username . ".jpg";

  $default_user_banner = "./../banner_uploads/default_banner.jpg";

  if (file_exists($user_banner)) {

    $profile_banner = $user_banner;

  } else {

    $profile_banner = $default_user_banner;

  }

  // Dann wird die User-ID enkodiert (verschlüsselt).
  $encode_id = base64_encode("o9Öhs4Iqd1Üje8Ahf9g{$id}");


} elseif (isset($_POST["edit_profile_button"], $_POST["token"])) {

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

    $hidden_id = $_POST["hidden_id"];

    if (empty($form_errors)) {


      try {

        $sqlUpdate = "UPDATE users SET username =:username, email =:email WHERE id =:id";

        $statement = $db->prepare($sqlUpdate);

        $statement->execute(array(":username" => $username, ":email" => $email, ":id" => $hidden_id));

        if ($statement->rowCount() == 1 || uploadProfileBanner($username) || uploadProfilePicture($username)) {

          $_SESSION["username"] = $username;

          $_SESSION["email"] = $email;

          $result = "<script type=\"text/javascript\">
                          swal({
                          title: \"Profil bearbeitet!\",
                          text: \"Deine Account-Daten wurden erfolrgeich geändert.\",
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
                          title: \"Ooops!\",
                          text: \"Deine Account-Daten konnten nicht geändert werden.\",
                          type: \"error\",
                          closeOnConfirm: false
                          },
                          function(){
                            window.location.href = 'edit-profile.php';
                          });
                          </script>";
        }

      } catch (PDOException $ex) {

        $result = flashMessage("Ein Fehler ist aufgetreten: " . $ex->getMessage());

      }

    } else {

      if (count($form_errors) == 1) {

        $result = flashMessage("Eine deiner Angaben ist nicht korrekt: ");

      } else {

        $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");

      }

    }

  } else {

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }


}


 ?>
