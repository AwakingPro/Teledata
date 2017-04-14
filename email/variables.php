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
    <title>Variables</title>


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
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">

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
    #nombre{
        display: inline-block;
        width: 80%;
        margin: 0 5px;
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
                    <h1 class="page-header text-overflow">Variables</h1>

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
                    <li class="active">Variables</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div id="message">
                        <div class="alert"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Crear Variable</h3>
                                </div>
                                <form class="panel-body form-horizontal form-padding">            
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Nombre</label>
                                        <div class="col-md-4">
                                            <p>[<input type="text" class="form-control" name="nombre" id="nombre" value="">]</p>
                                        </div>
                                    </div>                               
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Tipo</label>
                                        <div class="col-md-3">                                     
                                            <select class="selectpicker" id="tipo" name="tipo">
                                                <option value="">Seleccione</option>
                                                <option value="valor">Valor</option>
                                                <option value="tabla">Tabla</option>
                                                <option value="operacion">Operación</option>
                                            </select>
                                        </div>
                                    </div>                               
                                    <div class="form-group" id="operacion-wrapper" style="display:none;">
                                        <label class="col-md-1 control-label">Operación</label>
                                        <div class="col-md-5">                                     
                                            <select class="selectpicker" id="operacion" name="operacion">
                                                <option value="">Seleccione</option>
                                                <option value="SUM">SUMA</option>
                                                <option value="AVG">PROMEDIO</option>
                                                <option value="COUNT">CONTAR</option>
                                                <option value="MIN">VALOR MINIMO</option>
                                                <option value="MAX">VALOR MÁXIMO</option>
                                            </select>
                                        </div>
                                    </div>                           
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Tabla</label>
                                        <div class="col-md-5">                                     
                                            <select class="selectpicker" id="tabla" name="tabla">
                                                <option value="Persona">Persona</option>
                                                <option value="Deuda">Deuda</option>
                                            </select>
                                        </div>
                                    </div>                           
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Campos</label>
                                        <div class="col-md-3" id="campos-persona">
                                            <select class="selectpicker" name="campos">
                                                <?php $campos = new opciones;
                                                    echo $campos->campos('Persona',$con);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3" id="campos-deuda" style="display: none;">              
                                            <select class="selectpicker" name="campos">
                                                <?php $campos = new opciones;
                                                    echo $campos->campos('Deuda',$con);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button id="agregar" class="btn btn-primary" type="button" style="display: none;">Agregar</button>
                                            <input type="hidden" id="fields">
                                            <input type="hidden" id="current-var">

                                        </div>
                                    </div>                           
                                    <div class="form-group" id="previsualizar" style="display: none;">
                                        <label class="col-md-1 control-label">Previsualizar</label>
                                        <div class="col-md-9">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>    
                                </form>
                                <div class="panel-footer text-right">
                                    <button id="clean" class="btn btn-primary" type="button">Limpiar</button>
                                    <button id="guardar-variable" class=" btn btn-primary" type="button">Guardar</button>
                                    <button id="actualizar-variable" class=" btn btn-primary" type="button" style="display: none;">Actualizar</button>
                                </div>    
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Editar Variables</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="templates">
                                            <?php $templates = new opciones;
                                                echo $templates->variables($con); ?>
                                        </tbody>
                                    </table>
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
    <!--jQuery [ REQUIRED ]-->
    <script src="../js/jquery-2.2.1.min.js"></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="../js/bootstrap.min.js"></script>
    <!--Fast Click [ OPTIONAL ]-->
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="../js/nifty.min.js"></script>
<!--Switchery [ OPTIONAL ]-->
    <script src="../plugins/switchery/switchery.min.js"></script>
<!--Bootstrap Select [ OPTIONAL ]-->
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
<!--Demo script [ DEMONSTRATION ]-->
    <script src="../js/demo/nifty-demo.min.js"></script>
<!--SUMMERNOTE INITIATION-->
    <script src="../js/email/variables.js"></script>
    <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../js/global/funciones-global.js"></script>
    
</body>
</html>
