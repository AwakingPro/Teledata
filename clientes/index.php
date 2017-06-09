<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Foco | Software de Estrategia</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="container" class="effect mainnav-sm">
			<?php
			include("../layout/header.php");
			?>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title" style="padding-right: 25px;">
						<h1 class="page-header text-overflow">Registro y Datos de Clientes</h1>
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
														<input name="Nombre" class="form-control">
													</div>
													<div class="col-md-4 form-group">
														<label>Rut</label>
														<input name="Rut" class="form-control">
													</div>
													<div class="col-md-4 form-group">
														<label>Dv</label>
														<input name="Dv" class="form-control">
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Direccion Comercial</label>
														<textarea name="DireccionComercial" class="form-control"></textarea>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4 form-group">
														<label>Contacto</label>
														<input name="Contacto" class="form-control">
													</div>
													<div class="col-md-4 form-group">
														<label>Telefono</label>
														<input name="Telefono" class="form-control">
													</div>
													<div class="col-md-4 form-group">
														<label>Correo</label>
														<input name="Correo" class="form-control">
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label>Giro</label>
														<input name="Giro" class="form-control">
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Comentariol</label>
														<textarea name="Comentario" class="form-control"></textarea>
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
												<h3>Lista de Clientes</h3><br>
												<div class="row">
													<div class="col-md-3">
														<select name="" class="form-control selectpicker tipoBusqueda" data-live-search="true">
															<option value="">Rut</option>
															<option value="">Nombre</option>
														</select>
													</div>
													<div class="col-md-6">
														<select name="" class="form-control selectpicker">
															<option value="">Seleccione...</option>
														</select>
													</div>
													<div class="col-md-3">
														<button type="button" class="btn btn-primary btn-block">Buscar</button>
													</div>
												</div>
												<br><br>
												<div class="row">
													<div class="tab-base">
														<ul class="nav nav-tabs">
															<li class="active">
																<a data-toggle="tab" href="#tab-Facturacion">Facturacion</a>
															</li>
															<li>
																<a data-toggle="tab" href="#tab-Servicios">Servicios</a>
															</li>
															<li>
																<a data-toggle="tab" href="#tab-Productos">Productos</a>
															</li>
															<li>
																<a data-toggle="tab" href="#tab-DatosContacto">Datos de Contacto</a>
															</li>
														</ul>
														<div class="tab-content">
															<div id="tab-Facturacion" class="tab-pane fade active in">
																<h3>No hay informacion</h3>
															</div>
															<div id="tab-Servicios" class="tab-pane fade">
																<h3>No hay informacion</h3>
															</div>
															<div id="tab-Productos" class="tab-pane fade">
																<h3>No hay informacion</h3>
															</div>
															<div id="tab-DatosContacto" class="tab-pane fade">
																<h3>No hay informacion</h3>
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
	<script src="../js/clientes/controller.js"></script>
</body>
</html>