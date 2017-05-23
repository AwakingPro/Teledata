<?php 

	include("../../../class/inventario/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->deleteIngreso($_POST['id']);
	
?>    