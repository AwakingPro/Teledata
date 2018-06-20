<?php 

	include("../../class/clase_cliente/ClaseCliente.php");

	$ClaseCliente = new ClaseCliente();
	$ClaseCliente->storeClase($_POST['nombre'], $_POST['limite_facturas']);
	
?>