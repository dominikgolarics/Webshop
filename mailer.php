<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';

$mail->Host       = 'smtp.gmail.com';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->Username   = 'nilewebshop@gmail.com'; // saját Gmail-címed
$mail->Password   = 'gtva olom xdjh iaiw'; // alkalmazásjelszó (nem a rendes jelszó!)

$mail->isHtml(true);

return $mail;