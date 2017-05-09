<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Foco | Software de Estrategia</title>
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
		<script src="../plugins/pace/pace.min.js"></script>
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
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
										<div id="tab-1" class="tab-pane fade active in">
											<div class="row">
												<div class="col-md-12">
													<h4>Buscar tiket en el sistema:</h4>
												</div>
											</div>
											<div class="row">
												 <div class="col-md-6 form-group">
													<label>Nombre del Cliente</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Numero de ticket</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary">Realizar Busqueda</button>
												</div>
											</div>
										</div>
										<div id="tab-2" class="tab-pane fade">
											<div class="row">
												<div class="col-md-12">
													<h4>Nuevo Ticket:</h4>
												</div>
											</div>
											<div class="row">
												 <div class="col-md-12 form-group">
													<label>Cliente</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Origen</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label >Departamento</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Tipo</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label >Subtipo</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Prioridad</label>
													<input type="text" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label >Asignar a</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label >Estado</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary">Guardar</button>
												</div>
											</div>
										</div>
										<div id="tab-3" class="tab-pane fade">
											lol
										</div>
										<div id="tab-4" class="tab-pane fade">
											lol
										</div>
										<div id="tab-5" class="tab-pane fade">
											<div id="mostrar_gestion_total_ocultar">Datos Técnicos</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--===================================================-->
				<!--End page content-->
			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
			<!--MAIN NAVIGATION-->
			<!--===================================================-->
			<?php include("../layout/main-menu.php"); ?>
			<!--===================================================-->
			<!--END MAIN NAVIGATION-->
			<!--ASIDE-->
			<!--===================================================-->
			<!--END ASIDE-->
		</div>
		<!-- FOOTER -->
		<!--===================================================-->
		<?php include("../layout/footer.php"); ?>
		<!--===================================================-->
		<!-- END FOOTER -->
		<!-- SCROLL TOP BUTTON -->
		<!--===================================================-->
		<button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
		<div class="modal"><!-- Place at bottom of page --></div>
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->
	<!--JAVASCRIPT-->
	<script src="../js/jquery-2.2.1.min.js"></script>
	<script src="../js/usuarios/usuarios.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../plugins/fast-click/fastclick.min.js"></script>
	<script src="../js/nifty.min.js"></script>
	<script src="../plugins/morris-js/morris.min.js"></script>
	<script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
	<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
	<script src="../plugins/skycons/skycons.min.js"></script>
	<script src="../plugins/switchery/switchery.min.js"></script>
	<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../js/demo/nifty-demo.min.js"></script>
	<script src="../plugins/bootbox/bootbox.min.js"></script>
	<script src="../js/demo/ui-alerts.js"></script>
	<script src="../js/global/funciones-global.js"></script>
</body>
</html>