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
						<li class="active">Tickets</li>
					</ol>
					<div id="page-content">

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
	<script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../js/tickets/controller.js?v=<?php echo (rand()); ?>"></script>
</body>
</html>
<div class="modal fade" id="tiempoPrioridad">
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
					<input type="hidden" name="idUpdatePrioridad" value="">
				</div>
				<div class="listaPrioridad">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default cancelarPrioridad">Limpiar</button>
				<button type="button" class="btn btn-primary guardarPrioridad">Guardar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="actualizarTicket">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Ticket</h4>
			</div>
			<div class="modal-body cont-form4">
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Cliente</label>
						<select name="ClienteUpdate" class="form-control" id="cliente" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group ServicioUpdate">
						<label>Servicio</label>
						<select name="ServicioUpdate" class="selectpicker form-control" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="row OrigenDepartamento">
					<div class="col-md-6 form-group">
						<label >Origen</label>
						<select name="OrigenUpdate" class="form-control selectpicker" id="cliente" data-live-search="true">
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
						<select name="DepartamentoUpdate" class="form-control selectpicker" id="cliente" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label >Tipo</label>
						<select name="TipoUpdate" class="form-control" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<label >Subtipo</label>
						<select name="SubtipoUpdate" class="form-control subTipo" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group Prioridad">
						<label >Prioridad</label>
						<select name="PrioridadUpdate" class="form-control" data-live-search="true">
						</select>
					</div>
					<div class="col-md-6 form-group">
						<label >Asignar a</label>
						<select name="AsignarAUpdate" class="form-control" id="personal" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
					<div class="col-md-6 form-group Estado">
						<label >Estado</label>
						<select name="EstadoUpdate" class="form-control selectpicker" data-live-search="true">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label >Observaciones</label>
						<textarea name="ObservacionesUpdate" class="form-control"></textarea>
					</div>
				</div>
				<input type="hidden" name="idUpdateTicket">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary updateTicket">Actualizar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalTipos">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Tipo</h4>
			</div>
			<div class="modal-body cont-form5">
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Nombre del tipo de ticket</label>
						<input type="text" name="nombreTipo" class="form-control">
					</div>
					<input type="hidden" name="idUpdateTipoTicket" value="">
				</div>
				<div class="listaTipoTicket">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default cancelarTipoTicket">Limpiar</button>
				<button type="button" class="btn btn-primary guardarTipoTicket">Guardar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalSubTipo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar SubTipo</h4>
			</div>
			<div class="modal-body cont-form6">
				<div class="row">
					<div class="col-md-6 form-group">
						<label>Tipo ticket</label>
						<select class="form-control" name="IdTipoTicket">
							<option value="">Seleccione...</option>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<label>Nombre del subtipo</label>
						<input type="text" name="nombreSubTipo" class="form-control">
					</div>
					<input type="hidden" name="idUpdateSubtipoTicket" value="">
				</div>
				<div class="listaSubTipoTicket">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default cancelarSubTipoTicket">Limpiar</button>
				<button type="button" class="btn btn-primary guardarSubTipoTicket">Guardar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="comentarios">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Comentarios</h4>
			</div>
			<div class="modal-body">
			<div class="cont-comentarios" style="overflow-y: auto;overflow-x: hidden;max-height: 400px;">

			</div>
			</div>
			<div class="modal-footer">
				<textarea class="form-control textComentario"></textarea>
				<br>
				<button type="button" class="btn btn-primary guardarComentario">Guardar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->