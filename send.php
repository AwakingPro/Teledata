<?php

date_default_timezone_set('Etc/UTC');
require 'class/phpmailer/PHPMailerAutoload.php';
include("class/phpmailer/class.smtp.php");
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mail.cobranding.cl";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "foco@cobranding.cl";
//Password to use for SMTP authentication
$mail->Password = "m9a7r5s3";
//Set who the message is to be sent from
$mail->setFrom('foco@cobranding.cl', 'Luis Ponce');
//Set an alternative reply-to address
//Set who the message is to be sent to
$mail->addAddress('redes@cobranding.cl', 'John Doe');

$mail->Subject = 'PHPMailer SMTP test';
$mail->Body = 'Hello, this is my message.';

$mail->AltBody = 'This is a plain-text message body';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>