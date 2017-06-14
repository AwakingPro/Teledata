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
		<div id="container" class="mainnav-sm">
			<?php
			include("../layout/header.php");
			?>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title" style="padding-right: 25px;">
						<h1 class="page-header text-overflow">Registro y Datos de Servivios</h1>
					</div>
					<br>
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>
						<li class="active">Servivios</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Modulo Servicios</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body container-form">
										<h3>Registrar Servicios</h3><br>
										<div class="row" >
											<div class="col-md-6 form-group">
												<label >Cliente</label>
												<div class="input-group">
													<select name="Rut" class="form-control" data-live-search="true">
														<option value="">Seleccione...</option>
													</select>
													<span class="input-group-btn">
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCliente"><i class="fa fa-plus" aria-hidden="true"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group">
												<label>Grupo</label>
												<select name="Grupo" class="form-control selectpicker" data-live-search="true">
													<option value="">Seleccione...</option>
													<option value="1">Grupo 1</option>
													<option value="2">Grupo 2</option>
													<option value="3">Grupo 3</option>
												</select>
											</div>
											<div class="col-md-6 form-group">
												<label>Tipo de Facturacion</label>
												<div class="input-group">
													<select name="TipoFactura" class="form-control" data-live-search="true">
														<option value="">Seleccione...</option>
													</select>
													<span class="input-group-btn">
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalTipoFacturacion"><i class="fa fa-plus" aria-hidden="true"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="row" >
											<div class="col-md-6 form-group">
												<label >Valor</label>
												<div class="input-group">
													<input type="text"  name="Valor" class="form-control">
													<span class="input-group-addon">Pesos</span>
												</div>
											</div>
											<div class="col-md-6 form-group">
												<label >Descuento</label>
												<div class="input-group">
													<input type="text" name="Descuento" class="form-control">
													<span class="input-group-addon">%</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group">
												<label >Servicio</label>
												<div class="input-group">
													<select name="TipoServicio" class="form-control" data-live-search="true">
														<option value="">Seleccione...</option>
													</select>
													<span class="input-group-btn">
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalServicio"><i class="fa fa-plus" aria-hidden="true"></i></button>
													</span>
												</div>
											</div>
											<div class="col-md-6 form-group">
												<label >Tipo de Facturtacion</label>
												<input type="text" name="TiepoFacturacion"  class="form-control">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 form-group">
												<label> Descripcion</label>
												<textarea name="Descripcion" class="form-control"></textarea>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary guardarServ">Guardar</button>
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
		<script src="../js/servicios/controller.js"></script>
	</body>
</html>
<div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Registro de Cliente</h4>
			</div>
			<div class="modal-body container-form2">
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
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>