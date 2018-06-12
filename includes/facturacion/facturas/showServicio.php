<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->showServicio($_POST['rut'],$_POST['grupo'],$_POST['tipo']);
	
?>