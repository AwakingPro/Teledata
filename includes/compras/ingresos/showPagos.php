<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->showPagos($_POST['id']);
	
?>    