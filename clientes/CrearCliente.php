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
    <link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">

    <style type="text/css">
       
#navbar .brand-title {
    padding: 0 1.5em 0 5px;
}

    </style>
</head>
<body>
<div id="container" class="effect mainnav-sm ">

    <?php
    include("../layout/header.php");
    ?>

    <div class="boxed">
        <div id="content-container">
            <div id="page-title">
            </div>
            <br>
            <ol class="breadcrumb">
                <li><a href="#">Módulo Clientes</a></li>
                <li class="active">Crear Cliente</li>
            </ol>
            <div id="page-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-base ">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a data-toggle="tab" href="#demo-lft-tab-1">Datos Facturación</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-2">Productos &nbsp;&nbsp;<i class="fa fa-plus-square " id="AgregaProducto" ></i></a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-3">Servicios &nbsp;&nbsp;</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#demo-lft-tab-4">Datos de Contacto &nbsp;&nbsp;</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text"  id="Nombre"  class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Rut</label>
                                                <input type="text"  id="Rut"  class="form-control" >
                                            </div>
                                        </div> 
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>DV</label>
                                                <select class="selectpicker" id="Dv"  data-live-search="true" data-width="100%">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="K">K</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección Comercial</label>
                                                <input type="text"  id="Direccion"  class="form-control" >
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;</label><br>
                                                <button  id="Crear">Guardar</button>
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                                <div id="demo-lft-tab-2" class="tab-pane fade">
                                    <div id="mostrar_gestion_ocultar">Agregue Producto</div>
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
<div class="modal fade" id="Agrega"  role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Ingrese Nuevo Correo</h4>
            </div>
            <div class="modal-body">
            <?php
            //include("../includes/crm/ver_cargo.php");
            ?>
            </div>
            <div class="modal-footer">
            <button type="button" id="AddCorreoN" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
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