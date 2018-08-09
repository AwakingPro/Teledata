<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id, rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono
	FROM
		personaempresa
	WHERE
		id ='.$_POST['id'];
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

		$DataFacturacion = '<div class="row">
				<div class="col-md-6 form-group">
					<label>Id Cliente</label>
					<span class="form-control">'.$data1.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Rut</label>
					<span class="form-control">'.$data2.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Dv</label>
					<span class="form-control">'.$data3.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Nombre</label>
					<span class="form-control">'.$data4.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Giro</label>
					<span class="form-control">'.$data5.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Direccion</label>
					<span class="form-control">'.$data6.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Correo</label>
					<span class="form-control">'.$data7.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Contacto</label>
					<span class="form-control">'.$data8.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Comentarios</label>
					<span class="form-control">'.$data9.'</span>
				</div>
				<div class="col-md-6 form-group">
					<label>Telefono</label>
					<span class="form-control">'.$data10.'</span>
				</div>
			</div>';
	}else{
		$DataFacturacion = 'false';
	}

	echo $DataFacturacion;
?>