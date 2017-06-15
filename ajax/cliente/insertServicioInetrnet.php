<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO servicio_internet (EstacionNodo, MacRouter, MacAntena, IPRouter, IPAntena, FechaInstalacion, TecnicoInstalador, Velocidad, Plan, EstadoServicio, SeñalInstalacion, SeñalActual, DireccionIPAP, CoordenadasLatitud, CoordenadasLongitud) VALUES ('".$_POST['nodo']."', '".$_POST['macRouter']."', '".$_POST['macAntena']."', '".$_POST['ipRouter']."', '".$_POST['ipAntena']."', '".$_POST['fechaInstalacion']."', '".$_POST['tecnicoInstalador']."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['estadoServicio']."', '".$_POST['señalInstalacion']."', '".$_POST['señalActual']."', '".$_POST['ipAn']."', '".$_POST['latitud']."', '".$_POST['longitud']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $query;
 ?>