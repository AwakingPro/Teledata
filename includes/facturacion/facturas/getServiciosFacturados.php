<?php 

	// include("../../../class/facturacion/facturas/FacturaClass.php");
	include("/var/www/html/Teledata/class/facturacion/facturas/FacturaClass.php");
	$Factura = new Factura();
	
	$ToReturn = $Factura->getServiciosFacturados($_POST['RUT']);
	echo $ToReturn;
	
	
?>