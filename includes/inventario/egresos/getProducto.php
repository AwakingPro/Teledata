<?php 

	include("../../../class/inventario/egresos/EgresoClass.php");

	$Egreso = new Egreso();
	$Egreso->getProducto($_POST['origen_tipo'],$_POST['origen_id']);
	
?>    