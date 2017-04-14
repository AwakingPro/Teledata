<?php
	session_start();
	require_once('../../db/db.php');
	$resultado = mysql_query('INSERT INTO grupos (Nombre,IdCedente) VALUES ("'.$_POST['nombre'].'", "'.$_SESSION['cedente'].'")');
 	$id =mysql_insert_id();
 	$personas = explode(",", $_POST['personas']);
 	$empresas = explode(",", $_POST['empresas']);
 	if ($resultado) {
 		for ($i=0; $i < count($personas); $i++) {
			$resultado = mysql_query('INSERT INTO grupos_personas (IdGrupo, Rut) VALUES ("'.$id.'", "'.$personas[$i].'")');
 		}
 		for ($i=0; $i < count($empresas); $i++) {
			$resultado = mysql_query('INSERT INTO grupos_empresas (IdGrupo, IdEmpresaExterna) VALUES ("'.$id.'", "'.$empresas[$i].'")');
 		}
 	}
 ?>