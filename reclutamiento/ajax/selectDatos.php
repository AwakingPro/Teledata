<?php
	include("../../class/db/DB.php");
	$db = new Db();
	$generales = $db -> select('SELECT * FROM datos_generales_reclutamiento WHERE IdUsuarioReclutamiento = '.$_SESSION["idUsuario_reclutamiento"]);
	$domicilio = $db -> select('SELECT * FROM domicilio_reclutamiento WHERE IdUsuarioReclutamiento = '.$_SESSION["idUsuario_reclutamiento"]);
	$contactos = $db -> select('SELECT * FROM contactos_reclutamiento WHERE IdUsuarioReclutamiento = '.$_SESSION["idUsuario_reclutamiento"]);
	$previcionales = $db -> select('SELECT * FROM datos_personales_reclutamiento WHERE IdUsuarioReclutamiento = '.$_SESSION["idUsuario_reclutamiento"]);
	echo json_encode(array ($generales, $domicilio, $contactos, $previcionales,$_SESSION["idUsuario_reclutamiento"]));
?>