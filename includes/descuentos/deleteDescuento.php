<?php 

	include("../../class/descuentos/DescuentoClass.php");

	$Descuento = new Descuento();
	$Descuento->deleteDescuento($_POST['id']);
	
?>   