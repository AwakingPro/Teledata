<?php
include_once("../includes/functions/Functions.php");
Main_IncludeClasses("db");
Main_IncludeClasses("reclutamiento");
$ReclutamientoClass = new Reclutamiento();
$PruebasDisponibles = $ReclutamientoClass->usuarioTienePruebasDisponibles();
?>
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
								<h1>Prueba </h1>
							</div>
							<div class="page-toolbar">
								<!--<button type="button" class="btn btn-primary ladda-button" id="Calificar"  data-style="expand-right" style="margin-top: 15px;"><span class="ladda-label"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Continuar</span></button>-->
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
									<span>Prueba</span>
								</li>
							</ul>
							<div class="page-content-inner">
								<div class="row">
									<div class="portlet light">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-pencil-square-o"></i>
													<span class="caption-subject bold uppercase"> <?php if(!$PruebasDisponibles){ echo 'Aviso'; }else{ echo 'Preguntas'; } ?></span>
												</div>
												<div class="actions">
													<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
												</div>
											</div>
										<div class="portlet-body">
											<?php
											$Prueba = "";
											if($PruebasDisponibles){
												$ArrayABC = array(0=>"");
												for ($i=65;$i<=90;$i++) {
													array_push($ArrayABC,strtolower(chr($i)));
												}
												$Prueba = $ReclutamientoClass->getPruebaActiva();
												$ReclutamientoClass->Perfil = $Prueba["id_perfil"];
												switch($Prueba["id_tipotest"]){
													case '1': //Default
														$Preguntas = $ReclutamientoClass->getPreguntas();
														$Cont = 1;
														if(count($Preguntas) > 0){
															foreach($Preguntas as $Pregunta){
																$ReclutamientoClass->idPregunta = $Pregunta["id"];
																$Opciones = $ReclutamientoClass->getOpciones();
																?>
																<div class="Pregunta" style="margin-top: 20px;" id="Pr_<?php echo $Pregunta['id']; ?>">
																	<h4><?php echo $Cont.".- ".utf8_encode($Pregunta["pregunta"]); ?></h4>
																	<form class="form-block">
																		<?php
																		foreach($Opciones as $Opcion){
																		?>
																		<div class="row" style="padding: 5px 0;margin-left: 20px;">
																			<label class="form-radio form-normal"><input type="radio" id="Op_<?php echo $Opcion['id']; ?>" name="<?php echo $Pregunta['id']; ?>"> <?php echo $Opcion['opcion']; ?></label>
																		</div>
																		<?php
																		}
																		?>
																	</form>
																</div>
																<?php
																$Cont++;
															}
															?>
																<br>
																<div class="row">
																	<div class="col-md-12">
																		<button class="btn btn-primary btn-lg pull-right" id="Calificar">Continuar</button>
																	</div>
																</div>
																<br>
															<?php
														}else{
														echo "No hay preguntas disponibles";
														}
													break;
													case '2': //Test de Competencias
														$Preguntas = $ReclutamientoClass->getPreguntasCompetencias();
														$Cont = 1;
														if(count($Preguntas) > 0){
															foreach($Preguntas as $Pregunta){
																$ReclutamientoClass->idPregunta = $Pregunta["id"];
																$Opciones = $Pregunta['opciones'];
																$ArrayOpciones = array();
																$ArrayOpcionesTmp = explode(";",$Opciones);
																foreach($ArrayOpcionesTmp as $Opcion){
																	$Array = explode("_",$Opcion);
																	$Array = array("Value"=>$Array[0],"Text"=>$Array[1]);
																	array_push($ArrayOpciones,$Array);
																}
																$ArrayOpciones = array_sort($ArrayOpciones,"Value");
																$Opciones = $ReclutamientoClass->getOpcionesCompetencias();
																?>
																<div class="Pregunta" style="margin-top: 20px;" id="Pr_<?php echo $Pregunta['id']; ?>">
																	<h4><?php echo $Cont.".- ".utf8_encode($Pregunta["pregunta"]); ?></h4>
																	<form class="form-block">
																		<?php
																		$ContOpcion = 1;
																		foreach($Opciones as $Opcion){
																			?>
																			<div class="row Options" style="padding: 5px 0;margin-left: 20px;">
																				<h5 style="margin: 0 !important;"><?php echo $ArrayABC[$ContOpcion].") ".utf8_encode($Opcion['opcion']); ?></h5 style="margin: 0 !important;">
																				<div class="btn-group mt-radio-inline" style="padding-top: 15px;">
																					<?php
																					foreach($ArrayOpciones as $OpcionPregunta){
																					?>
																					<label class="mt-radio"><input type="radio" name="option_<?php echo $Pregunta['id']."_".$OpcionPregunta['Value']; ?>" value="<?php echo $Opcion['ponderacion']."_".$OpcionPregunta['Value']; ?>"><?php echo $OpcionPregunta["Text"]; ?><span></span></label>
																					<?php
																					}
																					?>
																				</div>
																			</div>
																			<?php
																			$ContOpcion++;
																		}
																		?>
																	</form>
																</div>
																<?php
																$Cont++;
															}
															?>
																<br>
																<div class="row">
																	<div class="col-md-12">
																		<button class="btn btn-primary btn-lg pull-right" id="Calificar">Continuar</button>
																	</div>
																</div>
																<br>
															<?php
														}else{
														echo "No hay preguntas disponibles";
														}
													break;
												}
											}else{
											echo "Usted ya participo en el proceso de reclutamiento, debe esperar el proceso de calificación.";
											}
											?>
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
    </body>


<script src="theme/plugins/jquery.min.js" type="text/javascript"></script>
<script src="theme/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="theme/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="theme/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="theme/js/app.min.js" type="text/javascript"></script>
<script src="theme/js/layout.min.js" type="text/javascript"></script>
<script src="theme/js/demo.min.js" type="text/javascript"></script>
<script src="theme/js/quick-nav.min.js" type="text/javascript"></script>
<script src="theme/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="theme/plugins/ladda/spin.min.js" type="text/javascript"></script>
<script src="theme/plugins/ladda/ladda.min.js" type="text/javascript"></script>
<script src="../plugins/bootbox/bootbox.min.js"></script>
<script>$('.nameUser').load('ajax/nameUser.php');</script>
    <?php
        if($PruebasDisponibles){
            ?>
                <script src="../js/reclutamiento/prueba_<?php echo $Prueba['id_tipotest']; ?>.js"></script>
            <?php
        }
    ?>
</body>
</html>