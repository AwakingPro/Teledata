<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$result = $operation -> query('DELETE FROM empresa_externa WHERE IdEmpresaExterna = '.$_POST['id']);
 	echo $result;
 ?>