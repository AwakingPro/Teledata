<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Foco | Software de Estrategia</title>
		<!--STYLESHEET-->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
		<link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
		<link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
		<link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
		<link href="../plugins/pace/pace.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="BodegaForm" class="modal fade" tabindex="-1" role="dialog" id="load">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
						<h4 class="modal-title c-negro">Agregar Bodega <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
					</div>
					<div class="modal-body">
						<div class="row" style="padding:20px">
							<form class="form-horizontal" id = "storeBodega">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Nombre</label>
										<input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Dirección</label>
										<textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"></textarea>
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Télefono</label>
										<input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm">
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Responsable</label>
										<div class="select">
											<select class="selectpicker form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body">
											</select>
										</div>
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Correo</label>
										<input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm">
									</div>
								</div>
							</form>
						</div>
						</div><!-- /.modal-body -->
						<div class="modal-footer p-b-20 m-b-20">
							<div class="col-sm-12">
								<button type="button" class="btn btn-purple" id="guardarBodega" name="guardarBodega">Guardar</button>
							</div>
						</div></form>
						</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<div id="BodegaFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
										<h4 class="modal-title c-negro">Actualizar Bodega <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
									</div>
									<div class="modal-body">
										<div class="row" style="padding:20px">
											<form class="form-horizontal" id = "updateBodega">
												<input type="hidden" id="id" name="id">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="name">Nombre</label>
														<input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
													</div>
												</div>
												<div class="clearfix m-b-10"></div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="name">Dirección</label>
														<textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"></textarea>
													</div>
												</div>
												<div class="clearfix m-b-10"></div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="name">Télefono</label>
														<input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm">
													</div>
												</div>
												<div class="clearfix m-b-10"></div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="name">Responsable</label>
														<div class="select">
															<select class="selectpicker form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body">
															</select>
														</div>
													</div>
												</div>
												<div class="clearfix m-b-10"></div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="name">Correo</label>
														<input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm">
													</div>
												</div>
											</form>
										</div>
										</div><!-- /.modal-body -->
										<div class="modal-footer p-b-20 m-b-20">
											<div class="col-sm-12">
												<button type="button" class="btn btn-purple" id="actualizarBodega" name="actualizarBodega">Actualizar</button>
											</div>
										</div></form>
										</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										<div id="container" class="effect mainnav-lg">
											<?php
											include("../layout/header.php");
											?>
											<div class="boxed">
												<div id="content-container">
													<div id="page-title">
													</div>
													<br>
													<ol class="breadcrumb">
														<li><a href="#">Módulo Inventario</a></li>
														<li class="active">Bodegas</li>
													</ol>
													<div id="page-content">
														<div class="row">
															<div class="col-sm-12">
																<div class="tab-base ">
																	<div class="tab-content">
																		<div class="table-responsive">
																			<div class="col-md-12">
																				<button data-toggle="modal" href="#BodegaForm" class="btn btn-success">Agregar</button>
																				<table id="BodegaTable" class="table table-striped table-bordered">
																					<thead>
																						<tr>
																							<th class="text-center">Nombre</th>
																							<th class="text-center">Dirección</th>
																							<th class="text-center">Télefono</th>
																							<th class="text-center">Responsable</th>
																							<th class="text-center">Correo</th>
																							<th class="text-center">Acción</th>
																						</tr>
																					</thead>
																					<tbody>
																					</tbody>
																				</table>
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
											<?php include("../layout/footer.php"); ?>
										</div>
										<!--SCRIPT-->
										<script src="../js/jquery-2.2.1.min.js"></script>
										<script src="../js/bootstrap.min.js"></script>
										<script src="../plugins/fast-click/fastclick.min.js"></script>
										<script src="../js/nifty.min.js"></script>
										<script src="../plugins/morris-js/morris.min.js"></script>
										<script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
										<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
										<script src="../plugins/skycons/skycons.min.js"></script>
										<script src="../plugins/switchery/switchery.min.js"></script>
										<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
										<script src="../js/demo/nifty-demo.min.js"></script>
										<script src="../plugins/bootbox/bootbox.min.js"></script>
										<script src="../js/demo/ui-alerts.js"></script>
										<script src="../plugins/audiojs/audio.min.js"></script>
										<script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
										<script src="../plugins/bootbox/bootbox.min.js"></script>
										<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
										<script src="../plugins/sweetalert/sweetalert.min.js"></script>
										<script src="../js/global/validations.js"></script>
										<script src="../js/inventario/bodegas/Bodega.js"></script>
									</body>
								</html>