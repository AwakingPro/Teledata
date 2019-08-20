<?php 

	include("/var/www/html/Teledata/class/facturacion/facturas/FacturaClass.php");
	// include("../../../class/facturacion/facturas/FacturaClass.php");
	$Factura = new Factura();
	echo $Factura->verificarDescuentosTemporales();
?>