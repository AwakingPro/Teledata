<?php 

    include("/var/www/html/Teledata/class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$generar = $Factura->sincronizarConBsale();
	
?>