<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$Radio = new NotaVenta();
	$Radio->showCodigos($_POST['personaempresa_id']);
	
?>