<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->storeFactura($_POST['rutid'],$_POST['grupo'],$_POST['tipo']);
	
?>