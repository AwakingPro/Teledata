<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = ".$_POST['id']);
	$data[0] = $rows[0]['IdGrupo'];
	$data[1] = $rows[0]['Nombre'];
	$rows = $operation -> select("SELECT personal.Id_Personal, personal.Nombre FROM grupos_personas INNER JOIN personal ON grupos_personas.Rut = personal.Id_Personal WHERE grupos_personas.IdGrupo = ".$_POST['id']);
	$lista = "";
	$num = count($rows);
	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= "<div class='row t1'><div class='col-md-3 form-group'><span att='".$rows[$i]['Id_Personal']."' class='form-control bg-info personasGr'>".$rows[$i]['Nombre']."</span></div><div class='col-md-1'><button type='button' class='btn btn-danger dlt'><i class='ti-close'></i></button></div></div>";
	}
	$rows = $operation -> select("SELECT empresa_externa.IdEmpresaExterna, empresa_externa.Nombre FROM grupos_empresas INNER JOIN empresa_externa ON grupos_empresas.IdEmpresaExterna = empresa_externa.IdEmpresaExterna WHERE grupos_empresas.IdGrupo = ".$_POST['id']);
	$lista2 = "";
	$num2 = count($rows);
	for ($i=0; $i < count($rows) ; $i++) {
		$lista2.= "<div class='row t1'><div class='col-md-3 form-group'><span att='".$rows[$i]['IdEmpresaExterna']."' class='form-control bg-info personasGr'>".$rows[$i]['Nombre']."</span></div><div class='col-md-1'><button type='button' class='btn btn-danger dlt'><i class='ti-close'></i></button></div></div>";
	}
	$listas[0] = $lista;
	$listas[1] = $lista2;
	$listas[2] = $data;
	$listas[3] = $num;
	$listas[4] = $num2;
	echo json_encode($listas);
 ?>