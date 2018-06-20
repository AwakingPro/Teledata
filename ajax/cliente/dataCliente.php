<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id, rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono
	FROM
		personaempresa
	WHERE
		rut ='.$_POST['rut'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {

		$data1 = ($data[0][0] != '') ? $data[0][0]: 'No hay data';
		$data2 = ($data[0][1] != '') ? $data[0][1]: 'No hay data';
		$data3 = ($data[0][2] != '') ? $data[0][2]: 'No hay data';
		$data4 = ($data[0][3] != '') ? $data[0][3]: 'No hay data';
		$data5 = ($data[0][4] != '') ? $data[0][4]: 'No hay data';
		$data6 = ($data[0][5] != '') ? $data[0][5]: 'No hay data';
		$data7 = ($data[0][6] != '') ? $data[0][6]: 'No hay data';
		$data8 = ($data[0][7] != '') ? $data[0][7]: 'No hay data';
		$data9 = ($data[0][8] != '') ? $data[0][8]: 'No hay data';
		$data10 = ($data[0][9] != '') ? $data[0][9]: 'No hay data';

		$DataFacturacion = '<div class="row">
				<div class="col-md-4 form-group">
					<label>Id Cliente</label>
					<span class="form-control">'.$data1.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Rut</label>
					<span class="form-control">'.$data2.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Dv</label>
					<span class="form-control">'.$data3.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Nombre</label>
					<span class="form-control">'.$data4.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Giro</label>
					<span class="form-control">'.$data5.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Direccion</label>
					<span class="form-control">'.$data6.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Correo</label>
					<span class="form-control">'.$data7.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Contacto</label>
					<span class="form-control">'.$data8.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Comentarios</label>
					<span class="form-control">'.$data9.'</span>
				</div>
				<div class="col-md-4 form-group">
					<label>Telefono</label>
					<span class="form-control">'.$data10.'</span>
				</div>
			</div>';
	}else{
		$DataFacturacion = 'false';
	}

	$query = 'SELECT
		servicios.Id as Id,
		servicios.Codigo as "Codigo de Servicios",
		mantenedor_tipo_facturacion.nombre as "Tiempo de Facturacion",
		mantenedor_servicios.servicio as "Tipo de Servicio",
		servicios.Valor,
		COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS Grupo,
		IF(FechaActivacion IS NULL, "Activo", "Inactivo") as Estatus
		FROM
		servicios
		INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_facturacion.id = servicios.TipoFacturacion 
		LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
		LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo 
	WHERE
		servicios.Rut ='.$_POST['rut'];
	$run = new Method;
	$lista = $run->listViewServicios($query);
	$listaServicios =  $lista;

	echo json_encode(array($DataFacturacion, $listaServicios));
 ?>