<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = 'SELECT
		servicios.Id,
		servicios.Codigo,
		mantenedor_tipo_facturacion.nombre as "Tiempo de Facturacion",
		mantenedor_tipo_factura.descripcion as Descripcion,
		COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS Grupo
		FROM
		servicios
		INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_facturacion.id = servicios.TipoFacturacion 
		LEFT JOIN mantenedor_tipo_factura ON servicios.TipoFactura = mantenedor_tipo_factura.codigo
		LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo 
	WHERE
		servicios.IdUsuarioSession ='.$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;

 ?>
