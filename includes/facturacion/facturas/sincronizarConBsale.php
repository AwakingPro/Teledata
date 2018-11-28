<?php 

    include("/var/www/html/Teledata/class/facturacion/facturas/FacturaClass.php");
	// include("../../../class/facturacion/facturas/FacturaClass.php");
	// 20 minutos tiempo maximo de ejecucion del script
	ini_set('max_execution_time', 1200);
	$Factura = new Factura();
	$generar = $Factura->sincronizarConBsale();
	echo 'Llego';
	
?>