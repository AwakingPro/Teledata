<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->showFactura($_POST['id'],$_POST['tipo']);
	
?>