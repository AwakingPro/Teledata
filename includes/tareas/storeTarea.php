<?php 

	include("../../class/tareas/TareaClass.php");

	$Tarea = new Tarea();
	$Tarea->storeTarea($_POST['Id'],$_POST['FechaInstalacion'],$_POST['InstaladoPor'],$_POST['Comentario'],$_POST['UsuarioPppoe']);
	
?>     