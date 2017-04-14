<?PHP
	require_once('../db/db.php');
	include("../class/admin/conf_gestion.php");
	include("../class/global/global.php");
	require_once('../class/session/session.php');
	$objetoSession = new Session('1,2,3,4,6',false); // 1,4
	//Para Id de Menu Actual (Menu Padre, Menu hijo)
	$objetoSession->crearVariableSession($array = array("idMenu" => "adm,cpg"));
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
		<link href="../plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		<link href="../plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
		<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
		<style type="text/css" media="screen">
			.img-lg{
				width: 150px;
				height: 150px;
			}
			.pad-ver {
				padding-top: 0;
				padding-bottom: 0;
				margin: 0 auto;
				margin-bottom: 15px;
			}
			.fileinput-filename {
				display: block;
				margin-top: 10px;
			}
		</style>

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
						<h1>Editar Mi perfil</h1>
					</div>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!--End page title-->
					<!--Breadcrumb-->
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>
						<li class="active">Editar Perfil</li>
					</ol>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!--End breadcrumb-->
					<!--Page content-->
					<!--===================================================-->
					<div id="page-content">
						<div class="row">
							<div class="col-md-4">
								<div class="panel">
								            <!-- Simple profile -->
								            <div class="text-center pad-all bord-btm">
								                <div  class="pad-ver cont-preImg2 img-border img-circle img-lg" style="overflow: hidden;">
								                    <img src="../img/av1.png" class="img-lg img-circle" alt="Profile Picture">
								                </div>
								                <h3 class="text-overflow mar-no"><?php echo $_SESSION['nombreUsuario']; ?></h3>
								                <h4 class="text-muted"><?php echo $_SESSION['emailUsuario']; ?></h4>
								                <h4 class="text-muted"><?php echo $_SESSION['cargoUsuario']; ?></h4>
								            </div>
								            <form class="cont-form">
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
													<label>Nombre de usuario</label>
												    	<input type="text" class="form-control" value="<?php echo $_SESSION['MM_Username']; ?>">
												  </div>
												<div class="form-group">
													<input id="pass" class="magic-checkbox check" type="checkbox">
													<label for="pass">Cambiar contraseña</label>
												</div>
												<div class="form-group">
													<label>Contraseña actual</label>
												    	<input type="text" class="form-control pass1" disabled="disabled">
												  </div>
												  <div class="form-group">
													<label>Nueva contraseña</label>
												    	<input type="text" class="form-control pass2" disabled="disabled">
												  </div>
												  <div class="form-group">
													<label>Repita su contraseña</label>
												    	<input type="text" class="form-control pass3" disabled="disabled">
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
		<script src="../plugins/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
		<script src="../plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<script src="../js/global.js"></script>
	</body>
</html>
<script>
$(document).ready(function() {

	function showPreview(coords) {
		var height = $('.imgSelect').width();
		var width = $('.imgSelect').height();
		var rx = 150 / coords.w;
		var ry = 150 / coords.h;

		$('#x1').val(coords.x);
		$('#y1').val(coords.y);
		$('#x2').val(coords.x2);
		$('#y2').val(coords.y2);
		$('#w1').val(coords.w);
		$('#h1').val(coords.h);
		$('#w2').val(width);
		$('#h2').val(height);

		$('.imgPreview').css({
			width: Math.round(rx * height) + 'px',
			height: Math.round(ry * width) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
	}

	$(".adjuntar-img").on("change", function() {
		obj = this;
		Archivo = obj.files[0];
		ManejadorArchivo = new FileReader();
		ManejadorArchivo.onload = function(evento) {
			Url = evento.target.result;
			Img1 = '<img src="' + Url + '" class="img-responsive imgSelect">';
			Img2 = '<img src="' + Url + '" class="imgPreview">';
			$('.cont-preImg1').html(Img1);
			$('.cont-preImg2').html(Img2);
			var h = $('.imgSelect').width();
			var w = $('.imgSelect').height();
			var xh1 = h * 0.1;
			var xw1 = w * 0.1;
			var xh2 = h * 0.9;
			var xw2 = w * 0.9;
			if (w > h) {
				v1 =  xh1;
				v2 =  xh2;
			}else{
				v1 =  xw1;
				v2 =  xw2;
			}
			$('.imgSelect').Jcrop({
				onChange: showPreview,
				onSelect: showPreview,
				setSelect:   [ v1, v1, v2, v2 ],
				aspectRatio: 1
			});
		}
		ManejadorArchivo.readAsDataURL(Archivo);
	});

	$('.check').on('change',function(){
		if( $(this).prop('checked')) {
			$('.pass1').attr('disabled', false);
			$('.pass2').attr('disabled', false);
			$('.pass3').attr('disabled', false);
		}else{
			$('.pass1').attr('disabled', true);
			$('.pass2').attr('disabled', true);
			$('.pass3').attr('disabled', true);
		}
	});

	$('#procesar').on('click', function(){
		var formValues = new FormData();
		formValues.append('file', $('.adjuntar-img')[0].files[0]);
       		 $('.cont-form').find("input").each(function(index, elemento) {
			formValues.append($(elemento).attr('name'), $(elemento).val());
       		 });
		 $.ajax({
		            url: 'uploadUpdate.php',
		            type: 'POST',
		            data: formValues,
		            processData: false,
		            contentType: false,
		            success: function(e) {
		              	console.log(e);
		            }
		        });
	});
});
</script>
