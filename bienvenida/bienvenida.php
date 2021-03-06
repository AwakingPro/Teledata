<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ERP | Teledata</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/nifty.min.css" rel="stylesheet">
		<link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
		<link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="container" class="effect aside-float aside-bright mainnav-sm">
			<div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title">
						<!-- <h1>Bienvenidos a ERP Teledata</h1> -->
					</div>
					<div id="page-content">
						<div class="row">
							<div class="col-md-4">
								<div class="panel">
									<div class="panel-bg-cover">
										<img class="img-responsive" src="../img/thumbs/img1.jpg" alt="Image">
									</div>
									<div class="panel-media imgUser">
										<img class="panel-media-img img-circle img-border-light" src="../img/av1.png" alt="Profile Picture">
									</div>
									<div class="panel-body">
										<h3 class="nameUser">Teledata ERP</h3>
										<br>
										Para obtener ayuda descargue aquí el manual de usuario <br>
										<i class="pli-information icon-lg icon-fw"></i> Ayuda
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-10"><h1 class="marginNull numberMiniPanel" style="color: #2ab4c0; margin-left: 5px;"><span class="total"></span></h1> </div>
												<div class="col-xs-2"><h1 class="marginNull" style="    color: #cbd4e0;"><i class="fa fa-ticket" aria-hidden="true"></i></h1></div>
												<div class="col-md-12"><h2 class="marginNull textMiniPanel">Tickets totales</h2></div>
												<div class="col-md-12" style="margin-top: 27px;">
													<div class="progress">
														<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</div>
												<div class="col-xs-10 smalTextMiniPanel"> El porcentaje es de </div>
												<div class="col-xs-2 smalTextMiniPanel">100%</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-10"><h1 class="marginNull numberMiniPanel" style="color: #f36a5a; margin-left: 5px;"><span class="abiertos"></span></h1> </div>
												<div class="col-xs-2"><h1 class="marginNull" style="    color: #cbd4e0;"><i class="fa fa-ticket" aria-hidden="true"></i></h1></div>
												<div class="col-md-12"><h2 class="marginNull textMiniPanel">Tickets totales abiertos</h2></div>
												<div class="col-md-12" style="margin-top: 27px;">
													<div class="progress">
														<div class="progress-bar progress-bar-danger porcAbiertos" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</div>
												<div class="col-xs-10 smalTextMiniPanel"> El porcentaje es de </div>
												<div class="col-xs-2 smalTextMiniPanel porcAbiertosTxt">0%</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-md-4">



							<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-10"><h1 class="marginNull numberMiniPanel" style="color: #8877a9; margin-left: 5px;"><span class="cerrados"></span></h1> </div>
												<div class="col-xs-2"><h1 class="marginNull" style="    color: #cbd4e0;"><i class="fa fa-ticket" aria-hidden="true"></i></h1></div>
												<div class="col-md-12"><h2 class="marginNull textMiniPanel">Tickets totales cerrados</h2></div>
												<div class="col-md-12" style="margin-top: 27px;">
													<div class="progress">
														<div class="progress-bar porcCerrados" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</div>
												<div class="col-xs-10 smalTextMiniPanel"> El porcentaje es de </div>
												<div class="col-xs-2 smalTextMiniPanel porcCerradosTxt">0%</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-10"><h1 class="marginNull numberMiniPanel" style="color: #5C9BD1; margin-left: 5px;"><span class="finalizados"></span></h1> </div>
												<div class="col-xs-2"><h1 class="marginNull" style="    color: #cbd4e0;"><i class="fa fa-ticket" aria-hidden="true"></i></h1></div>
												<div class="col-md-12"><h2 class="marginNull textMiniPanel">Tickets totales finalizados</h2></div>
												<div class="col-md-12" style="margin-top: 27px;">
													<div class="progress">
														<div class="progress-bar progress-bar-info porcFinalizado" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</div>
												<div class="col-xs-10 smalTextMiniPanel"> El porcentaje es de </div>
												<div class="col-xs-2 smalTextMiniPanel porcFinalizadoTxt">0%</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<?php
							$OcultarTareasPorHacer = true;
							$Titulo = 'Mis';
							$idUsuario = $_SESSION['idUsuario'];
                            echo "<input type='hidden' id='idUsuario' name='idUsuario' value=".$idUsuario."> ";
                            include '../componentes/componentes_tareas/tabla_tareas_servicios.php';
                        ?>
						<div class="row">
							<div class="col-md-6">
								<div class="panel">
									<div class="panel-body">
										<h3 style="margin-top: 0">Lista de clientes creados</h3>
										<div class="listaCliente"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel">
									<div class="panel-body">
										<h3 style="margin-top: 0">Mis servicios contratados</h3>
										<div class="listaServicio"></div>
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

	<?php
        // Muestra Modal con select de usuarios al cual asignarle una tarea
		// include '../componentes/componentes_tareas/modal_Asignar.php';
		
        // Muestra Modal con select de usuarios al cual Reasignarle una tarea
        include '../componentes/componentes_tareas/modal_Reasignar.php';

        // Muestra Modal para editar una tarea
        include '../componentes/componentes_tareas/modal_EditarTarea.php';

        // Muestra Modal para comparar una tarea
        include '../componentes/componentes_tareas/modal_CompararTarea.php';

        // Muestra Modal para Ver Detalles del Servicio
        include '../componentes/componentes_servicios/modal_DetalleServicio.php';

        // Muestra Modal con info del cliente
        include '../componentes/componentes_servicios/modal_InfoCliente.php';
    ?>

	<script src="../js/jquery-2.2.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
	<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../plugins/sweetalert/sweetalert.min.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../plugins/bootstrap-select/i18n/defaults-es_CL.min.js"></script>
	<script src="../plugins/moment/moment.js"></script>
	<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
	<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
	<script src="../plugins/numbers/jquery.number.min.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/tareas/Tarea.js?v=<?php echo (rand()); ?>"></script>
	<script src="../js/bienvenida/controller.js?v=<?php echo (rand()); ?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
</body>
</html>

