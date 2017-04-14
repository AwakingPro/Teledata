<?php
require_once('db/db.php');
require_once('class/session/session.php');
include("class/usuarios/hash.php");
$objetoSession = new Session('1',false); // ojo con estos valores igual en login no afecta
if (isset($_GET['accesscheck'])) // verificar este caso
{
  $objetoSession->crearVariableSession($array = array("PrevUrl" => $_GET['accesscheck']));
}
// variable que me identifica si el usuario tiene acceso 1 = denegado
$acceso = "";
if (isset($_POST['usuario']))
{
$acceso = $objetoSession->login($_POST['usuario'],$_POST['password'],$conn,$database_name);
} else {
  $objetoSession->borrarVariablesSession();
}
// --------- FIN SESSION -----------

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TELEDATA</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/nifty.min.css" rel="stylesheet">
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
    <link href="plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="plugins/noUiSlider/nouislider.min.css" rel="stylesheet">
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="plugins/summernote/summernote.min.css" rel="stylesheet">
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">
    <script src="plugins/bootbox/bootbox.min.js"></script>
    <link href="plugins/pace/pace.min.css" rel="stylesheet">
    <script src="plugins/pace/pace.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>

</head>
<body>
	<div id="container" class="cls-container">

		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>


		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="index.php">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="brand-title">  TELEDATA ERP<span class="text-thin"></span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->


		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<p class="pad-btm">Acceso al Sistema</p>
					<form action="index.php" method="POST">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<input type="text" name="usuario" class="form-control" placeholder="Usuario">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input type="password" name="password" class="form-control" placeholder="Contraseña">
							</div>
						</div>
            <div class="form-group">
							<div class="input-group">

                <!-- <div class="g-recaptcha" data-sitekey="6LdAtBgUAAAAAI-tq7bczJY2T84a-5FA3aG1CpA3"></div> -->

							</div>
						</div>
						<button class="btn btn-primary btn-md btn-block enviarForm" type="submit" >
							<i class="fa fa-circle-o-notch "></i> Entrar
						</button>
            <br>

					</form>
				</div>
			</div>
			<div class="pad-ver">
			</div>
		</div>
		<!--===================================================-->


		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		<div class="demo-bg">

		</div>
		<!--===================================================-->


	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->



    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
     <script src="js/jquery-2.2.1.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--Fast Click [ OPTIONAL ]-->
    <script src="plugins/fast-click/fastclick.min.js"></script>


    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>


    <!--Switchery [ OPTIONAL ]-->
    <script src="plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="plugins/chosen/chosen.jquery.min.js"></script>


    <!--noUiSlider [ OPTIONAL ]-->


    <!--Demo script [ DEMONSTRATION ]-->
    <script src="js/demo/nifty-demo.min.js"></script>


    <!--Form Component [ SAMPLE ]-->
    <!--Background Image [ DEMONSTRATION ]-->
    <script src="js/demo/bg-images.js"></script>

    <script src="plugins/bootbox/bootbox.min.js"></script>
    <script src="js/demo/ui-alerts.js"></script>
    <script src="js/login/login.js"></script>



</body>
</html>
<?php
if($acceso == 1){
  echo "<script>
      $(document).ready(function(){
        bootbox.alert('Acceso Denegado!');
      });


        </script>";
}
?>
