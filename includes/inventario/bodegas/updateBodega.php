<?php 

	include("../../../class/inventario/bodegas/BodegaClass.php");

	$Bodega = new Bodega();
	$Bodega->updateBodega($_POST['nombre'],$_POST['principal'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo'], $_POST['id']);
	
?>      