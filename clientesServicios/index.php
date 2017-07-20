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
			<div class="containerHeader"></div>
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
										<h3 class="panel-title">Modulo de Servicios de Cliente</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
										<!--Tabs content-->
										<div class="tab-content">
											<h3>Lista de Clientes</h3><br>
												<div class="row">
													<div class="col-md-3">
														<select name="" class="form-control selectpicker tipoBusqueda" data-live-search="true">
															<option value="1">Rut</option>
															<option value="2">Nombre</option>
														</select>
													</div>
													<div class="col-md-6">
														<select name="rutCliente" class="form-control" data-live-search="true">
															<option value="">Seleccione...</option>
														</select>
													</div>
													<div class="col-md-3">
														<button type="button" class="btn btn-primary btn-block buscarDatosClientes">Buscar</button>
													</div>
												</div>
												<br><br>
												<div class="row">

													<div class="panel">
												            <!--Panel heading-->
												            <div class="panel-heading">
												                <div class="panel-control" style="float: left;">
												                    <ul class="nav nav-tabs">
												                        <li class="active"><a href="#tab-Facturacion" data-toggle="tab">Facturación</a></li>
												                        <li><a href="#tab-Servicios" data-toggle="tab">Servicios</a></li>
												                    </ul>
												                </div>
												                <h3 class="panel-title">&nbsp;</h3>
												            </div>

												            <!--Panel body-->
												            <div class="panel-body">
												                <div class="tab-content">
												                    <div class="tab-pane fade in active dataFacturacion" id="tab-Facturacion">
												                    <h4>No hay información</h4>
												                    </div>
												                    <div class="tab-pane fade dataServicios" id="tab-Servicios">
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
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
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

