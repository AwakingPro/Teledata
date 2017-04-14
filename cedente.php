<?PHP
require_once('db/db.php');
require_once('class/session/session.php');
$objetoSession = new Session('1,2,3,4,5,6',false);
// ** Logout the current user. **
$objetoSession->creaLogoutAction();
if ((isset($_GET['doLogout'])) && ($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    $objetoSession->logoutGoTo("index.php");
}
$objetoSession->creaMM_restrictGoTo();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco</title>


    <!--STYLESHEET-->
    <!--=================================================-->



    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="css/nifty.min.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMO ]-->
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--Font Awesome [ OPTIONAL ]-->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <!--Switchery [ OPTIONAL ]-->
    <link href="plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="plugins/chosen/chosen.min.css" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    <link href="plugins/noUiSlider/nouislider.min.css" rel="stylesheet">


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">


    <!--Dropzone [ OPTIONAL ]-->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">


    <!--Summernote [ OPTIONAL ]-->
    <link href="plugins/summernote/summernote.min.css" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">




    <!--SCRIPT-->
    <!--=================================================-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="plugins/pace/pace.min.css" rel="stylesheet">
    <script src="plugins/pace/pace.min.js"></script>



    <!--

    REQUIRED
    You must include this in your project.

    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.

    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.

    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.

    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    -->

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

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
					<span class="brand-title">  Foco | Software de Estrategia de Cobranza<span class="text-thin"></span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->


		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<p class="pad-btm">Seleccione Cedente</p>
					<form action="estrategia/sesion_cedente.php" method="POST">
						<div class="form-group">
							<div class="input-group">
                                <?php
                                    function GetMandante_Cedente(){
                                        $mandante = mysql_query("SELECT * FROM mandante WHERE id = '".$_SESSION['mandante']."' LIMIT 1");
                                        while($row = mysql_fetch_assoc($mandante)){
                                            $_SESSION['mandante_cedentes'] = $row["Id_Cedente"];
                                        }
                                    }
                                    if(isset($_SESSION["mandante"]) && $_SESSION['mandante'] != ""){
                                        GetMandante_Cedente();
                                    }
                                ?>
                                <select name="cedente" class="selectpicker">
								<?php
                                $sql = mysql_query("SELECT Id_Cedente , Nombre_Cedente FROM Cedente where Id_Cedente in(".$_SESSION['mandante_cedentes'].") ORDER BY Nombre_Cedente ASC");
                                while($row=mysql_fetch_array($sql))
                                {
                                ?>
								<option value = "<?php echo $row[0];?>"><?php echo $row[1];?></option>
								<?php } ?>
								</select>
							</div>
						</div>


						<button class="btn btn-primary btn-md btn-block" type="submit" >
							Seleccionar
						</button>
					</form>
				</div>
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



</body>
</html>
