<?php
require_once('../db/db.php');
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1,2,3,4,5,6',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "inicio,bien"));
// ** Logout the current user. **
$objetoSession->creaLogoutAction();
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    $objetoSession->logoutGoTo("../index.php");
}
$validar = $_SESSION['MM_UserGroup'];
$objetoSession->creaMM_restrictGoTo();
$usuario = $_SESSION['MM_Username'];
if (isset($_SESSION['cedente'])){
    $cedente = $_SESSION['cedente'];
}
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
    <link href="../css/themes/type-a/theme-mint.min.css" rel="stylesheet">

    <style type="text/css">
        #navbar .brand-title {
            padding: 0 1.5em 0 5px;
        }
        .select1{
            width: 100%;
            height: 30px;
            border: solid;
            border-color: #ccc;
            border-width: thin;
            background-color: #FFF;
        }
    </style>
</head>
<body>
<div id="container" class="effect mainnav-sm ">

    <?php
    include("../layout/header.php");
    ?>
    <input type="hidden" id="Rut" value="">
    <input type="hidden" id="bg" value="0">
    <div class="boxed">
        <div id="content-container">
            <div id="page-title">
            </div>
            <br>
            <ol class="breadcrumb">
                <li><a href="#">Módulo Clientes</a></li>
                <li class="active">Ver Clientes</li>
            </ol>
            <div id="page-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body ">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tipo de Búsqueda</label>
                                        <select class="selectpicker" id="TipoBusqueda"  data-live-search="true" data-width="100%">
                                            <option value="0">Seleccione</option>
                                            <option value="1">Por Razón Social</option>
                                            <option value="2">Por Rut</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>&nbsp;&nbsp;</label><br>
                                        <div id="Tipo">
                                            <input type="text"  disabled="disabled"  class="form-control" >
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-base ">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a data-toggle="tab" href="#demo-lft-tab-1">Datos Facturación</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-2">Servicios Contratados &nbsp;&nbsp;<i class="fa fa-plus-square " id="AgregaProducto" ></i></a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-3">Productos Contratados &nbsp;&nbsp;</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-4">Datos de Contacto &nbsp;&nbsp;</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                    <div class="row">
                                        <div id="VerClientes">Seleccione Cliente</div>
                                        
                                       
                                    </div>
                                </div>
                                <div id="demo-lft-tab-2" class="tab-pane fade">
                                    <div id="DivServicios">Agregue Servicios</div>
                                    <div id="DatosTecnicos"></div>
                                </div>
                                <div id="demo-lft-tab-3" class="tab-pane fade">
                                    <div id="mostrar_pagos_ocultar">Agregue Servicio</div>
                                </div>
                                <div id="demo-lft-tab-4" class="tab-pane fade">
                                    <div id="mostrar_gestion_total_ocultar">Datos Técnicos</div>
                                </div>
                          
                            </div>
                        </div>  
                    </div>
                </div>   
            </div>        
        </div>
        <?php include("../layout/main-menu.php"); ?>
    </div>
        <?php include("../layout/footer.php"); ?>
</div>

<script src="../js/jquery-2.2.1.min.js"></script>
<script src="../js/clientes/crear.js"></script>
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
<script src="../js/global/funciones-global.js"></script>
<script src="../js/demo/ui-modals.js"></script>
</body>
</html>