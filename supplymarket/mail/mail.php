<?php
//include("system/config.php");
include("mail/class.phpmailer.php");
include("mail/class.smtp.php");
 
$body="Hola";

$mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP:
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "mail.supplymarket.net"; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = "app@supplymarket.net"; // Correo completo a utilizar"
$mail->Password = "m9a7r5s3"; // Contraseña
$mail->Port = 25; // Puerto a utilizar
$mail->From = "app@supplymarket.net"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "APP";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
$mail->AddAddress("lponce1405@gmail.com"); // Esta es la dirección a donde enviamos
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Titulo"; // Este es el titulo del email.
$body = "Hola mundo. Esta es la primer línea<br />";
$body .= "Acá continuo el <strong>mensaje</strong>";
$mail->Body = $body; // Mensaje a enviar
$exito = $mail->Send(); // Envía el correo.

//También podríamos agregar simples verificaciones para saber si se envió:
if($exito){
echo "El correo fue enviado correctamente.";
}else{
echo "Hubo un inconveniente. Contacta a un administrador.";
}
?>