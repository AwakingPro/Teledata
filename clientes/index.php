<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teledata</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/pace/pace.min.css" rel="stylesheet">
   		 <script src="../plugins/pace/pace.min.js"></script>
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="container" class="effect aside-float aside-bright mainnav-sm">
			<div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title" style="padding-right: 25px;">
					</div>
					<br>
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>
						<li class="active">Clientes</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<div class="panel-control">
											<!--Nav tabs-->
											<ul class="nav nav-tabs">
												<li class="active"><a data-toggle="tab" href="#tabs-box-1">Crear Nuevo</a></li>
												<li><a data-toggle="tab" href="#tabs-box-2">Ver Lista</a></li>
											</ul>
										</div>
										<h3 class="panel-title">Modulo Cliente</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
										<!--Tabs content-->
										<div class="tab-content">
											<div id="tabs-box-1" class="tab-pane fade in active form-cont1">
												<div class="row">
													<div class="col-md-12">
														<h3>Crear Nuevo Cliente</h3><br>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4 form-group">
														<label>Cliente</label>
														<input name="Nombre" class="form-control" validate="not_null">
													</div>
													<div class="col-md-4 form-group">
														<label>Rut</label>
														<input name="Rut" class="form-control">
													</div>
													<div class="col-md-4 form-group">
														<label>Dv</label>
														<select name="Dv" class="form-control selectpicker" data-live-search="true">
															<option value="">Seleccione...</option>
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
															<option>6</option>
															<option>7</option>
															<option>8</option>
															<option>9</option>
															<option>K</option>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label>Dirección  Comercial</label>
														<textarea name="DireccionComercial" class="form-control" validate="not_null"></textarea>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4 form-group">
														<label>Contacto</label>
														<div class="input-group">
															<input name="Contacto" class="form-control" validate="not_null">
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraContactos"><i class="fa fa-plus" aria-hidden="true"></i></button>
															</span>
														</div>
													</div>
													<div class="col-md-4 form-group">
														<label>Teléfono</label>
														<div class="input-group">
															<input name="Telefono" class="form-control" validate="not_null">
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraTelefono"><i class="fa fa-plus" aria-hidden="true"></i></button>
															</span>
														</div>
													</div>
													<div class="col-md-4 form-group">
														<label>Correo</label>
														<div class="input-group">
															<input name="Correo" class="form-control" validate="email">
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraCorreo"><i class="fa fa-plus" aria-hidden="true"></i></button>
															</span>
														</div>

													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label>Giro</label>
														<input name="Giro" class="form-control" validate="not_null">
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label>Comentarios</label>
														<textarea name="Comentario" class="form-control" validate="not_null"></textarea>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<br>
														<button type="button" class="btn btn-primary guardarCliente">Guardar</button>
													</div>
												</div>
											</div>
											<div id="tabs-box-2" class="tab-pane fade">
												<div class="row">
													<div class="col-md-12">
														<a href="../ajax/cliente/exportarExcelCliente.php" class="btn btn-primary">Exportar en Excel</a>
													</div>
												</div>
												<br>
												<br>
												<div class="listaCliente"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<nav id='mainnav-container'>
				<div id='mainnav'>
					<div id='mainnav-shortcut'>
						<ul class='list-unstyled'>
							<li class='col-xs-4' data-content='Page Alerts'></li>
						</ul>
					</div>
					<div id='mainnav-menu-wrap'>
						<div class='nano'>
							<div class='nano-content'>
								<ul id='mainnav-menu' class='list-group'>
									<?php include('../ajax/menu/mainMenu.php') ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
	<script src="../js/jquery-2.2.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script src="../plugins/bootbox/bootbox.min.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/methods_global/methods.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/numbers/jquery.number.js"></script>
	<script src="../js/clientes/controller.js"></script>
</body>
</html>

<div class="modal fade" tabindex="-1" role="dialog" id="editarCliente" aria-labelledby="editarCliente">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Cliente</h4>
			</div>
			<div class="modal-body container-form-update">
				<div class="row">
					<div class="col-md-12">
						<h3>Datos del Cliente</h3><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 form-group">
						<label>Cliente</label>
						<input name="Nombre_update" class="form-control">
						<input type="hidden" name="IdCliente">
					</div>
					<div class="col-md-4 form-group">
						<label>Rut</label>
						<input name="Rut_update" class="form-control">
					</div>
					<div class="col-md-4 form-group">
						<label>Dv</label>
						<select name="Dv_update" class="form-control selectpicker" data-live-search="true">
							<option value="">Seleccione...</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>K</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Dirección  Comercial</label>
						<textarea name="DireccionComercial_update" class="form-control"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 form-group">
						<label>Contacto</label>
						<input name="Contacto_update" class="form-control">
					</div>
					<div class="col-md-4 form-group">
						<label>Teléfono</label>
						<input name="Telefono_update" class="form-control">
					</div>
					<div class="col-md-4 form-group">
						<label>Correo</label>
						<input name="Correo_update" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Giro</label>
						<input name="Giro_update" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Comentarios</label>
						<textarea name="Comentario_update" class="form-control"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<button type="button" class="btn btn-primary actualizarCliente">Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="extraTelefono" aria-labelledby="editarCliente">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Telefono Extra</h4>
			</div>
			<div class="modal-body container-form-extraTelefono">
				<div class="row">
					<div class="col-md-9 form-group">
					<label>Telefono</label>
						<input name="extra_telefono[]" class="form-control">
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-success btn-block mgExtraButton agregarCampTele"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
				</div>
				<div class="contenedorExtraTelefono">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="extraCorreo" aria-labelledby="editarCliente">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Correo Extra</h4>
			</div>
			<div class="modal-body container-form-extraCorreo">
				<div class="row">
					<div class="col-md-9 form-group">
					<label>Correo</label>
						<input name="extra_correo[]" class="form-control">
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-success btn-block mgExtraButton agregarCampCorreo"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
				</div>
				<div class="contenedorExtraCorreo">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="extraContactos" aria-labelledby="editarCliente">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Contacto extra</h4>
			</div>
			<div class="modal-body container-form-extraCorreo">
				<div class="row">
					<div class="col-md-5 form-group">
						<label>Tipo de contacto</label>
						<input name="extra_TipoContacto[]" class="form-control">
					</div>
					<div class="col-md-5 form-group">
						<label>Contacto</label>
						<input name="extra_Contacto[]" class="form-control">
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-success btn-block mgExtraButton agregarCampContacto"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
				</div>
				<div class="contenedorContactosExtras">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
			</div>
		</div>
	</div>
</div>