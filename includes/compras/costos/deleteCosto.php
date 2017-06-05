<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$Costo->deleteCosto($_POST['id']);
	
?>      