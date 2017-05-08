<?php 

	include("../../class/bodegas/BodegaClass.php");

	$Bodega = new Bodega();
	$Bodega->CrearBodega($_POST['nombre'],$_POST['direccion']);
	
?>    