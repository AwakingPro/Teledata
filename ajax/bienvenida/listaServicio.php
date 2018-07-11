<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = '	SELECT
					servicios.Id,
					servicios.Codigo,
					mantenedor_tipo_facturacion.nombre AS "Tiempo de Facturacion",
					mantenedor_tipo_factura.descripcion AS Descripcion,
					COALESCE (
						grupo_servicio.Nombre,
						servicios.Grupo
					) AS Grupo
				FROM
					servicios
				LEFT JOIN mantenedor_tipo_factura ON servicios.TipoFactura = mantenedor_tipo_factura.id
				LEFT JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_factura.tipo_facturacion = mantenedor_tipo_facturacion.id
				LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
				WHERE
					servicios.IdUsuarioSession = '.$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;

 ?>
