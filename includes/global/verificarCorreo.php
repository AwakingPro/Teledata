<?php 

include("../../class/methods_global/methods.php");

$Global = new Method();
$correo = $Global->verificarCorreo($_POST['CorreoVerificador']);
echo json_encode($correo);
	
?>   