<?php 

include("../../class/methods_global/methods.php");

$Global = new Method();
if(isset($_POST['idUsuarioSession'])){
    $idUsuarioSession = $_POST['idUsuarioSession'];
}
if(isset($_POST['tiempoUltimaRecarga'])){
    $tiempoUltimaRecarga = $_POST['tiempoUltimaRecarga'];
}
$estado = $Global->setTiempoUltimaRecarga($idUsuarioSession, $tiempoUltimaRecarga);
echo json_encode($estado);
	
?>   