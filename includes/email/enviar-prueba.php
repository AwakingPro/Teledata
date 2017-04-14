<?php 
require("PHPMailer-master/class.phpmailer.php"); 
require("PHPMailer-master/class.smtp.php"); 
include("../../class/email/email.php");

$contenido = $_POST['html'];
$asunto = $_POST['asunto'];
$destinatario = $_POST['to'];

$n = strpos($destinatario, ',');

$email = new Email;

if($n > 0){
	$destinatario = explode(',', $destinatario);
} 

$result = $email->SendTest($contenido, $asunto, $destinatario);

echo $result; ?>