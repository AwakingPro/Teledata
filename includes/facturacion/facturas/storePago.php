<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	$detalle = '';
	if(!isset($_POST['Detalle']))
	$detalle = '';
	else
	$detalle = $_POST['Detalle'];

	$Factura = new Factura();
	$ToReturn = $Factura->storePago($_POST['FacturaId'],$_POST['FechaPago'],$_POST['TipoPago'],$detalle,$_POST['Monto'],$_POST['FechaEmisionCheque'],$_POST['FechaVencimientoCheque']);
	echo $ToReturn;
?>