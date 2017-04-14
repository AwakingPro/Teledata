<?PHP
	require_once('../db/db.php');
	include("../class/admin/conf_gestion.php");
	include("../class/global/global.php");
	require_once('../class/session/session.php');
	$objetoSession = new Session('1,2,3,4,6',false); // 1,4
	//Para Id de Menu Actual (Menu Padre, Menu hijo)
	$objetoSession->crearVariableSession($array = array("idMenu" => "car,car"));
	// ** Logout the current user. **
	$objetoSession->creaLogoutAction(); // VERIFICAR FUNCIONAMIENTO DE ESTE METODO
	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
	{ //
		//to fully log out a visitor we need to clear the session varialbles
		$objetoSession->borrarVariablesSession();
		$objetoSession->logoutGoTo("../index.php");
	}
	$validar = $_SESSION['MM_UserGroup'];
	$objetoSession->creaMM_restrictGoTo();
	$usuario = $_SESSION['MM_Username'];
	$cedente = $_SESSION['cedente'];
	$nombreUsuario = $_SESSION['nombreUsuario'];
?>
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
		<link href="../plugins/dropzone/dropzone.css" rel="stylesheet">
		<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
		<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
		<link href="../css/carga.css" rel="stylesheet">
	</head>
	<body>
		<div id="container" class="effect mainnav-sm">
			<!--NAVBAR-->
			<!--===================================================-->
			<?php include("../layout/header.php"); ?>
			<!--===================================================-->
			<!--END NAVBAR-->
			<div class="boxed">
				<!--CONTENT CONTAINER-->
				<!--===================================================-->
				<div id="content-container">
					<!--Page Title-->
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<div id="page-title">
					</div>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!--End page title-->
					<!--Breadcrumb-->
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<ol class="breadcrumb">
						<li><a href="#">Carga</a></li>
						<li class="active">Modulo Carga Cartera</li>
					</ol>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!--End breadcrumb-->
					<!--Page content-->
					<!--===================================================-->
					<div id="page-content">
						<div class="row">
							<div class="col-md-8">
								<div class="panel minPanel">
									<div class="panel-heading">
										<h3 class="panel-title bg-primary">
											<i class="ti-upload"></i> Subir documento
										</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<p class="text-main text-bold mar-no">Importante!</p>
												<p>El documento a subir solo puede ser formato Excel.</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<form id="file-up" class="dropzone">
													<div class="dz-default dz-message">
														<div class="dz-icon">
															<i class="demo-pli-upload-to-cloud icon-5x"></i>
														</div>
														<div>
															<span class="dz-text">Soltar archivos para cargar</span>
															<p class="text-sm text-muted">Haga clic para seleccionar manualmente</p>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel minPanel">
									<div class="panel-heading">
										<h3 class="panel-title bg-primary">
											<i class="ti-view-list-alt"></i> Tablas Cargadas Temporalmente
										</h3>
									</div>
									<div class="panel-body">
										<div class="col-md-12">
											<div class="list-group" id="TableStatus">
												<a class="list-group-item list-group-item-danger" id="TablePersona">Tabla Persona</a>
												<a class="list-group-item list-group-item-danger" id="TableDeuda">Tabla Deuda</a>
												<a class="list-group-item list-group-item-danger" id="TableFono">Tabla Telefonos</a>
												<a class="list-group-item list-group-item-danger" id="TableDirecciones">Tabla Direcciones</a>
												<a class="list-group-item list-group-item-danger" id="TableMail">Tabla Mail</a>
												<br>
												<button type="button" id="ProcessTables" class="btn btn-primary col-md-12"><i class="fa fa-cogs"></i> PROCESAR TABLAS</button>

											</div>											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title bg-primary">
											<i class="ti-arrows-horizontal"></i> Asociar Columnas de Excel a Columnas Base de Datos
										</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											
										</div>
										
										<br>
										<div class="row">
											<div class="col-md-12">
												<label>
													Hojas del Archivo Excel
												</label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group" id="listSheet">
												<h4>No hay documento cargado</h4>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>
													Lista de Tablas
												</label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 form-group">
												<select class="form-control" id="tablas" data-live-search="true" disabled="disabled">
													<option value="">Seleccione...</option>
													<option value="Persona_tmp">Personas</option>
													<option value="Deuda_tmp">Deudas</option>
													<option value="fono_cob_tmp">fono_cob</option>
													<option value="Direcciones_tmp">Direcciones</option>
													<option value="Mail_tmp">Mail</option>
												</select>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn btn-primary" id="AgC" data-toggle="modal" data-target="#AgregarCampo"><i class="ti-plus"></i> Agregar Nuevo Campo</button>
											</div>
										</div>
										<div class="row" id="listTag">
											<div class="col-md-6">
												<label >
													Listas de columnas del documento
												</label>
												<h4>No hay datos</h4>
											</div>
											<div class="col-md-6">
												<label >
													Listas de Campos
												</label>
												<h4>No hay datos</h4>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<button type="button" class="btn btn-success" id="procesar"><i class="ti-save"></i> Guardar Datos</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--===================================================-->
					<!--End page content-->
					<div class="modal fade" tabindex="-1" role="dialog" id="load">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<div class="row">
										<div class="spinner loading"></div>
										<h4 class="text-center">Procesando documento por favor espere...</h4>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					<div class="modal fade" tabindex="-1" role="dialog" id="Cargando">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<div class="row">
										<div class="spinner loading"></div>
										<h4 class="text-center">Procesando por favor espere...</h4>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					<div class="modal fade" tabindex="-1" role="dialog" id="alertFile">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3>Disculpe!</h3>
								<h4>El archivo q esta intentando subir no corresponde al tipo de documento correcto</h4>
								<h4>Por favor verifique e intende de nuevo.</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->

						<div class="modal fade" tabindex="-1" role="dialog" id="alertProcesar">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-body">
								<div class="Content" style="max-height: 400px;overflow: auto;"></div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<div class="modal fade" tabindex="-1" role="dialog" id="AgregarCampo">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Agregar un Campo Nuevo</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6 form-group">
											<label>
												Nombre del campo
											</label>
											<input type="text" class="form-control" name="NomCam">
										</div>
										<div class="col-md-6">
											<label>
												Tipo de campo
											</label>
											<select name="TipCam" class="form-control" data-live-search="true">
												<option>Seleccione...</option>
												<option>varchar(50)</option>
												<option>varchar(100)</option>
												<option>varchar(500)</option>
												<option>date</option>
												<option>int</option>
												<option>double</option>
												<option>tinyint</option>
											</select>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="AgCp"><i class="ti-save"></i> Crear Campo</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
				<!--===================================================-->
				<!--END CONTENT CONTAINER-->
				<!--MAIN NAVIGATION-->
				<!--===================================================-->
				<?php include("../layout/main-menu.php"); ?>
				<!--===================================================-->
				<!--END MAIN NAVIGATION-->
			</div>
			<!-- FOOTER -->
			<!--===================================================-->
			<footer id="footer">
				<!-- Visible when footer positions are fixed -->
				<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
				<div class="show-fixed pull-right">
					<ul class="footer-list list-inline">
					</li>
				</ul>
			</div>
		</footer>
		<!--===================================================-->
		<!-- END FOOTER -->
		<!-- SCROLL TOP BUTTON -->
		<!--===================================================-->
		<button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->


		<!--JAVASCRIPT-->
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/funciones.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../plugins/fast-click/fastclick.min.js"></script>
		<script src="../js/nifty.min.js"></script>
		<script src="../plugins/skycons/skycons.min.js"></script>
		<script src="../plugins/switchery/switchery.min.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../js/demo/nifty-demo.min.js"></script>
		<script src="../js/global.js"></script>
		<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
		<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../plugins/dropzone/dropzone.min.js"></script>
		<script src="../plugins/bootbox/bootbox.min.js"></script>
		<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../js/carga/controller.js"></script>
	</body>
</html>
