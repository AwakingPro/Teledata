<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	$Factura = new Factura();
	$Factura->getDocsVencidos($_POST['Rut']);
?>