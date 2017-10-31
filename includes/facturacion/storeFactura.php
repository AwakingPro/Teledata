<?php 

	include("../../class/facturacion/FacturaClass.php");

	$Factura = new Factura();
	$Factura->storeFactura($_POST['id']);
	
?>