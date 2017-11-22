<?php
	require_once('../../class/methods_global/methods.php');
	$Id = isset($_POST['id']) ? trim($_POST['id']) : "";
	$query = "UPDATE `servicios` set `FacturarSinInstalacion` = '1' where `Id` = '$Id'";
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>