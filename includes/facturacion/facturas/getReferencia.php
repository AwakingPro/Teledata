<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->getReferencia($_POST['rutid'],$_POST['grupo'],$_POST['tipo']);
	echo json_encode($ToReturn);
?>