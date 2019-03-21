<?php 

	include("../../class/tareas/TareaClass.php");

	$Tarea = new Tarea();
	if(isset($_POST['idUsuario']) && $_POST['idUsuario']){
		$idUsuario = $_POST['idUsuario'];
	}else{
		$idUsuario = 0;
	}
	$Tarea->showServicios($idUsuario);
	
?>   