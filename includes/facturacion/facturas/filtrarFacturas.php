<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	if(isset($_POST['documentType'])){
		$documentType = $_POST['documentType'];
	}else{
		$documentType = '';
	}
	if(isset($_POST['startDate']) && $_POST['startDate'] != '' && isset($_POST['endDate']) && $_POST['endDate'] != ''){
		$startDate = $_POST['startDate'];
		$dt = \DateTime::createFromFormat('d-m-Y',$startDate);
		$startDate = $dt->format('Y-m-d');
		$endDate = $_POST['endDate'];
		$dt = \DateTime::createFromFormat('d-m-Y',$endDate);
		$endDate = $dt->format('Y-m-d');
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