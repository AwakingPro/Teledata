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

	<script src="../plugins/bootbox/bootbox.min.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/methods_global/methods.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/numbers/jquery.number.js"></script>
	<script src="../js/clientes/controller.js"></script>
</body>
</html>

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
					<div class="col-md-6 form-group">
						<label>Tipo de Cliente</label>
						<select name="TipoCliente_update" class="form-control selectpicker" data-live-search="true">
							<option value="">Seleccione...</option>
							<option value="Boleta">Boleta</option>
							<option value="Factura">Factura</option>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<label>Rut</label>
						<input name="Rut_update" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label> Razón social / Cliente</label>
						<input name="Nombre_update" class="form-control">
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
						<input name="Giro_update" class="form-control">
					</div>
					<div class="col-md-4 form-group">
						<label>Ciudad</label>
						<input name="Ciudad_update" class="form-control">
					</div>
					<div class="col-md-4 form-group">
						<label>Comuna</label>
						<input name="Comuna_update" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 form-group">
						<label>Contacto</label>
						<div class="input-group">
							<input name="Contacto_update" class="form-control">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraContactosUpdate"><i class="fa fa-plus" aria-hidden="true"></i></button>
							</span>
						</div>
					</div>
					<div class="col-md-4 form-group">
						<label>Teléfono</label>
						<div class="input-group">
							<input name="Telefono_update" class="form-control">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraTelefonoUpdate"><i class="fa fa-plus" aria-hidden="true"></i></button>
							</span>
						</div>
					</div>
					<div class="col-md-4 form-group">
						<label>Correo</label>
						<div class="input-group">
							<input name="Correo_update" class="form-control">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraCorreoUpdate"><i class="fa fa-plus" aria-hidden="true"></i></button>
							</span>
						</div>
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

<div class="modal fade" role="dialog" id="extraTelefonoUpdate">
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

<div class="modal fade" role="dialog" id="extraCorreoUpdate">
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

<div class="modal fade" role="dialog" id="extraContactosUpdate">
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
						<input name="extra_TipoContacto[]" class="form-control extraTipoCont">
					</div>
					<div class="col-md-5 form-group">
						<label>Contacto</label>
						<input name="extra_Contacto[]" class="form-control extraCont">
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