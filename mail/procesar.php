<?php 
include("mail/class.phpmailer.php");
include("mail/class.smtp.php");
include("config.php");

$nombre=$_POST['nombre'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$como=$_POST['como'];
$comentario=$_POST['comentario'];
$fecha=date("Y-m-d");
$hora=date("G:H:s");

$query = "INSERT INTO contactos(nombre,direccion, telefono, correo,como, comentario, fecha, hora) VALUES ('$nombre','$direccion','$telefono','$correo','$como','$comentario','$fecha','$hora')";
$result = mysql_query($query);



$registro="<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Spot Manager</title>
<style type='text/css'>
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
.FONT {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>

<body bgcolor='#ffffff' text='#000000' link='#0000ff' vlink='#0000ff' alink='#0000ff'>

<table border='0' cellpadding='5' cellspacing='1' width='100%'>
  <tr>
    <td colspan=2 bgcolor='#2385A1' ><font face='verdana' font color='#FFFFFF' size='2'><b>Asunto</b></font></td>
  </tr>
  <tr>
      <td colspan=2 bgcolor='#F9F9F5'><font face='verdana' size='2'>Contacto Via Web a traves del Formulario</font></td>
   </tr>
  <tr>
      <td colspan=2 bgcolor='#2385A1'><b><font color='#FFFFFF'  >Detalle de Cliente</font></b></td>
    </tr>
  <tr>
    <td bgcolor='#FFE2C6'><font face='verdana' size='2'>Nombre</font></td>
    <td bgcolor'#F9F9F5'>$nombre</td>
  </tr>
  <tr>
    <td bgcolor='#FFE2C6'><font face='verdana' size='2'>Correo</font></td>
    <td bgcolor='#F9F9F5'>$correo</td>
  </tr>
  <tr>
    <td bgcolor='#FFE2C6'><font face='verdana' size='2'>Telefono</font></td>
    <td bgcolor='#F9F9F5'>$telefono</td>
  </tr>
    <tr>
         <td colspan=2 bgcolor='#2385A1'><font color='#FFFFFF'  class='FONT'   ><b>Comentario</b></font></td>
    </tr>
  <tr>
    <td width='121' bgcolor='#E8FFF3'>
      <font face='verdana' size='2'>Mensaje</font></td>
    <td width='1291' bgcolor'#F9F9F5'>$comentario</td>
  </tr>
</table>



<table border='0' cellpadding='5' cellspacing='1' width='100%'>
<tr>
     <td align='right' bgcolor='#000000'>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <p align='right'><font face='verdana' size='2' color='#999999'><b>LAVADO DE ALFOMBRAS </b></font></td>
  </tr>
</table>

</body>

</html>";  







$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "mail.cobranding.cl";
$mail->Username = "redes@cobranding.cl";
$mail->Password = "M9a7r5s3A";
$mail->From = "redes@cobranding.cl";
$mail->FromName = "Formulario de Contacto Lavado de Alfombras";
$mail->Subject = "Nuevo Contacto via Web";
$mail->MsgHTML($registro);

$mail->AddAttachment("ruta-del-archivo/archivo.zip");
$mail->AddAddress("redes@cobranding.cl", "Luis Ponce");
$mail->AddAddress("jleiva@cobranding.cl", "Jorge Leiva");

$mail->IsHTML(true);

if(!$mail->Send()) {

  echo "Error: " . $mail->ErrorInfo;

} else {

echo "OK";
}




header("Location: contacto.php");

		

?>