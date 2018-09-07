<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	if(isset($_POST['id'])) {
		$rut = explode("-", $_POST['id']);
		$rut[0];
		$query = "	SELECT
					servicios.Id AS Id,
					servicios.Codigo AS 'Codigo de Servicios',
					servicios.Conexion AS 'Conexión',
					-- mantenedor_tipo_facturacion.nombre AS 'Tiempo de Facturacion',
					servicios.Valor,
					COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS Grupo,
					( CASE WHEN FechaFinalDesactivacion IS NULL THEN 'Activo' WHEN FechaFinalDesactivacion = '2999-01-31' THEN 'Inactivo' ELSE 'Suspendido' END ) AS Estatus,
					( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE mantenedor_servicios.servicio END ) AS 'Tipo de Servicio' 
				FROM
					servicios
					INNER JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.id = servicios.TipoFactura
					INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_facturacion.id = mantenedor_tipo_factura.tipo_facturacion
					LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
					LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
				WHERE
					servicios.Rut = ".$rut[0];
		$listaServicios = $run->listViewServicios($query);
		echo json_encode($listaServicios);
	}
	
 ?>