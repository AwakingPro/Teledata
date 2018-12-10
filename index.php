<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TELEDATA</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/nifty.min.css" rel="stylesheet">
		<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/teledata.css" rel="stylesheet">
		<?php
			include 'http://localhost/Teledata/modulos/links.php';
		?>
	</head>
	<body>
		<div id="container" class="cls-container">
			<div id="bg-overlay" class="bg-img img-balloon"></div>
			<div class="cls-header cls-header-lg">
				<div class="cls-brand">
					<a class="box-inline" href="index.php">
						<span class="brand-title">TELEDATA ERP<span class="text-thin"></span></span>
					</a>
				</div>
			</div>
			<div class="cls-content">
				<div class="cls-content-sm panel">
					<div class="panel-body">
						<div class="pad-btm">
							<h3>Acceso al Sistema</h3>
						</div>
						<form class="cont-form">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<input type="text" name="usuario" validate="not_null" class="form-control height40" placeholder="Usuario ">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
									<input type="password" name="password" validate ="not_null" class="form-control height40" placeholder="Contraseña">
								</div>
							</div>
							<button class="btn btn-primary btn-block btn-lg enviarForm" type="button">
							<i class="fa fa-circle-o-notch "></i> Iniciar Sesión
							</button>
							<br>
						</form>
						<div class="load"></div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery-2.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/nifty.min.js"></script>
		<script src="plugins/bootbox/bootbox.min.js"></script>
		<script src="js/methods_global/methods.js"></script>
		<script src="js/login/login.js"></script>
	</body>
</html>