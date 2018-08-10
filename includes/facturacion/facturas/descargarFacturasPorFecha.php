<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
    if(isset($_GET['documentType'])){
		$documentType = $_GET['documentType'];
	}else{
		$documentType = '';
	}
	$Factura = new Factura();
	$Factura->descargarFacturasPorFecha($_GET['startDate'],$_GET['endDate'],$documentType);
	
?>