<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->storeDevolucion($_POST['FacturaIdDevolucion'],$_POST['Motivo']);
	
?>