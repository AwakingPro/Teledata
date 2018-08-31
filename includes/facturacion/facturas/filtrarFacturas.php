<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	if(isset($_POST['documentType'])){
		$documentType = $_POST['documentType'];
	}else{
		$documentType = '';
	}
	if(isset($_POST['startDate'])){
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
	}else{
		$startDate = '';
		$endDate = '';
	}
	if(isset($_POST['Rut'])){
		$Rut = $_POST['Rut'];
	}else{
		$Rut = '';
	}

	$Factura = new Factura();
	$Factura->filtrarFacturas($startDate,$endDate,$Rut,$documentType);
	
?>