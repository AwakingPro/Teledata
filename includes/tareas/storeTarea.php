<?php 

	include("../../class/tareas/TareaClass.php");
	include("../../class/facturacion/uf/UfClass.php");

	$Tarea = new Tarea();
	$Tarea->storeTarea($_POST['Id'],$_POST['FechaInstalacion'],$_POST['InstaladoPor'],$_POST['Comentario'],$_POST['UsuarioPppoe'],$_POST['SenalFinal'],$_POST['EstacionFinal'],$_POST['Estatus'], $_POST['actualizaFechaUltimoCobro']);
	
?>     