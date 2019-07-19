<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	$Factura = new Factura();
	$Factura->getSaldoFavor($_POST['Rut']);
?>