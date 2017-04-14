<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Test de Reclutamiento</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta content="Test de Reclutamiento FOCO Estrategico" name="description" />
		<meta content="Foco Estrategico" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="theme/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
		<link href="theme/css/plugins.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/css/layout.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
		<link href="theme/css/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
	</head>
	<body class="page-container-bg-solid page-header-menu-fixed">
		<div class="page-wrapper">
			<div class="page-wrapper-row">
				<div class="page-wrapper-top">
					<div class="page-header">
						<div class="page-header-top">
							<div class="container">
								<div class="page-logo">
									<a href="index.html">
										<img src="theme/img/login-invert.png" alt="logo" class="logo-default">
									</a>
								</div>
								<a href="javascript:;" class="menu-toggler"></a>
								<div class="top-menu">
									<ul class="nav navbar-nav pull-right">
										<li class="dropdown dropdown-user dropdown-dark">
											<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<img alt="" class="img-circle" src="../img/av1.png">
												<span class="username username-hide-mobile"><span class="nameUser">Usuario</span>  <i class="fa fa-angle-down" aria-hidden="true"></i></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-default">
												<li>
													<a href="page_user_login_1.html">
													<i class="icon-key"></i> Cerrar sesion</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="page-header-menu">
							<div class="container">
								<form class="search-form" action="page_general_search.html" method="GET">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Buscar..." name="query">
										<span class="input-group-btn">
											<a href="javascript:;" class="btn submit">
												<i class="icon-magnifier"></i>
											</a>
										</span>
									</div>
								</form>
								<div class="hor-menu  ">
									<ul class="nav navbar-nav">
										<li>
											<a href="javascript:;"> Inicio </a>
										</li>
										<li>
											<a href="actualizar_datos.php"> Actuakizar Datos </a>
										</li>
										<li>
											<a href="prueba.php"> Prueba</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wrapper-row full-height">
		<div class="page-wrapper-middle">
			<div class="page-container">
				<div class="page-content-wrapper">
					<div class="page-head">
						<div class="container">
							<div class="page-title">
								<h1>Actualizar Datos </h1>
							</div>
							<div class="page-toolbar">
								<button type="button" class="btn btn-primary procesar ladda-button"  data-style="expand-right" style="margin-top: 15px;"><span class="ladda-label"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Procesar Datos</span></button>
							</div>
						</div>
					</div>
					<div class="page-content form-cont">
						<div class="container">
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<a href="index.html">Inicio</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Actualizar datos</span>
								</li>
							</ul>
							<div class="page-content-inner">
								<div class="row">
									<div class="alert alert-success alert-dismissible display-hide" Id="Alert">
										<button type="button" class="close" id="closeAlert"><span aria-hidden="true">&times;</span></button>
										<strong>¡Bien hecho!</strong> <span id="mns"></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-pencil-square-o"></i>
													<span class="caption-subject bold uppercase"> Datos Generales</span>
												</div>
												<div class="actions">
													<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">RUT:</label>
															<input type="text" class="form-control" name="rut">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Apellidos:</label>
															<input type="text" class="form-control" name="apellidos">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Nombres:</label>
															<input type="text" class="form-control" name="nombres">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Teléfono:</label>
															<input type="text" class="form-control" name="telefono">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Fecha de nacimiento:</label>
															<input type="text" class="form-control" name="fechaNacimeinto">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Correo:</label>
															<input type="text" class="form-control" name="correo">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-pencil-square-o"></i>
													<span class="caption-subject bold uppercase"> Datos Previcionales</span>
												</div>
												<div class="actions">
													<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">AFP:</label>
															<input type="text" class="form-control" name="afp">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Sistema de Salud:</label>
															<input type="text" class="form-control" name="sistemaSalud">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">UF:</label>
															<input type="text" class="form-control" name="uf">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Ges:</label>
															<input type="text" class="form-control" name="ges">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Pensionado:</label>
															<input type="text" class="form-control" name="pensionado">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-pencil-square-o"></i>
													<span class="caption-subject bold uppercase"> Contactos</span>
												</div>
												<div class="actions">
													<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Nombre:</label>
															<input type="text" class="form-control" name="contactoNombre">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Parentesco:</label>
															<input type="text" class="form-control" name="contactoParentesco">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">N° Celular 1:</label>
															<input type="text" class="form-control" name="contactoCelular1">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">N° Celular 2:</label>
															<input type="text" class="form-control" name="contactoCelular2">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Nombre:</label>
															<input type="text" class="form-control" name="contacto2Nombre">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Parentesco:</label>
															<input type="text" class="form-control" name="contacto2Parentesco">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">N° Celular 1:</label>
															<input type="text" class="form-control" name="contacto2Celular1">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">N° Celular 2:</label>
															<input type="text" class="form-control" name="contacto2Celular2">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-pencil-square-o"></i>
													<span class="caption-subject bold uppercase"> Domicilio</span>
												</div>
												<div class="actions">
													<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label class="control-label">Direccion:</label>
															<textarea class="form-control" name="direccion"></textarea>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Region:</label>
															<input type="text" class="form-control" name="region">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Ciudad:</label>
															<input type="text" class="form-control" name="ciudad">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Comuna:</label>
															<input type="text" class="form-control" name="comuna">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Telefono Fijo:</label>
															<input type="text" class="form-control" name="telefonoFijo">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wrapper-row">
		<div class="page-wrapper-bottom">
			<div class="page-footer">
				<div class="container">
					2017 &copy; FOCO Estrategico
				</div>
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
	</div>
</div>
<script src="theme/plugins/jquery.min.js" type="text/javascript"></script>
<script src="theme/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="theme/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="theme/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="theme/js/app.min.js" type="text/javascript"></script>
<script src="theme/js/layout.min.js" type="text/javascript"></script>
<script src="theme/js/demo.min.js" type="text/javascript"></script>
<script src="theme/js/quick-nav.min.js" type="text/javascript"></script>
<script src="theme/plugins/ladda/spin.min.js" type="text/javascript"></script>
<script src="theme/plugins/ladda/ladda.min.js" type="text/javascript"></script>
<script src="../js/reclutamiento/controller.js"></script>
</body>
</html>