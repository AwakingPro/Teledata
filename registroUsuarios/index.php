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
						<li><a href="#">Configuracion</a></li>
						<li class="active">Registro de Usuarios</li>
					</ol>
					<div id="page-content">
						<div class="row">
							<div class="col-md-12">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title">
										<i class="ti-user"></i> Lista de Usuarios Registrados
										</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-10"><h3>Usuarios registrados</h3></div>
											<div class="col-md-2"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#RegistroUsuario">Registrar Usuario Nuevo</button></div>
										</div>
										<div class="row">
											<br>
											<br>
											<div class="col-md-12 listaUsuarios"></div>
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
		<div class="modal fade" id="RegistroUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registro de Usuario</h4>
					</div>
					<div class="modal-body container-form">
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Usuario</label>
								<input name="usuario" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Nombre</label>
								<input name="nombre" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Privelegios</label>
								<select name="previlegios" class="selectpicker form-control" data-live-search="true">
									<option value=""> Seleccione...</option>
									<option value="1">Administrador</option>
									<option value="2">Soporte</option>
									<option value="3">Terreno</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label>Cargo</label>
								<input name="cargo" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Correo</label>
								<input name="correo" class="form-control">
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary insertUsurio">Guardar usuario</button>
					</div>
				</div>
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
		<script src="../js/registroUsuario/controller.js"></script>

	</body>
</html>

<div class="modal fade" tabindex="-1" role="dialog" id="editarPerfil" aria-labelledby="editarCliente">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar perfil</h4>
			</div>
			<div class="modal-body container-form-update">
				<div class="row">
							<div class="col-md-6 form-group">
								<label>Usuario</label>
								<input name="usuarioUpdate" class="form-control">
								<input name="idPerfil" class="form-control" type="hidden">
							</div>
							<div class="col-md-6 form-group">
								<label>Nombre</label>
								<input name="nombreUpdate" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Password</label>
								<input type="password" name="passUpdate" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Privelegios</label>
								<select name="previlegiosUpdate" class="selectpicker form-control" data-live-search="true">
									<option value=""> Seleccione...</option>
									<option value="1">Administrador</option>
									<option value="2">Soporte</option>
									<option value="3">Terreno</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label>Cargo</label>
								<input name="cargoUpdate" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Correo</label>
								<input name="correoUpdate" class="form-control">
							</div>

						</div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<button type="button" class="btn btn-primary actualizarPerfil">Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>