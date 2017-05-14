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
						<h1 class="page-header text-overflow">Modulo de Tickets</h1>
					</div>
					<br>
					<ol class="breadcrumb">
						<li><a href="#">Módulo Tickets</a></li>
						<li class="active">Tickets</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="tab-base ">
									<ul class="nav nav-tabs ">
										<li class="active">
											<a data-toggle="tab" href="#tab-1">Buscar ticket</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-2">Nuevo</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-3">Abiertos <span class="badge coutAbiertos">0</span></a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-4">Inclumplidos <span class="badge">0</span></a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-5">Asignados <span class="badge coutnAsigados">0</span></a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="tab-1" class="tab-pane fade active in cont-form2">
											<div class="row">
												<div class="col-md-12">
													<h4>Buscar tiket en el sistema:</h4>
												</div>
											</div>
											<div class="row">
												 <div class="col-md-6 form-group">
													<label>Nombre del Cliente</label>
													<input type="text" name="NombreCliente" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Numero de ticket</label>
													<input type="text" name="NumeroTicket" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary busqueda">Realizar Busqueda</button>
												</div>
											</div>
											<br>
											<br>
											<div class="listaBusqueda">
											</div>
										</div>
										<div id="tab-2" class="tab-pane fade cont-form1">
											<div class="row">
												<div class="col-md-12">
													<h4>Nuevo Ticket:</h4>
													<div class="pull-right">
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tiempoPrioridad">Asignar tiempo por prioridad</button>
													</div>
												</div>
											</div>
											<div class="row">
												 <div class="col-md-12 form-group">
													<label>Cliente</label>
													<select name="Cliente" class="form-control" id="cliente">
														<option value="">Seleccione...</option>
														<option value="1">Cliente de prueba</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Origen</label>
													<select name="Origen" class="form-control" id="cliente">
														<option value="">Seleccione...</option>
														<option>Llamado Telefónico</option>
														<option>Correo Electrónico</option>
														<option>Presencial</option>
														<option>Pagina Web</option>
														<option>Interno</option>
														<option>Carta</option>
														<option>Otros</option>
													</select>
												</div>
												<div class="col-md-6 form-group">
													<label >Departamento</label>
													<select name="Departamento" class="form-control" id="cliente">
														<option value="">Seleccione...</option>
														<option>Soporte Tecnico</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Tipo</label>
													<select name="Tipo" class="form-control" >
														<option value="">Seleccione...</option>
														<option>Correo</option>
														<option>Problemas de Equipos con Visita</option>
														<option>Problemas de Equipos con Visita</option>
														<option>Problemas Red Interna</option>
														<option>Coordinacion</option>
														<option>Consultas tecnicas</option>
														<option>Falla Masiva</option>
													</select>
												</div>
												<div class="col-md-6 form-group">
													<label >Subtipo</label>
													<select name="Subtipo" class="form-control" >
														<option value="">Seleccione...</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Prioridad</label>
													<select name="Prioridad" class="form-control" >
														<option value="">Seleccione...</option>
														<option>Alta</option>
														<option>Medias</option>
														<option>Baja</option>
													</select>
												</div>
												<div class="col-md-6 form-group">
													<label >Asignar a</label>
													<select name="AsignarA" class="form-control" id="personal">
														<option value="">Seleccione...</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Estado</label>
													<select name="Estado" class="form-control" >
														<option value="">Seleccione...</option>
														<option>Abierto</option>
														<option>Cerrado</option>
														<option>Finalizado</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary guardarTicket">Guardar</button>
												</div>
											</div>
										</div>
										<div id="tab-3" class="tab-pane fade">
											<div class="row">
												<div class="col-md-12">
													<h4>Tickets Abiertos:</h4>
												</div>
											</div>
											<div class="listaAbiertos">

											</div>
										</div>
										<div id="tab-4" class="tab-pane fade">
											<div class="row">
												<div class="col-md-12">
													<h4>Tickets Incunplidos (sin terminar):</h4>
												</div>
											</div>
											<div >
											Todavia no esta lista
											</div>
										</div>
										<div id="tab-5" class="tab-pane fade">
											<div class="row">
												<div class="col-md-12">
													<h4>Tickets con Personal asignado:</h4>
												</div>
											</div>
											<div class="listaAsignados">

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
	<script src="../js/tickets/controller.js"></script>
</body>
</html>

<div class="modal fade" tabindex="-1" role="dialog" id="tiempoPrioridad">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Tiempos por prioridad</h4>
	  </div>
	  <div class="modal-body cont-form3">
		<div class="row">
			<div class="col-md-6 form-group">
				<label>Nombre</label>
				<input type="text" name="nombre" class="form-control">
			</div>
			<div class="col-md-6 form-group">
				<label>Tiempo en horas</label>
				<input type="text" name="tiempo" class="form-control">
			</div>
		</div>
		<div class="listaPrioridad">

		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary guardarPrioridad">Guardar</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->