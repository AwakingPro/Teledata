<?php
	require_once('../../../class/methods_global/methods.php');
	$query = "SELECT *
	FROM
		mantenedor_proveedores
	WHERE
		rut = '".$_POST['rut']."'";
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>