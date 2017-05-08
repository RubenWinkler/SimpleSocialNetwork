<?php
// Ein PHP-Skript, welches die nötigen Parameter definiert, um E-Mails über verschiedene Clients zu versenden.
// Quelle: Udemy-Kurs: Complete Login and Registration System with PHP & MySQL (Lektion 25)
require 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->IsHTML(true);


$mail->SMTPAuth = true;
$mail->Username = "your_gmail_user_name@gmail.com";
$mail->Password = "your_gmail_password";

//Sender Info
$mail->From = "no-reply@ictdesignhub.com";
$mail->FromName = "User Authentication";
