<?php
include_once("./../src/php/login_system/session.php");
include_once("./../src/php/login_system/database_connection.php");
include_once("./../src/php/login_system/utilities.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <!-- Die folgenden 3 Meta-Tags müssen als erste im Header erscheinen. Alles andere im Header muss nach diesen Meta-Tags kommen! -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- DIVISION Network Meta -->
  <title><?php if (isset($page_title)) {echo $page_title;} else {echo "DIVISION Network";} ?></title>
  <meta name="description" content="Social Network und YouTube-Blog">
  <meta name="author" content="DIVISION Network">
  <!-- jQuery -->
  <script src="./../src/jquery/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./../src/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./../src/font-awesome/css/font-awesome.min.css">
  <!-- Sweetalert -->
  <script src="./../src/sweetalert/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./../src/sweetalert/sweetalert.css">
  <!-- DIVISION Network Stylesheet -->
  <link rel="stylesheet" htype="text/css" href="./../src/css/styles.css">
  <!-- DIVISION Network Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="./../src/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./../src/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./../src/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./../src/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./../src/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./../src/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./../src/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./../src/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./../src/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="./../src/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./../src/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./../src/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./../src/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>
<body class="container-fluid" id="body">
