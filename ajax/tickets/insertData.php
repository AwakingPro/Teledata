<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO tickets (IdCliente, Origen, Departamento, Tipo, Subtipo, Prioridad, AsignarA, Estado, FechaCreacion, IdServicios, Observaciones, IdUsuarioSession) VALUES ('".$_POST['Cliente']."','".$_POST['Origen']."','".$_POST['Departamento']."','".$_POST['Tipo']."','".$_POST['Subtipo']."','".$_POST['Prioridad']."','".$_POST['AsignarA']."','".$_POST['Estado']."',NOW(),'1','".$_POST['Observaciones']."', '".$_SESSION['idUsuario']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>