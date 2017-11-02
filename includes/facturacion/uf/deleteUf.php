<?php 

	include("../../../class/facturacion/uf/UfClass.php");

	$Uf = new Uf();
	$Uf->deleteUf($_POST['id']);
	
?>