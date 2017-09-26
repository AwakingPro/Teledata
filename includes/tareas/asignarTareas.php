<?php 

	include("../../class/tareas/TareaClass.php");

	$Tarea = new Tarea();
	$Tarea->asignarTareas($_POST['Tareas'],$_POST['IdUsuarioAsignado']);
	
?>     