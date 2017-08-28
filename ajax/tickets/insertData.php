<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO tickets (IdCliente, Origen, Departamento, Tipo, Subtipo, Prioridad, AsignarA, Estado, FechaCreasion, IdServicios, Observaciones) VALUES ('".$_POST['Cliente']."','".$_POST['Origen']."','".$_POST['Departamento']."','".$_POST['Tipo']."','".$_POST['Subtipo']."','".$_POST['Prioridad']."','".$_POST['AsignarA']."','".$_POST['Estado']."','".date("Y-m-d H:i:s")."','".$_POST['Servicio']."','".$_POST['Observaciones']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>