<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teledata</title>
		<!--STYLESHEET-->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
		<link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
		<link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
		<link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
		<link href="../plugins/pace/pace.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="ClaseForm" class="modal fade" tabindex="-1" role="dialog" id="load">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
						<h4 class="modal-title c-negro">Agregar Clase <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
					</div>
					<div class="modal-body">
						<div class="row" style="padding:20px">
							<form class="form-horizontal" id = "storeClase">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Nombre</label>
										<input id="nombre" name="nombre" type="text" placeholder="Ingrese el nombre" class="form-control input-sm">
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Cantidad</label>
										<input id="limite_facturas" name="limite_facturas" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm number">
									</div>
								</div>
							</form>
						</div>
					</div><!-- /.modal-body -->
					<div class="modal-footer p-b-20 m-b-20">
						<div class="col-sm-12">
							<button type="button" class="btn btn-purple" id="guardarClase">Guardar</button>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div id="ClaseFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
						<h4 class="modal-title c-negro">Actualizar Clase <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
					</div>
					<div class="modal-body">
						<div class="row" style="padding:20px">
							<form class="form-horizontal" id = "updateClase">
								<input id="id" name="id" type="hidden">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Nombre</label>
										<input id="nombre" name="nombre" type="text" placeholder="Ingrese el nombre" class="form-control input-sm">
									</div>
								</div>
								<div class="clearfix m-b-10"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="name">Cantidad</label>
										<input id="limite_facturas" name="limite_facturas" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm number">
									</div>
								</div>
							</form>
						</div>
					</div><!-- /.modal-body -->
					<div class="modal-footer p-b-20 m-b-20">
						<div class="col-sm-12">
							<button type="button" class="btn btn-purple" id="actualizarClase">Actualizar</button>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
						
		<div id="container" class="effect aside-float aside-bright mainnav-sm">
			<div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title">
					</div>
					<br>
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>
						<li><a href="#">Configuración</a></li>
						<li class="active">Clase Cliente</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="tab-base ">
									<div class="tab-content">
										<div class="table-responsive">
											<div class="col-md-12">
												<button data-toggle="modal" href="#ClaseForm" class="btn btn-success">Agregar</button>
												<table id="ClaseTable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">Nombre</th>
															<th class="text-center">Cantidad</th>
															<th class="text-center">Acción</th>
														</tr>
													</thead>
													<tbody class="TableLoader">
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
			<?php include("../layout/footer.php"); ?>
		</div>
		<!--SCRIPT-->
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
		<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="../plugins/sweetalert/sweetalert.min.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/moment/moment.js"></script>
		<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
		<script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
		<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
		<script src="../plugins/numbers/jquery.number.min.js"></script>
		<script src="../js/clase_cliente/ClaseCliente.js?v=<?php echo (rand()); ?>"></script>
	</body>
</html>