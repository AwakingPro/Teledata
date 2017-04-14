<?PHP
require_once('../db/db.php'); 
include("../class/admin/conf_gestion.php");
include("../class/global/global.php");


if (!isset($_SESSION)) 
{
    session_start();
}

//Para Id de Menu Actual (Menu Padre, Menu hijo)
$_SESSION['idMenu'] = "adm,cpg";

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != ""))
{
    $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);
    $logoutGoTo = "../../index.php";
    if ($logoutGoTo) 
    {
        header("Location: $logoutGoTo");
        exit;
    }
}

if (!isset($_SESSION)) 
{
    session_start();
}
$validar = $_SESSION['MM_UserGroup'];
$MM_authorizedUsers = "1,4";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) 
{
    $isValid = False;
    if (!empty($UserName)) 
    {
        $arrUsers = Explode(",", $strUsers);
        $arrGroups = Explode(",", $strGroups);
        if (in_array($UserName, $arrUsers)) 
        {
            $isValid = true;
        }
    // Or, you may restrict access to only certain users based on their username.
        if (in_array($UserGroup, $arrGroups)) 
        {
            $isValid = true;
        }
        if (($strUsers == "") && false) 
        {
            $isValid = true;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = "../../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) 
{
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
    $MM_referrer .= "?" . $QUERY_STRING;
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo);
    exit;
}
$usuario = $_SESSION['MM_Username'];
$cedente = $_SESSION['cedente'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nifty.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/global/global.css" rel="stylesheet">
    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <style type="text/css">
    .select1 
             { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

             }   
    .select2 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            }  
    .text1 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

            }  
    .text2 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            } 
    .mostrar_condiciones
           {
           }  
    #midiv100
           {
            display: none;
           }

    #oculto
           {
            display: none;
           }  
    #guardar
           {
            display: none;
           }       
    #folder
           {
            display: none;
           } 
                    
    </style>    

  
</head>
<body>
    
    <div id="container" class="effect mainnav-sm">
        <?php include("eliminar_conf_modal.php");?>
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Logo-->
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Foco Estrategico </span>
                        </div>
                    </a>
                </div>
                <!--End Logo-->

                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="pli-view-list"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->

                        <!--Notification dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="pli-bell"></i>
                                <span class="badge badge-header badge-danger"></span>
                            </a>

                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md">
                                <div class="pad-all bord-btm">
                                    <p class="text-lg text-semibold mar-no">Tienes Nuevas Notificaciones</p>
                                </div>
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">
                                      
                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="#" class="btn-link text-dark box-block">
                                        <i class="fa fa-angle-right fa-lg pull-right"></i>Ver Todas las Notificaciones
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End notifications dropdown-->
                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--Language selector-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <?php  
                            $navBar = new Omni();
                            $navBar->navBar($cedente,$validar);
                        ?>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End language selector-->



                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <img class="img-circle img-user media-object" src="../img/av1.png" alt="Profile Picture">
                                </span>
                                <div class="username hidden-xs">Luis Ponce</div>
                            </a>


                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                                <!-- Dropdown heading  -->
                           


                                <!-- User dropdown menu -->
                                <ul class="head-list">
                                    <li>
                                        <a href="#">
                                            <i class="pli-male icon-lg icon-fw"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">9</span>
                                            <i class="pli-mail icon-lg icon-fw"></i> Mensajes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="pli-gear icon-lg icon-fw"></i> Configuración
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="pli-information icon-lg icon-fw"></i> Ayuda
                                        </a>
                                    </li>
                          
                                </ul>

                                <!-- Dropdown footer -->
                                <div class="pad-all text-right">
                                    <a href="../index.php" class="btn btn-primary">
                                        <i class="pli-unlock"></i> Salir
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End user dropdown-->

                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">

                    <!--Searchbox-->
            
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><a href="#">Administrador</a></li>
                    <li class="active">Conf. Pantalla Gestión</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->


        

                <!--Page content-->
                <!--===================================================-->


                <div id="page-content">

                    <div class="row">
                        <div class="eq-height">


                          <div class="col-sm-12 eq-box-sm"> 
                                <div id="contenedor"></div>

                                

                                <div class="mostrar_condiciones">
                                        <div class="panel" id='sql'>
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Estrategias Guardadas 
                                               
                                              </h3>
                                            </div>
                                            <div class="panel-body">
                                            <div class="mostrar">
                                            </div>

                                    <div class="col-sm-3">
                                        <div class="form-group"> 
                                         <button class="btn btn-primary btn-block" onclick="location.href='crear_conf_gestion.php'">Nueva Configuración</button>
                                        </div>


                <form>
                  Nombre Text:<br>
                  <input type="text" name="firstname"><br>
                  Tipo Numbre:<br>
                  <input type="number" name="lastname"><br>
                  Tipo Date<br>
                  <input type="date" name="lastname"><br>
                  Tipo Color<br>
                  <input type="color" name="lastname"><br>
                  Tipo Date picker<br>
                  <div id="demo-dp-component">
                    <div class="input-group date">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                    </div>
                    <small class="text-muted">Auto close on select</small>
                </div>
                <input type="text" class="form-control">
                <!--Bootstrap Datepicker : Text Input-->
                <!--===================================================-->
                <div id="demo-dp-txtinput">
                    <input type="text" class="form-control">
                </div>
                <!--===================================================-->
        <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Bootstrap Datepicker</h3>
        </div>
        <div class="panel-body">
            <p>Bootstrap-datepicker provides a flexible datepicker widget in the Twitter bootstrap style.</p><br>
            <p class="text-thin mar-btm">Text input</p>


            <!--Bootstrap Datepicker : Text Input-->
            <!--===================================================-->
            <div id="demo-dp-txtinput">
                <input type="text" class="form-control">
            </div>
            <!--===================================================-->

            <br>
            <hr>
            <br>

            <p class="text-thin mar-btm">Component</p>

            <!--Bootstrap Datepicker : Component-->
            <!--===================================================-->
            <div id="demo-dp-component">
                <div class="input-group date">
                    <input type="text" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                </div>
                <small class="text-muted">Auto close on select</small>
            </div>
            <!--===================================================-->



            <!--===================================================-->
            <div class="wrap">
                <label for="number">Formato para numero</label><br />
                <input type="text" id="price" name="number" />
                <button id="get_number">Get the Number</button>
            </div>
 
         
        <br>  
        <br>
        <p class="text-thin mar-btm">Multiple selects</p>

        <!-- Bootstrap Select with Multiple Selects -->
        <!--===================================================-->
        <select class="selectpicker" multiple title="Seleccione los items..." data-width="100%">
            <option>Family</option>
            <option>Friend</option>
            <option>Partner</option>
        </select>
        <!--===================================================-->
        <div class="form-group"> 
         <button type='button' class='btn btn-primary btn-block'  data-toggle='modal' data-target='#addDireccionModal' ">Para Modal</button>
        </div>

 <?php 
//include("../class/crm/crm.php");
//$crm = new crm();
//$crm->verCargo2();
?>   
<!--=========     Modal para Agregar Direccion    =====================-->
<br>
<div class="modal fade" id="addDireccionModal"  role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <br>
        <h2>Ingrese nuevo Correo</h2>
            <?php 
                include("../class/crm/crm.php");
                $crm = new crm();
                $crm->verCargo();
            ?> 
          <div class="modal-footer">
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="AddDireccion" class="btn btn-lg btn-primary">Aceptar</button>
          </div>

    </div>
  </div>
</div>
<!--===================================================-->

        </div>
    </div>
                </form> 

                                    </div>


                                        </div>
                                        </div>
                                       <div class="col-sm-3">
                                       
                                    </div>
                                    
                                </div>
                              
                                <!--===================================================-->
                                <!--End Panel with Header-->
                    
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
    <script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>
    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../plugins/numbers/jquery.number.min.js"></script>
    <script src="../plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
    <script src="../js/admin/admin-funciones.js"></script>
    <script src="../js/global/funciones-global.js"></script>

<?php 
//Para Mensaje de respuesta
$r1= $_GET["r1"];
$sw1 = "";
if ($r1 == "1")
{
    $tipom= "success";
    $mensaje= "La Configuración se ha creado de manera exitosa";
    $sw1= "1";
}elseif ($r1 == "2") {
    $tipom= "success";
    $mensaje= "La Configuración se ha Eliminado de manera exitosa";
    $sw1= "1";
}elseif ($r1 == "3") {
    $tipom= "error";
    $mensaje= "Error al tratar de eliminar la Configuración";
    $sw1= "1";
}

if ($sw1 == "1" )
{
    ?>
<script>
$(function() {
    $.niftyNoty(
        {
            type: '<?php echo $tipom ?>'  ,
            icon : 'fa fa-check',
            message : '<?php echo $mensaje ?>' ,
            container : 'floating',
            timer : 3000
        });
});
</script>
<?php } ?>

</body>
</html>
