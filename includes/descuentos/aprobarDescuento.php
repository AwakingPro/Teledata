<?php 

	include("../../class/descuentos/DescuentoClass.php");

	$Descuento = new Descuento();
	$Descuento->aprobarDescuento($_POST['id']);
	
?>   