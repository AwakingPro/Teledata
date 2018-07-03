<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->storePago($_POST['CompraId'],$_POST['FechaPago'],$_POST['TipoPago'],$_POST['Detalle'],$_POST['Monto'],$_POST['FechaEmisionCheque'],$_POST['FechaVencimientoCheque']);
	
?>    