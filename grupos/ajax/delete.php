<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$result = $operation -> query('DELETE FROM grupos WHERE IdGrupo = '.$_POST['id']);
	$result = $operation -> query('DELETE FROM grupos_empresas WHERE IdGrupo = '.$_POST['id']);
	$result = $operation -> query('DELETE FROM grupos_personas WHERE IdGrupo = '.$_POST['id']);
 	echo $result;
 ?>