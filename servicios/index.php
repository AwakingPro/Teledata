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
		<div id="container" class="effect mainnav-lg">
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
									<div class="panel-body">
										<h3>Registrar Servicios</h3><br>
												<div class="row" >
													<div class="col-md-6 form-group">
														<label >Cliente</label>
														<div class="input-group">
															<select name="Tipo" class="form-control" >
																<option value="">Seleccione...</option>
															</select>
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipos"><i class="fa fa-plus" aria-hidden="true"></i></button>
															</span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group">
														<label>Grupo</label>
														<select name="Tipo" class="form-control" >
															<option value="">Seleccione...</option>
														</select>
													</div>
													<div class="col-md-6 form-group">
														<label>Tipo de Facturacion</label>
														<select name="Tipo" class="form-control" >
															<option value="">Seleccione...</option>
														</select>
													</div>
												</div>
												<div class="row" >
													<div class="col-md-6 form-group">
														<label >Valor</label>
														<div class="input-group">
														  <input type="text" class="form-control">
														  <span class="input-group-addon">Pesos</span>
														</div>
													</div>
													<div class="col-md-6 form-group">
														<label >Descuento</label>
														<div class="input-group">
														  <input type="text" class="form-control">
														  <span class="input-group-addon">%</span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 form-group">
														<label >Servicio</label>
															<input type="text" name="" class="form-control">
													</div>
													<div class="col-md-6 form-group">
														<label >Tipo de Facturtacion</label>
														<div class="input-group">
															<select name="Tipo" class="form-control" >
																<option value="">Seleccione...</option>
															</select>
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipos"><i class="fa fa-plus" aria-hidden="true"></i></button>
															</span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label> Descripcion</label>
														<textarea name="" class="form-control"></textarea>
												</div>
												<div class="row">
													<div class="col-md-12">
														<button type="button" class="btn btn-primary guardarTicket">Guardar</button>
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
	<script src="../js/clientes/controller.js"></script>
</body>
</html>