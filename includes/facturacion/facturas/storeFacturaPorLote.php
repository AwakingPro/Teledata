<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->storeFacturaPorLote($_POST['facturas']);
	
?>