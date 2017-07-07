<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->GuardarServicio($_POST['codigo'],$_POST['cantidad'],$_POST['exencion']);
	
?>    