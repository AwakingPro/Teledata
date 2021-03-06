<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teledata | Informes</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
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
						<li><a href="#">Reportes</a></li>
						<li class="active">Informes</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<h3 class="panel-title">Informes</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body container-form">
										<div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="name">Seleccione Informe a Emitir</label>
                                                    <div class="select">
                                                        <select class="selectpicker form-control" id="tipo_informe" name="tipo_informe" data-live-search="true" data-container="body">
                                                            <option value="">Seleccione</option>

															<!-- inhabilitado -->
															<option value="0">Informe clientes con servicios</option>
                                                            <option value="1">Informe clientes</option>
                                                            <option value="2">Informe pagos mensuales y anuales</option>
                                                            <option value="3">Informe cobranza de clientes</option>
															<!-- inhabilitado -->

                                                            <option value="4" disabled="disabled">Informe pagos por cliente</option>
                                                            <option value="5" disabled="disabled">Informe estado de clientes</option>
                                                        
															<!-- inhabilitado -->
															<option value="6">Libro de ventas</option>
															<!-- inhabilitado -->


                                                            <option value="7" disabled="disabled">Libro de compras</option>
                                                            <option value="8" disabled="disabled">Informe pago de proveedores</option>
                                                            <option value="9" disabled="disabled">Informe otros egresos</option>
                                                            <option value="10" disabled="disabled">Informe graficado de ingresos v/s egreso</option>
                                                            <option value="11" disabled="disabled">Comparativo tipo de egreso</option>
                                                            <option value="12" disabled="disabled">Gráficos comparativos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="name">Selección de Cliente o Proveedor </label>
                                                    <div class="select">
														<select name="rutCliente" class="selectpicker form-control" data-live-search="true">
															<option value="">Seleccione...</option>
														</select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Seleccione rango de fecha De Facturación</label>
                                                    <div id="date-range">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <input type="text" class="form-control" id="start" name="start" />
                                                            <span class="input-group-addon">a</span>
                                                            <input type="text" class="form-control" id="end" name="end" />
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
											</div>
                                            <div class="col-sm-12">
                                                <button type="button" id="Download" class="btn btn-primary">Generar Informe</button>
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


		<!-- Modal -->
		<div class="modal fade" id="MontoTotal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Monto total a Facturar</h4>
				</div>
				<div class="modal-body">
					<h3>Total de Facturas:</h3>
					<span style="font-size: 25px" class="cantFacturas"></span><span style="font-size: 25px"> Facturas</span>
					<h3>Monto total a facturar :</h3>
					<span style="font-size: 25px" class="montoTotal"></span><span style="font-size: 25px"> $</span>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
				</div>
			</div>
		</div>

		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../plugins/bootbox/bootbox.min.js"></script>
		<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
		<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
		<script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/numbers/jquery.number.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="../plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
		<script src="../js/reportes/Clientes.js?v=<?php echo (rand()); ?>"></script>
	</body>
</html>

