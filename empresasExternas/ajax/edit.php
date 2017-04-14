<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT IdEmpresaExterna, Nombre, Telefono, Correo, Direccion FROM empresa_externa WHERE IdEmpresaExterna = ".$_POST['id']);
	echo json_encode($rows);

 ?>