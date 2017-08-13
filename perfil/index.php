<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
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
		<link href="../plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		<link href="../plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
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
						<li class="active">Perfil</li>
					</ol>
					<div id="page-content">
						<div class="row container-form">
							<div class="col-md-4">
								<div class="panel">
									<!-- Simple profile -->
									<div class="text-center pad-all bord-btm">
										<div  class="pad-ver cont-preImg2 img-border img-circle img-lg" style="overflow: hidden;">
											<img src="../img/av1.png" class="img-lg img-circle" alt="Profile Picture">
										</div>
										<h3 class="text-overflow mar-no NombreUser">Nombre de Usuario</h3>
										<h4 class="text-muted Cargo">Correo de Usuario</h4>
										<h4 class="text-muted Nivel">Cargo de Usuario</h4>
									</div>
									<form>
										<input type="hidden" name="x1" id="x1">
										<input type="hidden" name="y1" id="y1">
										<input type="hidden" name="x2" id="x2">
										<input type="hidden" name="y2" id="y2">
										<input type="hidden" name="w1" id="w1">
										<input type="hidden" name="h1" id="h1">
										<input type="hidden" name="w2" id="w2">
										<input type="hidden" name="h2" id="h2">
									</form>
								</div>
							</div>
							<div class="col-md-8">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title">
										<i class="ti-user"></i> Datos de Usuario
										</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Usuario</label>
													<input type="text" class="form-control" name="Usuario">
												</div>
												<div class="form-group">
													<label>Nombre</label>
													<input type="text" class="form-control" name="Nombre">
												</div>
												<div class="form-group">
													<label>Correo</label>
													<input type="text" class="form-control" name="Correo">
												</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<label for="exampleInputEmail1">Cambiar imagen de Perfil</label>
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<span class="btn green btn-success btn-file">
																<span class="fileinput-new"> Seleccione imagen </span>
																<span class="fileinput-exists"> Cambiar imagen </span>
																<input type="file" class="adjuntar-img" name="file">
															</span>
															<span class="fileinput-filename"> </span>
														</div>
													</div>
												</div>
												<div class="col-md-12 cont-preImg1"></div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-12 row">
												<button type="button" class="btn btn-primary" id="procesar"><i class="ti-save"></i> Guardar Datos</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">
									<i class="ti-user"></i> Cambio de Contraseña
									</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 container-form2">
											<div class="form-group">
												<input id="pass" class="magic-checkbox check" type="checkbox">
												<label for="pass">Cambiar contraseña</label>
											</div>
											<div class="form-group">
												<label>Contraseña actual</label>
												<input type="password" name="pass" class="form-control pass1" disabled="disabled">
											</div>
											<div class="form-group">
												<label>Nueva contraseña</label>
												<input type="password" class="form-control pass2" name="pass2" disabled="disabled">
											</div>
											<div class="form-group">
												<label>Repita su contraseña</label>
												<input type="password" class="form-control pass3" name="newPass" disabled="disabled">
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-12 row">
												<button type="button" class="btn btn-primary" id="newPass"><i class="ti-save"></i> Cambio de Contraseña</button>
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
		</div>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>

		<script src="../plugins/bootbox/bootbox.min.js"></script>
		<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
		<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
		<script src="../js/methods_global/methods.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
		<script src="../plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<script src="../js/perfil/controller.js"></script>
	</body>
</html>