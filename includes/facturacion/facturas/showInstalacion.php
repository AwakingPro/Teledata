<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->showInstalacion($_POST['rut'],$_POST['grupo']);
	
?>