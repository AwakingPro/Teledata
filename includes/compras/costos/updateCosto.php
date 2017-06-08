<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$Costo->updateCosto($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo'], $_POST['id']);
	
?>      