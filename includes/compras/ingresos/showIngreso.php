<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->showIngreso($_POST['startDate'],$_POST['endDate']);
	
?>    