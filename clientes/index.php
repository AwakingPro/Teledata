<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<?php
			include 'modalContactos.php';
		?>
		<div class="modal fade" role="dialog" id="agregarGiro">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Agregar Giro</h4>
					</div>
					<div class="modal-body">
						<form id="insertGiro">
							<div class="row">
								<div class="col-md-12 form-group">
								<label>Giro</label>
									<input name="nombreGiro" class="form-control" validate="not_null">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-purple" id="guardarGiro">Guardar</button>
					</div>
				</div>
			</div>
		</div>
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
												<form id="insertCliente">
													<div class="row">
														<div class="col-md-4 form-group">
															<label>Tipo de Cliente</label>
															<select name="TipoCliente" class="form-control TipoCliente" data-live-search="true" validate="not_null">
																<option value="">Seleccione...</option>
															</select>
														</div>
														<div class="col-md-4 form-group">
															<label>Tipo de Pago</label>
															<select name="TipoPago" class="form-control TipoPago" data-live-search="true" validate="not_null">
																<option value="">Seleccione...</option>
															</select>
														</div>
														<div class="col-md-3 form-group">
															<label>Rut</label>
															<input name="Rut" class="form-control" validate="not_null">
														</div>
														<div class="col-md-1 form-group">
															<label>Dv</label>
															<input id="Dv" name="Dv" class="form-control" validate="not_null" disabled>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4 form-group">
															<label>Clase Cliente</label>
															<select name="ClaseCliente" class="form-control selectpicker ClaseCliente" data-live-search="true" validate="not_null">
															</select>
														</div>
														<div class="col-md-4 form-group">
															<label> Razón social / Cliente</label>
															<input name="Nombre" class="form-control" validate="not_null">
														</div>
														<div class="col-md-4 form-group">
															<label>Alias</label>
															<input name="Alias" class="form-control">
														</div>
													</div>
													<div class="row">
														<div class="col-md-12 form-group">
															<label>Dirección Comercial</label>
															<textarea name="DireccionComercial" class="form-control" validate="not_null"></textarea>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4 form-group">
															<label>Giro</label>
															<div class="input-group">
																<select id="Giro" name="Giro" class="form-control selectpicker Giro" data-live-search="true" validate="not_null">
																</select>
																<span class="input-group-btn">
																	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarGiro"><i class="fa fa-plus" aria-hidden="true"></i></button>
																</span>
															</div>
														</div>
														<div class="col-md-4 form-group">
															<label>Region</label>
															<select id="Region" name="Region" class="form-control Region" data-live-search="true" validate="not_null">
															</select>
														</div>
														<div class="col-md-4 form-group">
															<label>Ciudad</label>
															<select id="Ciudad" name="Ciudad" class="form-control Ciudad" data-live-search="true" validate="not_null">
															</select>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4 form-group">
															<label>Contacto</label>
															<div class="input-group">
																<input name="Contacto" class="form-control" validate="not_null">
																<span class="input-group-btn">
																	<button id="agregarContactos" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalContactos"><i class="fa fa-plus" aria-hidden="true"></i></button>
																</span>
															</div>
														</div>
														<div class="col-md-4 form-group">
															<label>Teléfono</label>
															<input name="Telefono" class="form-control" validate="not_null">
														</div>
														<div class="col-md-4 form-group">
															<label>Correo</label>
															<input name="Correo" class="form-control" validate="email">
														</div>
													</div>
													<div class="row">
														<div class="col-md-12 form-group">
															<label>Notas</label>
															<textarea name="Comentario" class="form-control"></textarea>
														</div>
													</div>
												</form>
												<div class="row">
													<div class="col-md-12">
														<br>
														<button id ="guardarCliente" type="button" class="btn btn-primary guardarCliente">Guardar</button>
														<button id ="guardarClienteIrServicio" type="button" class="btn btn-primary guardarCliente">Guardar y Crear Servicio</button>
													</div>
												</div>
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
	<script src="../js/nifty.min.js"></script>

	<script src="../plugins/bootbox/bootbox.min.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/methods_global/methods.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
	<script src="../plugins/numbers/jquery.number.js"></script>
	<script src="../plugins/pace/pace.min.js"></script>
	<script src="../plugins/sweetalert/sweetalert.min.js"></script>
	<script src="../js/clientes/controller.js"></script>
</body>
</html>