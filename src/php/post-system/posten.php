<?php

if ((isset($_POST["post_box_posten_button"]) || isset($_POST["post_box_posten_button_mobile"])) && $_POST["token"]) {

  if (validate_token($_POST["token"])) {

    if ($_POST["post-category"] === "text") {

      $form_errors = array();

      if (isset($_POST["post_box_posten_button"])) {

        $required_fields = array("Posttext");

      } else {

        $required_fields = array("Posttext-mobile");

      }

      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      if (empty($form_errors)) {

        if (isset($_POST["post_box_posten_button"])) {

          $post_text = $_POST["Posttext"];

        } else {

          $post_text = $_POST["Posttext-mobile"];

        }

          $hidden_id = $_POST["hidden_id"];

          $user_id = decodeUserID($hidden_id);

          $post_type = $_POST["post-category"];

          try {

            $sqlInsert = "INSERT INTO posts (user_id, post_type, post_text, posted_at) VALUES (:user_id, :post_type, :post_text, now())";

            $statement = $db->prepare($sqlInsert);

            $statement->execute(array(':user_id' => $user_id, ':post_type' => $post_type, ':post_text' => $post_text));

          } catch (PDOException $ex) {



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

    } elseif ($_POST["post-category"] === "video") {

      $form_errors = array();

      if (isset($_POST["post_box_posten_button"])) {

        $required_fields = array("Posttext", "YouTube-Link");

      } else {

        $required_fields = array("Posttext-mobile", "YouTube-Link-mobile");

      }

      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      if (empty($form_errors)) {

        if (isset($_POST["post_box_posten_button"])) {

          $post_text = $_POST["Posttext"];

          $youtube_link = $_POST["YouTube-Link"];

          $youtube_embed_link = "https://" . convertYTLinkToEmbed($youtube_link);

        } else {

          $post_text = $_POST["Posttext-mobile"];

          $youtube_link = $_POST["YouTube-Link-mobile"];

          $youtube_embed_link = "https://" . convertYTLinkToEmbed($youtube_link);

        }

          $hidden_id = $_POST["hidden_id"];

          $user_id = decodeUserID($hidden_id);

          $post_type = $_POST["post-category"];

          try {

            $sqlInsert = "INSERT INTO posts (user_id, post_type, post_text, youtube_link, posted_at) VALUES (:user_id, :post_type, :post_text, :youtube_link, now())";

            $statement = $db->prepare($sqlInsert);

            $statement->execute(array(':user_id' => $user_id, ':post_type' => $post_type, ':post_text' => $post_text, ':youtube_link' => $youtube_embed_link));

          } catch (PDOException $ex) {



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

    } elseif ($_POST["post-category"] === "image") {

      $form_errors = array();

      if (isset($_POST["post_box_posten_button"])) {

        $required_fields = array("Posttext");

      } else {

        $required_fields = array("Posttext-mobile");

      }

      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      if (empty($form_errors)) {

        if (isset($_POST["post_box_posten_button"])) {

          $post_text = $_POST["Posttext"];

          $uploadImage = uploadImage();

          if ($uploadImage["isImageMoved"]) {

            $imagePath = $uploadImage["image_name"];

          }

        } else {

          $post_text = $_POST["Posttext-mobile"];

          $uploadImage = uploadImage();

          if ($uploadImage["isImageMoved"]) {

            $imagePath = $uploadImage["image_name"];

          }

        }

          $hidden_id = $_POST["hidden_id"];

          $user_id = decodeUserID($hidden_id);

          $post_type = $_POST["post-category"];

          try {

            $sqlInsert = "INSERT INTO posts (user_id, post_type, post_text, image_directory, posted_at) VALUES (:user_id, :post_type, :post_text, :image_directory, now())";

            $statement = $db->prepare($sqlInsert);

            $statement->execute(array(':user_id' => $user_id, ':post_type' => $post_type, ':post_text' => $post_text, ':image_directory' => $imagePath));

          } catch (PDOException $ex) {



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

    } elseif ($_POST["post-category"] === "link") {

      $form_errors = array();

      if (isset($_POST["post_box_posten_button"])) {

        $required_fields = array("Posttext", "Link");

      } else {

        $required_fields = array("Posttext-mobile", "Link-mobile");

      }

      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      if (empty($form_errors)) {

        if (isset($_POST["post_box_posten_button"])) {

          $post_text = $_POST["Posttext"];

          $link = $_POST["Link"];

        } else {

          $post_text = $_POST["Posttext-mobile"];

          $link = $_POST["Link-mobile"];

        }

          $hidden_id = $_POST["hidden_id"];

          $user_id = decodeUserID($hidden_id);

          $post_type = $_POST["post-category"];

          try {

            $sqlInsert = "INSERT INTO posts (user_id, post_type, post_text, link, posted_at) VALUES (:user_id, :post_type, :post_text, :link, now())";

            $statement = $db->prepare($sqlInsert);

            $statement->execute(array(':user_id' => $user_id, ':post_type' => $post_type, ':post_text' => $post_text, ':link' => $link));

          } catch (PDOException $ex) {



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

    }

  } else {

    $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

  }

}

 ?>
