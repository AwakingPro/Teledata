<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	echo json_encode($Factura->getTotales());
	
?>   