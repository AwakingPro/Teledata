<?php 

	include("../../class/bodegas/BodegaClass.php");

	$Bodega = new Bodega();
	$Bodega->updateBodega($_POST['nombre'],$_POST['direccion'], $_POST['id']);
	
?>      