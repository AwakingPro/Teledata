<?php include('../db/connect.php');
include('../class/email/opciones.php'); 
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1,2',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "est,egu"));
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
$nombreUsuario = $_SESSION['nombreUsuario']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controles de envío</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="../css/nifty.min.css" rel="stylesheet">
    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <!--Summernote [ OPTIONAL ]-->
    <link href="../plugins/summernote/summernote.min.css" rel="stylesheet">

    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">

    <!--Custom CSS-->
    <style>
    #message{
        position: fixed;
        top:5px;
        left:50%;
        width:90%;
        z-index:99;
        max-width: 600px;
        transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
    }
    </style>
    <!--=================================================-->


</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-sm">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php include('../layout/header.php'); ?>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Controles de envío</h1>

                    <!--Searchbox-->
                    <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Email</a></li>
					<li class="active">Configuración</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div id="message">
                        <div class="alert"></div>
                    </div>
					<?php $config = new opciones; 
                    $opciones = $config->configvalues($con);?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Configurar Servidor de Correo</h3>
                                </div>
                                <form class="panel-body form-horizontal form-padding"> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Protocolo</label>
                                        <div class="col-md-9 pad-no">    
                                            <div class="radio">
                                                <label class="form-radio form-icon active"><input type="radio" <?php echo $opciones[0];?> value="1" name="protocol"> SMTP</label>
                                                <label class="form-radio form-icon"><input type="radio" <?php echo $opciones[1];?> value="2" name="protocol"> POP3</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SMTPSecure</label>
                                        <div class="col-md-9 pad-no">   
                                            <div class="radio">
                                                <label class="form-radio form-icon active"><input type="radio" <?php echo $opciones[2];?> value="1" name="secure"> SSL</label>
                                                <label class="form-radio form-icon"><input type="radio" value="2" <?php echo $opciones[3];?> name="secure"> TLS</label>
                                            </div> 
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Host</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="host" id="host" value="<?php echo $opciones[4];?>">
                                        </div>
                                    </div>                               
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Puerto</label>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="port" id="port" value="<?php echo $opciones[5];?>">
                                        </div>
                                    </div>
                                </form>
                                <div class="panel-footer text-right">
                                    <button class="save-conf btn btn-primary" type="button">Guardar</button>
                                </div>   
                            </div>
					    </div>
                        <div class="col-lg-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Cuenta de Envío y Recepción</h3>
                                </div>
                                <form class="panel-body form-horizontal"> 
                                    <!--Email Input-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-email-input">Email de envío</label>
                                        <div class="col-md-7">
                                            <input type="email" class="form-control" name="email" id="email"  value="<?php echo $opciones[6];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-password-input">Contraseña</label>
                                        <div class="col-md-7">
                                            <input type="password" class="form-control" name="pass" id="pass"  value="<?php echo $opciones[7];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-readonly-input">From</label>
                                        <div class="col-md-7">
                                            <input type="email" class="form-control" id="from"  value="<?php echo $opciones[8];?>">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="demo-readonly-input">From Name</label>
                                        <div class="col-md-7">
                                            <input type="Text" class="form-control" id="fromname" value="<?php echo $opciones[9];?>">
                                        </div>
                                    </div>         
                                </form>
                                <div class="panel-footer text-right">
                                    <button class="save-conf btn btn-primary" type="button">Guardar</button>
                                </div>   
                            </div>
                        </div>
					</div>					
					
                </div>
                <!--End page content-->
            </div>
            <!--END CONTENT CONTAINER-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <?php include('../layout/main-menu.php'); ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pull-right">
                You have <a href="#" class="text-bold text-main"><span class="label label-danger">3</span> pending action.</a>
            </div>



            <!-- Visible when footer positions are static -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="hide-fixed pull-right pad-rgt">
                14GB of <strong>512GB</strong> Free.
            </div>



            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <p class="pad-lft">&#0169; 2016 Your Company</p>



        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    
    <!--JAVASCRIPT-->
    <!--=================================================-->
    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <!--jQuery [ REQUIRED ]-->
    <script src="../js/jquery-2.2.4.min.js"></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="../js/bootstrap.min.js"></script>
    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="../js/nifty.min.js"></script>
    <!--Summernote [ OPTIONAL ]-->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!--Summernote [ OPTIONAL ]-->
    <script src="../js/email/summernote-ini.js"></script>
    <!--Switchery [ OPTIONAL ]-->
    <script src="../plugins/switchery/switchery.min.js"></script>

    <script src="../js/email/email.js"></script>
    
</body>
</html>
