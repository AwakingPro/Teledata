<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->deletePago($_POST['id']);
	
?>    