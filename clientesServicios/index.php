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
		<link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
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
						<li class="active">Servicios del Clientes</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Visualización de servicios de clientes </h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
										<!--Tabs content-->
										<div class="tab-content">
											<h3>Lista de Clientes</h3><br>
												<div class="row">
													<div class="col-md-4">
														<select name="rutCliente" class="form-control" data-live-search="true">
															<option value="">Seleccione...</option>
														</select>
													</div>
												</div>
												<br><br>
												<div class="row">

													<div class="panel">
												            <!--Panel heading-->
												            <div class="panel-heading">
												                <div class="panel-control" style="float: left;">
												                    <ul class="nav nav-tabs">
												                        <li class="active"><a href="#tab-Servicios" data-toggle="tab">Servicios</a></li>
												                        <li ><a href="#tab-Facturacion" data-toggle="tab">Datos de facturacion</a></li>
												                    </ul>
												                </div>
												                <h3 class="panel-title">&nbsp;</h3>
												            </div>

												            <!--Panel body-->
												            <div class="panel-body">
												                <div class="tab-content">

												                    <div class="tab-pane fade in active dataServicios" id="tab-Servicios">
												                    <h4>No hay información</h4>
												                    </div>
												                    <div class="tab-pane fade dataFacturacion" id="tab-Facturacion">
												                    <h4>No hay información</h4>
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
									<?php include('../ajax/menu/mainMenu.php') ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="verServicios" aria-labelledby="verServicios">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Lista de Datos técnicos</h4>
					</div>
					<div class="modal-body containerListDatosTecnicos">
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="agregarDatosTecnicos">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Agregar Datos Técnicos</h4>
					</div>
					<div class="modal-body containerTipoServicio">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary guardarDatosTecnicos">Guardar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div id="modalEditar" class="modal fade" tabindex="-1" role="dialog" id="load">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
						<h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
					</div>
					<div class="modal-body">
					<?php
					// Muestra Modal para Ver y Editar detalles del Servicio
					include '../componentes/componentes_servicios/modal_EditarServicio.php';
					?>
					</div><!-- /.modal-body -->
					<div class="modal-footer p-b-20 m-b-20">
						<div class="col-sm-12">
							<button type="button" class="btn btn-purple" id="updateServ" name="updateServ">Guardar</button>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div id="modalEstatus" class="modal fade" tabindex="-1" role="dialog" id="load">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
						<h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
					</div>
					<div class="modal-body">
					<?php
					include '../componentes/componentes_servicios/form_activa_servicios.php';
					?>
					</div><!-- /.modal-body -->
					<div class="modal-footer p-b-20 m-b-20">
						<div class="col-sm-12">
							<button type="button" class="btn btn-purple" id="updateEstatus" name="updateEstatus">Guardar</button>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="../plugins/bootbox/bootbox.min.js"></script>
		<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
		<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
		<script src="../js/methods_global/methods.js"></script>
		<script src="../js/methods_global/mapaEdit.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/moment/moment.js"></script>
		<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
		<script src="../js/clientes/controller.js"></script>
		<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
		<script src="../plugins/numbers/jquery.number.js"></script>
	</body>
</html>

