<?php
	session_start();
	require_once('../../db/db.php');
	$resultado = mysql_query('UPDATE grupos SET Nombre="'.$_POST['nombre'].'" WHERE IdGrupo="'.$_POST['id'].'"');
 	$personas = explode(",", $_POST['personas']);
 	$empresas = explode(",", $_POST['empresas']);
 	if ($resultado) {
 		mysql_query('DELETE FROM grupos_empresas WHERE IdGrupo = '.$_POST['id']);
		mysql_query('DELETE FROM grupos_personas WHERE IdGrupo = '.$_POST['id']);
 		for ($i=0; $i < count($personas); $i++) {
			$resultado = mysql_query('INSERT INTO grupos_personas (IdGrupo, Rut) VALUES ("'.$_POST['id'].'", "'.$personas[$i].'")');
 		}
 		for ($i=0; $i < count($empresas); $i++) {
			$resultado = mysql_query('INSERT INTO grupos_empresas (IdGrupo, IdEmpresaExterna) VALUES ("'.$_POST['id'].'", "'.$empresas[$i].'")');
 		}
 	}
 ?>