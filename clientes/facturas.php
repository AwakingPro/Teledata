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
						<li class="active">Facturas de Clientes</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Visualización de facturas </h3>
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
												<div class="col-md-12">
													<div class="table-responsive">
														<div class="col-md-12">
															<table id="FacturasTable" class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th class="text-center">N* de Documento</th>
																		<th class="text-center">Tipo de Documento</th>
																		<th class="text-center">Fecha Emisión</th>
																		<th class="text-center">Fecha Vencimiento</th>
																		<th class="text-center">Total Doc.</th>
																		<th class="text-center">Saldo Doc.</th>
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

	<div id="modalIngreso" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Agregar Pago <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
				</div>
				<div class="modal-body">
					<div class="row" style="padding:20px">
						<form class="form-horizontal" id = "storePago">
							<input type="hidden" id="FacturaId" name="FacturaId">
							<div class="clearfix m-b-10"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="name">Fecha de Pago</label>
									<input id="FechaPago" name="FechaPago" validation="not_null"  type="text" placeholder="Seleccione la fecha de pago" class="form-control date FechaPago" data-nombre="Fecha de Pago">
								</div>
							</div>
							<div class="clearfix m-b-10"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="name">Monto</label>
									<input id="Monto" name="Monto" validation="not_null" placeholder="Ingrese el monto" class="form-control input-sm number Monto" data-nombre="Monto">
								</div>
							</div>
							<div class="clearfix m-b-10"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="name">Tipo de Pago</label>
									<div class="select">
										<select class="form-control TipoPago" id="TipoPago" name="TipoPago" validation="not_null" data-live-search="true" data-nombre="Tipo de Pago" data-container="body">
											<option value="">Seleccione Opción</option>
										</select>
									</div>
								</div>
							</div>
							<div class="clearfix m-b-10"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label label_Detalle" for="name">Observacion</label>
									<input id="Detalle" name="Detalle" placeholder="Ingrese la observación" class="form-control input-sm Detalle" data-nombre="Observación">
								</div>
							</div>
							<div class="Cheque" style="display:none">
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Fecha de emision de Cheque</label>
										<input id="FechaEmisionCheque" name="FechaEmisionCheque" type="text" placeholder="Seleccione la fecha de emision del cheque" class="form-control date FechaEmisionCheque" data-nombre="Fecha de Emision">
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Fecha de vencimiento de Cheque</label>
										<input id="FechaVencimientoCheque" name="FechaVencimientoCheque" type="text" placeholder="Seleccione la fecha de vencimiento del cheque" class="form-control date FechaVencimientoCheque" data-nombre="Fecha de Vencimiento" disabled>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div><!-- /.modal-body -->
				<div class="modal-footer p-b-20 m-b-20">
					<div class="col-sm-12">
						<button type="button" class="btn btn-purple" id="guardarPago" name="guardarPago">Guardar</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div id="modalShow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Pagos <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
				</div>
				<div class="modal-body">
					<div class="row" style="margin-top: 10px">
						<div class="table-responsive">
							<div class="col-md-12">
								<table id="ModalTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th class="text-center">Fecha Pago</th>
											<th class="text-center">Monto</th>
											<th class="text-center">Tipo Pago</th>
											<th class="text-center">Detalle</th>
											<th class="text-center">Fecha Emisión Cheque</th>
											<th class="text-center">Fecha Vencimiento Cheque</th>
											<th class="text-center">Acciones</th>
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

	<script src="../js/jquery-2.2.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/demo/nifty.demo.js"></script>
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../plugins/bootbox/bootbox.min.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/global/validations.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/moment/moment.js"></script>
	<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="../js/clientes/facturas.js"></script>
	<script src="../plugins/numbers/jquery.number.js"></script>
	<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
</body>
</html>

