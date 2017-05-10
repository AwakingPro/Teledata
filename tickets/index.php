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
	</head>
	<body>
		<div id="container" class="effect mainnav-lg">
			<?php
				include("../layout/header.php");
			?>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title">
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
											<a data-toggle="tab" href="#tab-3">Abiertos</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-4">Inclumplidos</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-5">Asignados</a>
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
										</div>
										<div id="tab-2" class="tab-pane fade cont-form1">
											<div class="row">
												<div class="col-md-12">
													<h4>Nuevo Ticket:</h4>
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
													<input type="text" name="Origen" value="" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label >Departamento</label>
													<input type="text" name="Departamento" value="Soporte Tecnico" class="form-control" readonly>
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
														<option>Creacion de Correo</option>
														<option>Configuracion Correo</option>
														<option>Lista Negra,Spam</option>
														<option>Poco manejo computacional</option>
														<option>Desconfiguracion equipos</option>
														<option>Reinicio de equipos</option>
														<option>Interferencia</option>
														<option>Equipos desconectados</option>
														<option>Desconfiguracion equipos</option>
														<option>Reinicio de equipos</option>
														<option>Interferencia</option>
														<option>Equipos desconectados</option>
														<option>Poco conocimiento</option>
														<option>Equipo cliente</option>
														<option>Equipos desconectados</option>
														<option>Desconocido</option>
														<option>Visita tecnica</option>
														<option>Reagendamientos</option>
														<option>Informacion del servicio</option>
														<option>Informacion estado</option>
														<option>Estacion sin energia</option>
														<option>Interferencia</option>
														<option>Corte de fibra</option>
														<option>Tormenta Solar</option>
														<option>Desconfiguracion de equipos</option>

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
											<div class="listaAbiertos">

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
			<?php include("../layout/main-menu.php"); ?>
		</div>
		<?php include("../layout/footer.php"); ?>
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