<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->getServiciosFacturados($_POST['RUT']);
	
?>