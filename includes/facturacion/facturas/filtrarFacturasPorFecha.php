<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->filtrarFacturasPorFecha($_POST['startDate'],$_POST['endDate']);
	
?>