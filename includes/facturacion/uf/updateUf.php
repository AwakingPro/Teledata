<?php 

	include("../../../class/facturacion/uf/UfClass.php");

	$Uf = new Uf();
	$Uf->updateUf($_POST['mes'], $_POST['valor'], $_POST['id']);
	
?>