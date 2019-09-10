<?php
$id_cliente = $_GET['cliente'];

?>

<?php 
    require_once('../class/methods_global/methods.php'); 
	require_once('../ajax/cliente/listaResumenCliente.php');
?>
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
						<!-- <h1>Bienvenidos a ERP Teledata</h1> -->
					</div>
					<div id="page-content">

						<div class="row">
							<?php
								include 'resumen/cliente-info.php';
								include 'resumen/documentos-extras.php';
							?>
							<div class="col-md-3">
								<?php 
									include 'resumen/documentos-vencidos.php';
									include 'resumen/servicios.php';
									include 'resumen/saldo.php';
									// include 'resumen/cliente-estado.php'
								?>
							</div>
							
						</div>
						<div class="row">
							<?php
								include 'resumen/documentos-emitidos.php';
								include 'resumen/documentos-pagados.php';
							?>
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
	<script type="text/javascript" src="../plugins/moment/moment.js"></script>
	<!-- <script src="../js/bienvenida/controller.js"></script> -->
	<script src="../js/resumenCliente/resumenCliente.js"></script>
</body>
</html>