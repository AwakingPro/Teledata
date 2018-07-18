<?php

	include("../../class/inventario/egresos/EgresoClass.php");

	$query = "INSERT INTO servicio_internet (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$_POST['idServicio']."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."')";
	$run = new Method;
	$data = $run->insert($query);
	
	$Egreso = new Egreso();
	$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$_POST['idServicio']);
	echo $data;
 ?>