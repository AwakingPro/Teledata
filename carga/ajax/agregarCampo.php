<?php
	require_once('../../db/db.php');
	$resultado = mysql_query("alter table ".$_POST['tabla']." add ".$_POST['nombre']." ".$_POST['tipo']);
	if ($resultado) {
		$table = $_POST['tabla'];
		$ArrayTabla = explode("_",$table);
		switch($ArrayTabla[0]){
			case 'Deuda':
				mysql_query("alter table Deuda_Historico add ".$_POST['nombre']." ".$_POST['tipo']);
				mysql_query("alter table ".$ArrayTabla[0]." add ".$_POST['nombre']." ".$_POST['tipo']);
			break;
			default:
				mysql_query("alter table ".$ArrayTabla[0]." add ".$_POST['nombre']." ".$_POST['tipo']);
			break;
		}
	}
 ?>