<?php
// Ein PHP-Skript, welches die nötigen Parameter definiert, um E-Mails über einen Gmail-Account zu versenden.
// Quelle: Udemy-Kurs: Complete Login and Registration System with PHP & MySQL (Lektion 25)
require 'class.phpmailer.php';

$config = require __DIR__ . "/../../../config/app.php";

$transport = $config["mail"]["transport"];
$encryption = $config["mail"]["encryption"];
$port = $config["mail"]["port"];
$host = $config["mail"]["host"];
$email_username = $config["mail"]["username"];
$email_password = $config["mail"]["password"];
$from = $config["mail"]["from"];
$fromName = $config["mail"]["fromName"];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Port = $port;
$mail->Host = $host;
$mail->IsHTML(true);
$mail->Mailer = $transport;
$mail->SMTPSecure = $encryption;

$mail->SMTPAuth = true;
$mail->Username = $email_username;
$mail->Password = $email_password;

//Sender Info
$mail->From = $from;
$mail->FromName = $fromName;
