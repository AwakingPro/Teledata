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
	if(isset($_POST['NumeroDocumento'])){
		$NumeroDocumento = $_POST['NumeroDocumento'];
	}else{
		$NumeroDocumento = '';
	}

	$Factura = new Factura();
	$Factura->filtrarFacturas($startDate, $endDate, $Rut, $documentType, $NumeroDocumento);
	
?>