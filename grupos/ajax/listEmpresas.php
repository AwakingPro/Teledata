<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT IdEmpresaExterna, Nombre FROM empresa_externa");
	$lista = "<option value='' >Seleccione...</option>";
	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= '<option value ="'.$rows[$i]['IdEmpresaExterna'].'">'.$rows[$i]['Nombre'].'</option>';
	}
	echo $lista;
 ?>