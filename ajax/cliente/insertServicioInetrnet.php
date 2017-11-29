<?php
	require_once('../../class/methods_global/methods.php');

	$fechaInstalacion = $_POST['fechaInstalacion'];
	if($fechaInstalacion){
    	$fechaInstalacion = DateTime::createFromFormat('d-m-Y', $fechaInstalacion)->format('Y-m-d');
    }else{
    	$fechaInstalacion = '1969-01-31';
    }

	$query = "INSERT INTO servicio_internet (IdServivio, FechaInstalacion, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$_POST['idServicio']."', '".$fechaInstalacion."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."')";
	$data = $run->insert($query);
	$Egreso = new Egreso();
	$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$id);
	echo $data;
 ?>