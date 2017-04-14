<?php 
include("mail/class.phpmailer.php");
include("mail/class.smtp.php");
$directorio = "/home/foco/ftp/";
$cedente = "48";
$factura = "4977713.pdf";
$ruta = $directorio.$cedente."/".$factura;

$registro="Estimados Adjunto Factura";


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "mail.cobranding.cl";
$mail->Username = "foco@cobranding.cl";
$mail->Password = "m9a7r5s3";
$mail->From = "foco@cobranding.cl";
$mail->FromName = "Foco Estrategico";
$mail->Subject = "Foco | Software de Estrategia de Cobranza";
$mail->MsgHTML($registro);

$mail->addAttachment($ruta);
$mail->AddAddress("redes@cobranding.cl", "Luis Ponce");
$mail->IsHTML(true);

if(!$mail->Send()) {

  echo "Error: " . $mail->ErrorInfo;

} else {

echo "OK";
}


?>