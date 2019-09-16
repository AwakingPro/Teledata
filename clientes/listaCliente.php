<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teledata</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/pace/pace.min.css" rel="stylesheet">
   		<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
	<?php
		include 'modalContactos.php';
		include 'modalVerServicios.php';
	?>
	<!-- inicio modal editar cliente -->
	<div class="modal fade" role="dialog" id="editarCliente">
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
					<input type="hidden" name="IdCliente">
					<div class="row">
						<div class="col-md-2 form-group">
							<label>Estado Cliente</label>
							<select id="stateCliente" name="stateCliente" class="form-control stateCliente selectpicker" data-live-search="true" validate="not_null">
								<option class="seleccione" value="">Seleccione...</option>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Tipo de Cliente</label>
							<select name="TipoCliente_update" class="form-control TipoCliente" data-live-search="true">
								<option value="">Seleccione...</option>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Tipo de Pago</label>
							<select name="TipoPago_update" class="form-control TipoPago" data-live-search="true" validate="not_null">
								<option value="">Seleccione...</option>
							</select>
						</div>
						<div class="col-md-1 form-group">
							<div class="checkbox" style="margin: 18px auto">
								<input id="PoseePac_update" name="PoseePac_update" class="magic-checkbox" type="checkbox">
								<label for="PoseePac_update">Posee PAC</label>

								<input id="PoseePrefactura_update" name="PoseePrefactura_update" class="magic-checkbox" type="checkbox">
								<label for="PoseePrefactura_update">Posee Prefactura</label>
							</div>
						</div>
						<div class="col-md-2 form-group">
							<label>Rut</label>
							<input name="Rut_update" class="form-control" disabled>
						</div>
						<div class="col-md-1 form-group">
							<label>Dv</label>
							<input id="Dv_update" name="Dv_update" class="form-control" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label> Razón social / Cliente</label>
							<input name="Nombre_update" class="form-control" readonly="readonly">
							<input type="hidden" name="cliente_id_bsale" class="form-control">
							<input type="hidden" name="stateOculto" class="form-control">
						</div>
						<div class="col-md-6 form-group">
							<label>Alias</label>
							<input name="Alias_update" class="form-control">
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
							<label>Giro</label>
							<input name="Giro_update" class="form-control" validate="not_null">
						</div>
						<div class="col-md-4 form-group">
							<label>Region</label>
							<select id="Region_update" name="Region_update" class="form-control Region_update" data-live-search="true" validate="not_null">
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label>Ciudad</label>
							<select id="Ciudad_update" name="Ciudad_update" class="form-control Ciudad_update" data-live-search="true" validate="not_null">
							</select>
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
							<label>Comentarios</label>
							<textarea name="Comentario_update" class="form-control"></textarea>
						</div>
					</div>
					
					<div class="panel">
					
						<div class="panel-body">
						<label for="">Otros Contactos</label>
							<div class="dataContactos2">
									<h4>No hay información</h4>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<br>
							<button type="button" class="btn btn-primary actualizarCliente" id="actualizarCliente">Actualizar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- fin modal editar cliente -->
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

										<h3 class="panel-title">Ver Cliente</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
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
	<script src="../plugins/sweetalert/sweetalert.min.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/methods_global/methods.js"></script>
	<script src="../js/methods_global/mapaEdit.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
	<script src="../plugins/numbers/jquery.number.js"></script>
	<script src="../plugins/pace/pace.min.js"></script>
	<script src="../js/clientes/controller.js"></script>
</body>
</html>