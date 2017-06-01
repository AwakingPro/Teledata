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
						<h1 class="page-header text-overflow">Modulo de Cliente</h1>
					</div>
					<br>
					<ol class="breadcrumb">
						<li><a href="#">Módulo Cliente</a></li>
						<li class="active">Crear Cliente</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel ">
									<!--Panel heading-->
									<div class="panel-heading">
										<div class="panel-control">
											<!--Nav tabs-->
											<ul class="nav nav-tabs">
												<li class="active"><a data-toggle="tab" href="#demo-tabs-box-1">Crear Nuevo Cliente</a></li>
												<li><a data-toggle="tab" href="#demo-tabs-box-2">Ver Lista de clientes</a></li>
											</ul>
										</div>
										<h3 class="panel-title">Opciones de modulo cliente</h3>
									</div>
									<!--Panel body-->
									<div class="panel-body">
										<!--Tabs content-->
										<div class="tab-content">
											<div id="demo-tabs-box-1" class="tab-pane fade in active">
												<p class="text-main text-lg mar-no">First Tab Content</p>
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
											</div>
											<div id="demo-tabs-box-2" class="tab-pane fade">
												<p class="text-main text-lg mar-no">Second Tab Content</p>
												Duis autem vel eum iriure dolor in hendrerit in vulputate.
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
</body>
</html>