<?php 

	include("../../class/tareas/TareaClass.php");

	$Tarea = new Tarea();
	$Tarea->reasignarTarea($_POST['Id'],$_POST['IdUsuarioAsignado']);
	
?>     