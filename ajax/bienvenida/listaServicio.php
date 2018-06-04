<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = 'SELECT
		servicios.Id,
		servicios.Codigo,
		servicios.TiepoFacturacion as "Tiempo de Facturacion",
		mantenedor_tipo_factura.descripcion as Descripcion,
		servicios.Grupo
		FROM
		servicios
		LEFT JOIN mantenedor_tipo_factura ON servicios.TipoFactura = mantenedor_tipo_factura.codigo
	WHERE
		servicios.IdUsuarioSession ='.$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;

 ?>
