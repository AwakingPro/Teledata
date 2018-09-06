<?php
	$query_cliente = "SELECT id,
    nombre,
    correo,
    telefono
	FROM
	personaempresa
	WHERE
		id = $id_cliente ";
    $run = new Method;
    $tipo = '';
	$lista = $run->select($query_cliente);
	
 ?>