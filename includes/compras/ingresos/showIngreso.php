<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$startDate = '';
	$endDate = '';
	if (isset($_POST['startDate']) && $_POST['startDate'] != '' && isset($_POST['endDate']) && $_POST['endDate'] != '') {
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
	}else{
		$startDate = '';
		$endDate = '';
	}
	$Ingreso->showIngreso($startDate,$endDate);
	
?>    