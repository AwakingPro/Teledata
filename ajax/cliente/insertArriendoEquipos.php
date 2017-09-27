<?php
	include("../../class/inventario/egresos/EgresoClass.php");

	$query = "INSERT INTO arriendo_equipos_datos (IdOrigen, IdProducto, TipoDestino, IdServivio) VALUES ('".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."', '".$_POST['destino_id']."')";
	$run = new Method;
	$data = $run->insert($query);

	$Egreso = new Egreso();
	$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$_POST['destino_id']);




?>