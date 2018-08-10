<?php
	require_once('../../class/methods_global/methods.php');

	$Velocidad = $_POST['velocidad'];
	$Plan = $_POST['plan'];
	if(isset($_POST['producto_id'])){
		$IdProducto = $_POST['producto_id'] ? trim($_POST['producto_id']) : "0";
		$TipoDestino = $_POST['destino_tipo'] ? trim($_POST['destino_tipo']) : "0";
		$IdOrigen = $_POST['origen_id'] ? trim($_POST['origen_id']) : "0";
	}else{
		$IdProducto = '0';
		$TipoDestino = '0';
		$IdOrigen = '0';
	}
	$query = "INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$_POST['idServicio']."', '".$Velocidad."', '".$Plan."', '".$IdOrigen."', '".$IdProducto."', '".$TipoDestino."')";
	$run = new Method;
	$data = $run->insert($query);
	if($data && $IdProducto){		
		include("../../class/inventario/egresos/EgresoClass.php");
		$Egreso = new Egreso();
		$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$_POST['idServicio']);
	}
	echo $data;
?>