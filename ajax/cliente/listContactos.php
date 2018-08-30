<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT 
    contacto as Contaco,
    tipo_contacto as Tipo,
    correo as Correo,
    telefono as Teléfono
	FROM
	contactos
	WHERE
		id_persona = ".$_POST['id'];
    $run = new Method;
    $tipo = '';
	$lista = $run->listViewDelete($query,$_POST['id'], $tipo);
	$lista_json = json_encode($lista);
	echo $lista_json;
 ?>