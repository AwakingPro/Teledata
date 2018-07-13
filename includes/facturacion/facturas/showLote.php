<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->showLote($_POST['rut'],$_POST['grupo']);
	
?>