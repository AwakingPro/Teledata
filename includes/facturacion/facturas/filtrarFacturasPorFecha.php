<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	if(isset($_POST['documentType'])){
		$documentType = $_POST['documentType'];
	}else{
		$documentType = '';
	}

	$Factura = new Factura();
	$Factura->filtrarFacturasPorFecha($_POST['startDate'],$_POST['endDate'],$documentType);
	
?>