<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->storeOC($_POST['rutidOC'],$_POST['grupoOC'],$_POST['tipoOC'],$_POST['NumeroOC'],$_POST['FechaOC']);
	echo $ToReturn;
?>