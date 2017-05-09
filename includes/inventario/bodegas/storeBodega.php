<?php 

	include("../../../class/inventario/bodegas/BodegaClass.php");

	$Bodega = new Bodega();
	$Bodega->CrearBodega($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo']);
	
?>    