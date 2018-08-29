<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->deleteFactura($_POST['rutid'],$_POST['grupo'],$_POST['tipo']);
	
?>