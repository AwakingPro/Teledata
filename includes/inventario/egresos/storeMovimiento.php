<?php 

	include("../../../class/inventario/egresos/EgresoClass.php");

	$Egreso = new Egreso();
	$Egreso->storeMovimiento($_POST['producto_id'],$_POST['origen_tipo'],$_POST['origen_id'],$_POST['destino_tipo'],$_POST['destino_id']);
	
?>    