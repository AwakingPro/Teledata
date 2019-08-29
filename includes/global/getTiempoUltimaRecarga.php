<?php 

include("../../class/methods_global/methods.php");

$Global = new Method();
if(isset($_POST['idUsuarioSession'])){
    $idUsuarioSession = $_POST['idUsuarioSession'];
}

$tiempo = $Global->getTiempoUltimaRecarga($idUsuarioSession);

echo json_decode($tiempo);
	
?>   