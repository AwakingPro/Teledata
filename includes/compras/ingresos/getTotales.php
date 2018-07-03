<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->getTotales($_POST['startDate'],$_POST['endDate']);
	
?>    