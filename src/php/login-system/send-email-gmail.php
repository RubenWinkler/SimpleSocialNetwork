<?php
// Ein PHP-Skript, welches die nötigen Parameter definiert, um E-Mails über einen Gmail-Account zu versenden.
// Quelle: Udemy-Kurs: Complete Login and Registration System with PHP & MySQL (Lektion 25)
require 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Port = 465;
$mail->Host = 'smtp.gmail.com';
$mail->IsHTML(true);
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'ssl';

$mail->SMTPAuth = true;
$mail->Username = "divisionnetworkde@gmail.com";
$mail->Password = "C3t3risP4ribus";

//Sender Info
$mail->From = "no-reply@division-network.com";
$mail->FromName = "DIVISION Network";
