<?php 

	include("../../class/clase_cliente/ClaseCliente.php");

	$ClaseCliente = new ClaseCliente();
	$ClaseCliente->deleteClase($_POST['id']);
	
?>