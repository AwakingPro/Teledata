<?php 

	include("../../class/clase_cliente/ClaseCliente.php");

	$ClaseCliente = new ClaseCliente();
	$ClaseCliente->updateClase($_POST['nombre'], $_POST['limite_facturas'], $_POST['id']);
	
?>