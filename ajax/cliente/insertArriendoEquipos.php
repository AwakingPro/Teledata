<?php
	include("../../class/inventario/egresos/EgresoClass.php");

	$fechaInstalacion = $_POST['fechaInstalacion'];
	if($fechaInstalacion){
    	$fechaInstalacion = DateTime::createFromFormat('d-m-Y', $fechaInstalacion)->format('Y-m-d');
    }else{
    	$fechaInstalacion = '1969-01-31';
    }

	$query = "INSERT INTO arriendo_equipos_datos (IdServivio, FechaInstalacion, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$_POST['destino_id']."', '".$fechaInstalacion."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."')";
	$run = new Method;
	$data = $run->insert($query);

	$Egreso = new Egreso();
	$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$_POST['destino_id']);

?>