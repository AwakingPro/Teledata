<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id, rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono, tipo_cliente
	FROM
		personaempresa
	WHERE
		rut ='.$_POST['rut'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {

		$data1 = ($data[0][0] != '') ? $data[0][0]: '';
		$data2 = ($data[0][1] != '') ? $data[0][1]: '';
		$data3 = ($data[0][2] != '') ? $data[0][2]: '';
		$data4 = ($data[0][3] != '') ? $data[0][3]: '';
		$data5 = ($data[0][4] != '') ? $data[0][4]: '';
		$data6 = ($data[0][5] != '') ? $data[0][5]: '';
		$data7 = ($data[0][6] != '') ? $data[0][6]: '';
		$data8 = ($data[0][7] != '') ? $data[0][7]: '';
		$data9 = ($data[0][8] != '') ? $data[0][8]: '';
		$data10 = ($data[0][9] != '') ? $data[0][9]: '';
		$tipo_cliente = ($data[0][10] != '') ? $data[0][10]: '0';

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

	$query = '	SELECT
					servicios.Id AS Id,
					servicios.Codigo AS "Codigo de Servicios",
					servicios.Alias AS "Conexión",
					-- mantenedor_tipo_facturacion.nombre AS "Tiempo de Facturacion",
					mantenedor_servicios.servicio AS "Tipo de Servicio",
					servicios.Valor,
					COALESCE (
						grupo_servicio.Nombre,
						servicios.Grupo
					) AS Grupo,
				(CASE
					WHEN FechaActivacion IS NULL THEN "Activo"
					WHEN FechaActivacion = "2999-01-31" THEN "Inactivo"
					ELSE "Suspendido"
				END) AS Estatus
				FROM
					servicios
				INNER JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.id = servicios.TipoFactura
				INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_facturacion.id = mantenedor_tipo_factura.tipo_facturacion
				LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
				LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
				WHERE
					servicios.Rut = '.$_POST['rut'];
	$listaServicios = $run->listViewServicios($query);

	$query = "	SELECT
					fra.id,
					fra.codigo,
					fra.descripcion,
					fon.nombre AS tipo_facturacion
				FROM
					mantenedor_tipo_factura fra
				INNER JOIN mantenedor_tipo_facturacion fon ON fra.tipo_facturacion = fon.id
				WHERE
				fra.tipo_documento = '".$tipo_cliente."'";
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i][0].'">'.$data[$i][1].' - '.$data[$i][2].' - '.$data[$i][3].'</option>';
		}
	}else{
		$list = '<option value="">Seleccione...</option>';
	}

	echo json_encode(array($DataFacturacion, $listaServicios, $list));
 ?>