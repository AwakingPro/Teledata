<?php 

include("../../class/methods_global/methods.php");

$Global = new Method();
if(isset($_POST['idUsuarioSession'])){
    $idUsuarioSession = $_POST['idUsuarioSession'];
}

$estado = $Global->getEstadoMainNav($idUsuarioSession);
echo json_encode($estado);
	
?>   