<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					c.id,
					c.contacto AS Nombre,
					mtc.nombre AS Tipo,
					c.correo AS Correo,
					c.telefono AS Teléfono 
				FROM
					contactos c
					INNER JOIN mantenedor_tipo_contacto mtc ON c.tipo_contacto = mtc.id 
				WHERE
					c.id_persona = ".$_POST['id']." 
				ORDER BY
					c.id DESC";
    $run = new Method;
    $tipo = '';
	$lista = $run->listViewContactos($query,$_POST['id'], $tipo);
	$lista_json = json_encode($lista);
	echo $lista_json;
 ?>