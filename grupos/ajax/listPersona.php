<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT Id_Personal, Nombre FROM Personal");
	$lista = "<option value='' >Seleccione...</option>";
	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= '<option value ="'.$rows[$i]['Id_Personal'].'">'.$rows[$i]['Nombre'].'</option>';
	}
	echo $lista;

 ?>