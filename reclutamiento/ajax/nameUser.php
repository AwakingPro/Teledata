<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT Username FROM usuarios_reclutamiento WHERE id = ".$_SESSION['idUsuario_reclutamiento']);
	$user = $rows[0]['Username'];
	echo $user;
 ?>