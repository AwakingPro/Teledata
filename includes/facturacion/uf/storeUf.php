<?php 

	include("../../../class/facturacion/uf/UfClass.php");

	$Uf = new Uf();
	$Uf->storeUf($_POST['mes'], $_POST['valor']);
	
?>