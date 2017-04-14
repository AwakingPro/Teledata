<?PHP
//$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
//mysql_select_db("foco",$conexion);

require_once('../db/db.php');
if (!isset($_SESSION))
{
    session_start();
}

//Para Id de Menu Actual (Menu Padre, Menu hijo)
$_SESSION['idMenu'] = "tar,pdt";

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
$MM_authorizedUsers = "1,2";
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
$sql="select * from SIS_Tablas order by id asc";
$res=mysql_query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nifty.min.css" rel="stylesheet">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
    <link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="../plugins/noUiSlider/nouislider.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="../plugins/summernote/summernote.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <!--SCRIPT-->
    <!--=================================================-->
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <style type="text/css">
    #mostrar_estrategia
             {
        display: none;
             }
    #mostrar_cola
             {
        display: none;
             }
    #mostrar_gestor
             {
        display: none;
             }
    #mostrar_asignacion
             {
        display: none;
             }
    #acciones_seleccionadas
             {
        display: none;
             }
	 #acciones_seleccionadas2
             {
        display: none;
             }
      .select1
             {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #FFFFFF;
    	border-width: 1px;

             }
    .select2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
		border-width: 1px;
        background-color: #CCC;

            }
    .text1
            {
        width: 100%;
        height: 30px;
        border: solid;
        background-color: #FFFFFF;
    	border-width: 1px;
		border-color: #ccc;

            }
    .text2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
		border-width: 1px;
        background-color: #CCC;

            }
        .asignacion
             {
        width: 100%;
        height: 30px;
        border: none;
        border-top-width: thin;
        border-right-width: thin;
        border-bottom-width: thin;
        border-left-width: thin;
        text-align: center;

             }
             .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('../img/gears.gif')
            50% 50%
            no-repeat;
            }
body.loading
           {
            overflow: hidden;
           }
body.loading .modal
          {
           display: block;
          }
    </style>
</head>
<body>

    <div id="container" class="effect mainnav-sm">

        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Logo-->
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Foco Estrategico</span>
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
                        <li class="dropdown ">

                            <a id="demo-lang-switch" class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">
                            <?php
                            $cambiar_cedente = mysql_query("SELECT Nombre_Cedente FROM Cedente WHERE Id_Cedente = $cedente LIMIT 1");
                            while($row=mysql_fetch_array($cambiar_cedente))
                            {
                                echo $cedente_active = "<span class='text-warning'><b>".$row[0]."</b></span>";
                            }
                            ?>
                            </a>


                            <!--Language selector menu-->
                            <?php
                            if($validar == "4")
                            {
                            }
                            else
                            {
                            ?>
                            <ul class="head-list dropdown-menu">

                                <li>

                                    <?php

                                            $cambiar_cedente2 = mysql_query("SELECT Nombre_Cedente,Id_Cedente FROM Cedente WHERE NOT Id_Cedente = $cedente ORDER BY Nombre_Cedente ASC ");
                                            while($row=mysql_fetch_array($cambiar_cedente2))
                                            {
                                                echo $cedente_otros = "<a href='sesion_cedente_cambiar.php?cedente=".$row[1]."&url=1'>".$row[0]."</a>";
                                            }

                                    ?>

                                </li>


                            </ul>
                            <?php } ?>
                        </li>
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
                    <li><a href="#">Tareas</a></li>
                    <li class="active">Panel de Tareas</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
					<div class="row">
                        <div class="eq-height">
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" id='padre'>
                                    <div class="panel-heading">
                                    	<h2 class="panel-title"> <i class="fa fa-tasks"></i>  Seleccione Tipo de Estrategia

                                </h2>
                                    </div>
                                    <div class="panel-body">
                                    	<div id="cambiar">
                                       	<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                               <thead>
                                               <tr>
                                               	<th>ID Estrategia</th>
                                                   <th>Tipo de Estrategia</th>
                                                   <th><center>Seleccione</center></th>
                                               </tr>
                                               </thead>
                                                <tbody>
                                              <?php
                                              $i = 1;
                                              $sql_estrategia = mysql_query("SELECT id,nombre FROM SIS_Tipo_Estrategia");
                                                while($row=mysql_fetch_array($sql_estrategia)){ ?>
                                               <tr id='<?php echo $i; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1]; ?><input type="hidden" name="id_cedente" id="id_cedente" value="<?php echo $cedente; ?>"></td>
                                               <td>
                                               	<center>
                                               		<input type='checkbox' id="uno<?php echo $i; ?>" class="seleccione_tipo"/>
                                               	</center></td></td>
                                               </tr>
                                               <?php
                                                 $i++;
                                                }
                                              ?>
                                              </tbody>
                                             </table>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
					</div>

                    <div id="mostrar_estrategia">
                        <div class="row">
                            <div class="eq-height">
                                <div class="col-sm-12 eq-box-sm">
                                    <div class="panel" id='padre'>
                                        <div class="panel-heading">
                                         <h2 class="panel-title"> Seleccione Estrategia</h2>
                                        </div>
                                            <div class="panel-body">
                                                <div id="cambiar2">

                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>

                    <div id="mostrar_cola">
                        <div class="row">
                            <div class="eq-height">
                                <div class="col-sm-12 eq-box-sm">
                                    <div class="panel" id='padre'>
                                        <div class="panel-heading">
                                        <h2 class="panel-title"> Seleccione Cola Terminal</h2>
                                        </div>
                                            <div class="panel-body">
                                                <div id="cambiar3">

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
        <div class="modal"><!-- Place at bottom of page --></div>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
    <script src="../js/jquery-2.2.1.min.js"></script>
    <script src="../js/tareas/tareas.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-es.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <script src="../js/nifty.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>

</body>
</html>
