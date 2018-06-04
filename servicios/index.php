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
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
		<link href="../css/swalExtend.css" rel="stylesheet">
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
						<li class="active">Servicios</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-6">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Módulo crear servicios</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body container-form">
										<div class="row" >
											<form id="formServicio">
												<div class="col-md-12 form-group">
													<label class="campo-cliente" >Cliente</label>
													<div class="input-group campo-cliente">
														<select id="Rut" name="Rut" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Cliente">
															<option value="">Seleccione...</option>
														</select>
														<span class="input-group-btn">
															<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCliente"><i class="fa fa-plus" aria-hidden="true"></i></button>
														</span>
													</div>
													<br>
													<label class="compo-grupo">Grupo</label>
													<div class="input-group compo-grupo">
														<select name="Grupo" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Grupo"> 
															<option value="">Seleccione...</option>
															<option value="1">Grupo 1</option>
															<option value="2">Grupo 2</option>
															<option value="3">Grupo 3</option>
														</select>
														<span class="input-group-btn">
															<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#grupo"><i class="fa fa-plus" aria-hidden="true"></i></button>
														</span>
													</div>
													<br>
													<label class="campo-cobreServicio">Tipo de Cobro de servicio mensual</label>
													<div class="input-group campo-cobreServicio">
														<select id ="TipoFactura" name="TipoFactura" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Tipo de Cobro">
															<option value="">Seleccione...</option>
														</select>
														<span class="input-group-btn">
															<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalTipoFacturacion"><i class="fa fa-plus" aria-hidden="true"></i></button>
														</span>
													</div>
													<br>
													<label class="compo-tipoFactura">Periodo de Cobro</label>
													<select name="TiepoFacturacion" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Tiempo de Facturación">
														<option value="">Seleccione...</option>
														<option >Mensual</option>
														<option >Semestral</option>
														<option >Anual</option>
													</select>
													<br><br>
													<div class="campo-servicio">
														<label >Tipo de Servicio</label>
														<select name="TipoServicio" id="TipoServicio" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Servicio">
															<option value="">Seleccione...</option>
														</select>
													</div>
													<br>
													<label class="campo-Valor">Valor</label>
													<div class="form-group">
														<input type="text"  name="Valor" class="form-control" validation="not_null" data-nombre="Valor">
													</div>
													<br>
													<label>Descuento</label>
													<div class="input-group">
														<input type="text" name="Descuento" class="form-control" min="0" max="100" step="1">
														<span class="input-group-addon">%</span>
													</div>
													<br >
													<br>
													<label > Descripción</label>
													<textarea name="Descripcion" class="form-control" rows="5"></textarea>

													<div id="otrosServicios" style="display:none">
														<br>

														<label class="campo-apellidoServicio">Apellido del Servicio</label>
														<div class="form-group">
															<input type="text" name="Alias" class="form-control campo-apellidoServicio">
														</div>

														<label class="campo-direccion">Dirección</label>
														<textarea name="Direccion" class="form-control campo-direccion" rows="5"></textarea>
														<br class="campo-direccion">

														<div class="col-md-6 campo-cordenadas">
															<div class="form-group">
																<label class="control-label" for="Latitud">Coordenadas</label>
																<input id="Latitud" name="Latitud" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas" value="-41.3214705">
															</div>
														</div>
														<div class="col-md-6 campo-cordenadas">
															<div class="form-group">
																<label class="control-label" for="name">&nbsp;</label>
																<input id="Longitud" name="Longitud" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas" value="-73.0138898">
															</div>
														</div>
														<br class="campo-cordenadas">

														<div id="Map" style="height:350px; width:100%;" class="campo-cordenadas"></div>
														<br class="campo-cordenadas">
														<label class="campo-referencia">Referencia</label>
														<div class="form-group campo-referencia">
															<input type="text" name="Referencia" class="form-control">
														</div>
														<br class="campo-referencia">
														<label class="campo-contacto">Contacto</label>
														<div class="form-group campo-contacto">
															<input type="text" name="Contacto" class="form-control">
														</div>
														<br  class="campo-contacto">
														<label class="campo-telefonoContacto">Fono Contacto</label>
														<div class="form-group campo-telefonoContacto">
															<input type="text" name="Fono" class="form-control">
														</div>
														<br class="campo-telefonoContacto">

														<label>Fecha Comprometida de Instalación</label>
														<div class="form-group campo-FechaComprometidaInstalacion">
															<input name="FechaComprometidaInstalacion" class="form-control date">
														</div>
														<br class="campo-FechaComprometidaInstalacion">
														<label class="campo-estacionReferencia">Estaciones de Referencia</label>
														<div class="form-group campo-estacionReferencia">
															<input type="text" name="PosibleEstacion" class="form-control">
														</div>
														<br class="campo-estacionReferencia">
														<label class="campo-usuarioPPPoE">Posible Usuario PPPoE</label>
														<div class="form-group campo-usuarioPPPoE">
															<input type="text" name="UsuarioPppoeTeorico" class="form-control">
														</div>
														<br class="campo-usuarioPPPoE">
														<label class="campo-equipamiento">Equipamiento Sugerido</label>
														<div class="form-group campo-equipamiento">
															<input type="text" name="Equipamiento" class="form-control">
														</div>
														<br class="campo-equipamiento">
														<label class="campo-señalTeorica">Señal Teorica</label>
														<div class="form-group campo-señalTeorica">
															<input type="text" name="SenalTeorica" class="form-control">
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

													<div id="divCostoInstalacion">
														<label class="campo-CostoInstalacion">Costo de instalación / Habilitación</label>
														<div class="form-group">
															<input type="text" name="CostoInstalacion" class="form-control" validation="not_null" data-nombre="Costo de Instalacion">
														</div>
														<br>
														<label>Descuento Instalación</label>
														<div class="input-group">
															<input type="text" name="CostoInstalacionDescuento" class="form-control" min="0" max="100" step="1">
															<span class="input-group-addon">%</span>
														</div>
														<br>
													</div>
								

													<div class="containerTipoServicioFormulario"></div>

													<button type="button" class="btn btn-primary guardarServ">Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Servicios registrados</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
										<div class="row" >
											<div class="col-md-12 form-group">
												<div class="dataServicios" id="tab-Servicios">
													<h4>No hay servicios</h4>
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
		<script src="../js/global/validations.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/numbers/jquery.number.js"></script>
		<script src="../plugins/moment/moment.js"></script>
    	<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
		<script src="../plugins/sweetalert/sweetalert.min.js"></script>
		<script src="../js/servicios/controller.js"></script>
		<script src="../js/swalExtend.js"></script>
	</body>
</html>
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
			<div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Registro de Cliente</h4>
						</div>
						<div class="modal-body container-form2">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Tipo de Cliente</label>
									<select name="TipoCliente" class="form-control selectpicker" data-live-search="true" validation="not_null" data-nombre="Tipo de Cliente">
										<option value="">Seleccione...</option>
										<option value="Boleta">Boleta</option>
										<option value="Factura">Factura</option>
										<option value="Canje">Canje</option>
									</select>
								</div>
								<div class="col-md-6 form-group">
									<label>Rut</label>
									<input name="Rut" class="form-control" validation="not_null" data-nombre="Rut">
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label>Clase Cliente</label>
									<select name="ClaseCliente" class="form-control selectpicker ClaseCliente" data-live-search="true" validate="not_null" data-nombre="Clase Cliente">
									</select>
								</div>
								<div class="col-md-4 form-group">
									<label> Razón social / Cliente</label>
									<input name="Nombre" class="form-control" validation="not_null" data-nombre="Razón social">
								</div>
								<div class="col-md-4 form-group">
									<label>Alias</label>
									<input name="Alias" class="form-control" data-nombre="Alias">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Dirección  Comercial</label>
									<textarea name="DireccionComercial" class="form-control" validation="not_null" data-nombre="Dirección"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label>Ciudad</label>
									<input name="Ciudad" class="form-control" data-nombre="Ciudad">
								</div>
								<div class="col-md-4 form-group">
									<label>Comuna</label>
									<input name="Comuna" class="form-control" data-nombre="Comuna">
								</div>
								<div class="col-md-4 form-group">
									<label>Giro</label>
									<select name="Giro" class="form-control selectpicker Giro" data-live-search="true" validate="not_null" data-nombre="Giro">
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label>Contacto</label>
									<input name="Contacto" class="form-control" validation="not_null" data-nombre="Contacto">
								</div>
								<div class="col-md-4 form-group">
									<label>Teléfono</label>
									<input name="Telefono" class="form-control" validation="not_null" data-nombre="Teléfono">
								</div>
								<div class="col-md-4 form-group">
									<label>Correo</label>
									<input name="Correo" class="form-control" validation="email" data-nombre="Correo">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Notas</label>
									<textarea name="Comentario" class="form-control" validation="not_null" data-nombre="Notas"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary guardarCliente">Guardar Cliente</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="ModalTipoFacturacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content containerTipoFactura">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar Tipo de Facturación</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Código</label>
									<input name="TipoFacCodigo" class="form-control">
								</div>
								<div class="col-md-6 form-group">
									<label>Descripción</label>
									<input name="TipoFacDescripcion" class="form-control">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary agregarTipoFacturacion">Guardar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="grupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar Grupo</h4>
						</div>
						<div class="modal-body containerGrupo">
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Nombre del grupo</label>
									<input name="NomGrupo" class="form-control">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary agregarGrupo">Guardar</button>
						</div>
					</div>
				</div>
			</div>