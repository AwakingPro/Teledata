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
		<link href="../css/teledata.css" rel="stylesheet">
	</head>
	<body>
		<div id="container" class="effect aside-float aside-bright mainnav-sm">
			<div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
			<div class="boxed">
				<div id="content-container">
					<div id="page-title">
						<h1>Bienvenidos a ERP Teledata</h1>
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
											<h3 style="margin-top: 0">Total de Tickes</h3>
											<br>
											<h2 style="margin-top: 0"><span class="total"></span> <br> Tickets</h2>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<h3 style="margin-top: 0">Tickes Abiertos</h3>
											<br>
											<h2 style="margin-top: 0"><span class="abiertos"></span> <br> Tickets abiertos</h2>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<h3 style="margin-top: 0">Tickes Cerrados</h3>
											<br>
											<h2 style="margin-top: 0"><span class="cerrados"></span> <br> Tickets cerrados</h2>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">
											<h3 style="margin-top: 0">Tickes Finalizados</h3>
											<br>
											<h2 style="margin-top: 0"><span class="finalizados"></span> <br> Tickets finalizados</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="panel">
									<div class="panel-body">
										<h3 style="margin-top: 0">Lista de clientes creados</h3>
										<div class="listaCliente"></div>
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
	<script src="../js/jquery-2.2.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/methods_global/methods.js"></script>
	<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="../js/bienvenida/controller.js"></script>
</body>
</html>