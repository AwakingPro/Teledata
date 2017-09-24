<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->GuardarServicio($_POST['codigo'],$_POST['servicio'],$_POST['cantidad'],$_POST['precio'],$_POST['rut_tmp']);

?>    