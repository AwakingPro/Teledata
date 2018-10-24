<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO tickets (IdCliente, Origen, Departamento, Tipo, Subtipo, Prioridad, AsignarA, Estado, FechaCreacion, IdServicios, Observaciones, IdUsuarioSession, Clase) VALUES ('".$_POST['Cliente']."','".$_POST['Origen']."','".$_POST['Departamento']."','".$_POST['Tipo']."','".$_POST['Subtipo']."','".$_POST['Prioridad']."','".$_POST['AsignarA']."','".$_POST['Estado']."',NOW(),'".$_POST['Servicio']."','".$_POST['Observaciones']."','".$_SESSION['idUsuario']."','".$_POST['Clase']."')";
	
	$data = $run->insert($query);
	echo $data;
 ?>