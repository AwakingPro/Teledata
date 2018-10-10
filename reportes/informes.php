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
                                                            <option value="">Todos</option>
                                                            <option value="1">Informe Clientes</option>
                                                            <option value="2">Informe de Pagos Mensuales y Anuales</option>
                                                            <option value="3">Informe Cobranza de clientes</option>
                                                            <option value="4">Informe de Pagos por Cliente</option>
                                                            <option value="5">Informe Estado de Clientes</option>
                                                            <option value="6">Libros de Ventas</option>
                                                            <option value="7">Libros de Compras</option>
                                                            <option value="8">Resumen de Impuesto Mensual. (IVA) | VENTAS | COMPRAS</option>
                                                            <option value="9">Informe de Pago de Proveedores</option>
                                                            <option value="10">Informe otros Egresos</option>
                                                            <option value="11">Informe graficado de ingresos v/s egreso</option>
                                                            <option value="12">Comparativo tipo de Egreso</option>
                                                            <option value="13">Gráficos Comparativos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="name">Selección de Cliente o Proveedor </label>
                                                    <div class="select">
                                                        <select class="selectpicker form-control" id="bodega_tipo" name="bodega_tipo" data-live-search="true" data-container="body">
                                                            <option value="">Todos</option>
                                                            <option value="1">CLiente 1</option>
                                                            <option value="2">Cliente 2</option>
                                                            <option value="3">Cliente 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Seleccione rango de fecha</label>
                                                    <div id="date-range">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <input type="text" class="form-control" name="start" />
                                                            <span class="input-group-addon">a</span>
                                                            <input type="text" class="form-control" name="end" />
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
		<script src="../js/methods_global/methods.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/numbers/jquery.number.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="../js/reportes/Clientes.js"></script>
	</body>
</html>
