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
						<form id = "showServicio">
							<input type="hidden" class="Id" name="Id" id="Id">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="compo-grupo">Grupo</label>
										<div class="compo-grupo">
											<select id="Grupo" name="Grupo" class="form-control selectpicker" data-live-search="true">
												<option value="">Seleccione...</option>
												<option value="1">Grupo 1</option>
												<option value="2">Grupo 2</option>
												<option value="3">Grupo 3</option>
											</select>
										</div>
										<br>
										<label class="campo-cobreServicio">Tipo de Cobro de servicio</label>
										<div class="campo-cobreServicio">
											<select id="TipoFactura" name="TipoFactura" class="selectpicker form-control" data-live-search="true">
												<option value="">Seleccione...</option>
											</select>
										</div>
										<br>
										<label class="campo-Valor">Valor</label>
										<div class="form-group">
											<input id="Valor" type="text"  name="Valor" class="form-control">
										</div>
										<br>
										<label>Descuento</label>
										<div class="input-group">
											<input type="text" id="Descuento" name="Descuento" class="form-control">
											<span class="input-group-addon">%</span>
										</div>
										<br >
										<br>
										<div id="otrosServiciosEditar" style="display:none">
											<label > Descripción</label>
											<textarea id="Descripcion" name="Descripcion" class="form-control" rows="5"></textarea>
											<br>

											<label class="campo-Conexiones">Conexiones</label>
											<div class="form-group">
												<input id="Conexion" type="text" name="Conexion" class="form-control campo-Conexiones">
											</div>

											<label class="campo-direccion">Dirección</label>
											<textarea id="Direccion" name="Direccion" class="form-control campo-direccion" rows="5"></textarea>
											<br class="campo-direccion">

											<div class="col-md-6 campo-cordenadas">
												<div class="form-group">
													<label class="control-label" for="Latitud">Coordenadas</label>
													<input id="Latitud" name="Latitud" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas">
												</div>
											</div>
											<div class="col-md-6 campo-cordenadas">
												<div class="form-group">
													<label class="control-label" for="name">&nbsp;</label>
													<input id="Longitud" name="Longitud" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas">
												</div>
											</div>
											<br class="campo-cordenadas">

											<div id="MapEdit" style="height:350px; width:100%;" class="campo-cordenadas"></div>

											<br class="campo-cordenadas">
											<label class="campo-referencia">Referencia</label>
											<div class="form-group campo-referencia">
												<input id="Referencia" type="text" name="Referencia" class="form-control">
											</div>
											<br class="campo-referencia">
											<label class="campo-contacto">Contacto</label>
											<div class="form-group campo-contacto">
												<input id="Contacto" type="text" name="Contacto" class="form-control">
											</div>
											<br  class="campo-contacto">
											<label class="campo-telefonoContacto">Fono Contacto</label>
											<div class="form-group campo-telefonoContacto">
												<input id="Fono" type="text" name="Fono" class="form-control">
											</div>
											<label>Fecha Comprometida de Instalación</label>
											<div class="form-group campo-FechaComprometidaInstalacion">
												<input name="FechaComprometidaInstalacion" class="form-control date">
											</div>
											<br class="campo-telefonoContacto">
											<label class="campo-estacionReferencia">Estaciones de Referencia</label>
											<div class="form-group campo-estacionReferencia">
												<input id="PosibleEstacion" type="text" name="PosibleEstacion" class="form-control">
											</div>
											<br class="campo-estacionReferencia">
											<label class="campo-usuarioPPPoE">Usuario PPPoE</label>
											<div class="form-group campo-usuarioPPPoE">
												<input id="UsuarioPppoeTeorico" type="text" name="UsuarioPppoeTeorico" class="form-control">
											</div>
											<br class="campo-usuarioPPPoE">
											<label class="campo-equipamiento">Equipamiento Sugerido</label>
											<div class="form-group campo-equipamiento">
												<input id="Equipamiento" type="text" name="Equipamiento" class="form-control">
											</div>
											<br class="campo-equipamiento">
											<label class="campo-señalTeorica">Señal Teorica</label>
											<div class="form-group campo-señalTeorica">
												<input id="SenalTeorica" type="text" name="SenalTeorica" class="form-control">
											</div>
										</div>
										<br class="campo-equipamiento">
										<label class="campo-señalTeorica">Facturación Costo de instalación / Habilitación</label>
										<div class="form-group campo-señalTeorica">
											<select id="BooleanCostoInstalacion" name="BooleanCostoInstalacion" class="form-control selectpicker">
												<option value="1">Si</option>
												<option value="0">No</option>
											</select>
										</div>
										<br>
										<div id="divCostoInstalacionEditar">
											<label class="campo-CostoInstalacion">Costo de instalación / Habilitación</label>
											<div class="form-group">
												<input type="text" id="CostoInstalacion" name="CostoInstalacion" class="form-control" validate="not_null" data-nombre="Costo de Instalacion">
											</div>
											<br>
											<label>Descuento Instalación</label>
											<div class="input-group">
												<input type="text" id="CostoInstalacionDescuento" name="CostoInstalacionDescuento" class="form-control" min="0" max="100" step="1">
												<span class="input-group-addon">%</span>
											</div>
											<br>
										</div>
									</div>
								</div>
							</div>
						</form>
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
						<!-- <form id = "formEstatus">
							<input type="hidden" class="Id" name="Id" id="Id">							
							<div class="row" style="padding:20px">
								<div class="col-md-12">
									<div class="form-group">
										<label class="compo-grupo">Estado del Servicio</label>
										<div class="compo-grupo">
											<select id="Activo" name="Activo" class="form-control selectpicker" data-live-search="true">
												<option value="">Seleccione...</option>
												<option value="1">Activo</option>
												<option value="2">Suspendido</option>
												<option value="0">Cortado</option>
											</select>
										</div>
										<br>
										<div id="divFechaActivacion" style="display:none">
											<label>Fecha de Activación</label>
											<div class="form-group">
												<div id="date-range">
													<div class="input-daterange input-group" id="datepicker">
														<input type="text" class="form-control" id="FechaInicioDesactivacion" name="FechaInicioDesactivacion" data-nombre="Fecha de Activación" />
														<span class="input-group-addon">a</span>
														<input type="text" class="form-control" id="FechaFinalDesactivacion" name="FechaFinalDesactivacion" data-nombre="Fecha de Activación" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form> -->
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

