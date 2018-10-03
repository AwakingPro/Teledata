<?php
	require_once('../../class/methods_global/methods.php');
	$id = $_POST['id'];
	$query = "	SELECT
					c.id,
					c.contacto AS Nombre,
					mtc.nombre AS Tipo,
					c.correo AS Correo,
					c.telefono AS Teléfono 
				FROM
					contactos c
					INNER JOIN mantenedor_tipo_contacto mtc ON c.tipo_contacto = mtc.id 
					INNER JOIN personaempresa p ON c.rut = p.rut
				WHERE
					p.id = '".$id."'
				ORDER BY
					c.id DESC";
    $run = new Method;
    $tipo = '';
	$lista = $run->listViewContactos($query,$id, $tipo);
	$lista_json = json_encode($lista);
	echo $lista_json;
 ?>