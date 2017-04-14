<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT personal.Nombre FROM grupos_personas INNER JOIN personal ON grupos_personas.Rut = personal.Id_Personal WHERE grupos_personas.IdGrupo = ".$_POST['idgrupo']);
	$lista = "";
	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= '<div class="col-md-12">'.$rows[$i]['Nombre'].'</div>';
	}
	$rows = $operation -> select("SELECT empresa_externa.Nombre FROM grupos_empresas INNER JOIN empresa_externa ON grupos_empresas.IdEmpresaExterna = empresa_externa.IdEmpresaExterna WHERE grupos_empresas.IdGrupo = ".$_POST['idgrupo']);
	$lista2 = "";
	for ($i=0; $i < count($rows) ; $i++) {
		$lista2.= '<div class="col-md-12">'.$rows[$i]['Nombre'].'</div>';
	}
	$listas[0] = $lista;
	$listas[1] = $lista2;
	echo json_encode($listas);
 ?>