<?php 

include("../../class/methods_global/methods.php");

$Global = new Method();
if(isset($_POST['idUsuarioSession'])){
    $idUsuarioSession = $_POST['idUsuarioSession'];
}
if(isset($_POST['estado_actual'])){
    $estado_actual = $_POST['estado_actual'];
}
$response = $Global->setEstadoMainNav($idUsuarioSession, $estado_actual);
echo json_encode($response);
	
?>   