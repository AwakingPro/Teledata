<?php 

	include("../../class/descuentos/DescuentoClass.php");

	$Descuento = new Descuento();
	$Descuento->storeDescuento($_POST['Rut'],$_POST['IdServicio'],$_POST['Porcentaje'],$_POST['Cantidad'],$_POST['IdTicket']);
	
?>