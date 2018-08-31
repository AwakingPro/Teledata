<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT id,
    contacto as Nombre,
    tipo_contacto as Tipo,
    correo as Correo,
    telefono as Teléfono
	FROM
	contactos
	WHERE
		id_persona = ".$_POST['id']." ORDER BY id DESC ";
    $run = new Method;
    $tipo = '';
	$lista = $run->listViewContactos($query,$_POST['id'], $tipo);
	$lista_json = json_encode($lista);
	echo $lista_json;
 ?>