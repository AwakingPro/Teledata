<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$Radio = new NotaVenta();
	$Radio->showCliente($_POST['personaempresa_id']);
	
?>   