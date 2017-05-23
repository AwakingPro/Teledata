<?php 

	include("../../../class/inventario/bodegas/BodegaClass.php");

	$Bodega = new Bodega();
	$Bodega->deleteBodega($_POST['id']);
	
?>      