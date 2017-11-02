<?php require_once('../class/methods_global/methods.php'); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teledata</title>
        <!--STYLESHEET-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/nifty.min.css" rel="stylesheet">
        <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
        <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
        <link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../css/teledata.css" rel="stylesheet">
    </head>
    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-sm">
            <div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>
                        <li class="active">Facturación</li>
                    </ol>
                    <div id="page-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <!--Panel heading-->
                                    <div class="panel-heading">
                                        <div class="panel-control">
                                            <!--Nav tabs-->
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#lotes" aria-expanded="true">Facturación por Lotes</a>
                                            </li>
                                            <li><a data-toggle="tab" href="#individual" aria-expanded="true">Facturación Individual</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#instalacion" aria-expanded="true">Facturación Instalación</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="panel-title">Modulo Facturación</h3>
                        </div>
                        <!--Panel body-->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="lotes" class="tab-pane fade active in">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="LoteTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Rut</th>
                                                            <th class="text-center">Grupo Factura</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="individual" class="tab-pane fade">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="IndividualTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Rut</th>
                                                            <th class="text-center">Grupo Factura</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="instalacion" class="tab-pane fade">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="InstalacionTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Estatus</th>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Rut</th>
                                                            <th class="text-center">Grupo Factura</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
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
    </div>
    <nav id='mainnav-container'>
        <div id='mainnav'>
            <div id='mainnav-shortcut'>
                <ul class='list-unstyled'>
                    <li class='col-xs-4' data-content='Page Alerts'></li>
                </ul>
            </div>
            <div id='mainnav-menu-wrap'>
                <div class='nano'>
                    <div class='nano-content'>
                        <ul id='mainnav-menu' class='list-group'>
                            <?php include('../ajax/menu/mainMenu.php') ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<?php include("../layout/footer.php"); ?>
</div>
<!--SCRIPT-->
<script src="../js/jquery-2.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../plugins/sweetalert/sweetalert.min.js"></script>
<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../plugins/moment/moment.js"></script>
<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../js/global/validations.js"></script>
<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
<script src="../plugins/numbers/jquery.number.min.js"></script>
<script src="../js/facturacion/facturas/Facturacion.js"></script>
</body>
</html>