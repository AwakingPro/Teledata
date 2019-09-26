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
        <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
        <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
        <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
        <link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="../css/teledata.css" rel="stylesheet">
        <link href="../css/loader.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include '../componentes/componentes_documentos/modalDetalle.php';
        ?>
        <div id="modalOC" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar orden de compra y HES(Hoja entrada de servicio)<button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeOC">
                                <input type="hidden" name="rutidOC" id="rutidOC">
                                <input type="hidden" name="grupoOC" id="grupoOC">
                                <input type="hidden" name="tipoOC" id="tipoOC">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="NumeroOC">Numero de OC</label>
                                        <input id="NumeroOC" name="NumeroOC" type="text" placeholder="Ingrese el numero de la OC" class="form-control input-sm" validate="not_null" data-nombre="Numero de OC">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="FechaOC">Fecha emisión OC</label>
                                        <input id="FechaOC" name="FechaOC" type="text" placeholder="Ingrese la fecha de la OC" class="form-control input-sm date" validate="not_null" data-nombre="Fecha emisión OC">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="NumeroHES">Número de HES</label>
                                        <input id="NumeroHES" name="NumeroHES" type="text" placeholder="Ingrese el número de la HES" class="form-control input-sm" data-nombre="Numero de HES">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="FechaHES">Fecha emisión HES</label>
                                        <input id="FechaHES" name="FechaHES" type="text" placeholder="Ingrese la fecha de la HES" class="form-control input-sm date" data-nombre="Fecha emisión HES">
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarOC" name="guardarOC">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="modalReferencia" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Referencia <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeReferencia">
                                <input type="hidden" name="rutidReferencia" id="rutidReferencia">
                                <input type="hidden" name="grupoReferencia" id="grupoReferencia">
                                <input type="hidden" name="tipoReferencia" id="tipoReferencia">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Referencia</label>
                                        <input id="Referencia" name="Referencia" type="text" placeholder="Ingrese la Referencia" class="form-control input-sm">
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarReferencia" name="guardarReferencia">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="container" class="effect aside-float aside-bright mainnav-sm">
            <div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>
                        <li class="active">Emisión de Documentos</li>
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
                            <h3 class="panel-title">Documentos por emitir</h3>
                        </div>
                        <!--Panel body-->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="lotes" class="tab-pane fade active in">
                                    <div class="col-md-6" style="margin-bottom:10px">
                                        <div class="col-sm-6">
                                            <select class="selectpicker form-control" id="TipoLote" data-container="body">
                                                <option value="">Todos</option>
                                                <option value="Boleta">Boleta</option>
                                                <option value="Factura">Factura</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom:10px">
                                        <button id="Facturar" class="btn btn-success pull-right" style="opacity: 0.2;" disabled>Facturar</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <div class="col-md-12">
                                            <table id="LoteTable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"><input class="select-checkbox" name="select_all" id="select_all" type="checkbox"></th>
                                                        <th class="text-center">Tipo</th>
                                                        <th class="text-center">Cliente</th>
                                                        <th class="text-center">RUT</th>
                                                        <th class="text-center">Grupo Factura</th>
                                                        <th class="text-center">Neto</th>
                                                        <th class="text-center">I.V.A 19%</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="LoteTableLoader">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:20px">
                                        <div class="pull-right">
                                            <b><span style="font-size:14px">Total Facturas: <span id="totalFacturasLote">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Facturas: <span id="cantidadFacturasLote">0</span></span></b><br>
                                            <b><span style="font-size:14px">Total Boletas: <span id="totalBoletasLote">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Boletas: <span id="cantidadBoletasLote">0</span></span></b><br>
                                        </div>
                                    </div>
                                </div>
                                <div id="individual" class="tab-pane fade">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-md-12" style="margin-bottom:10px">
                                            <div class="col-sm-3">
                                                <select class="selectpicker form-control" id="TipoIndividual" data-container="body">
                                                    <option value="">Todos</option>
                                                    <option value="Boleta">Boleta</option>
                                                    <option value="Factura">Factura</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="IndividualTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Tipo</th>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Rut</th>
                                                            <th class="text-center">Grupo Factura</th>
                                                            <th class="text-center">Neto</th>
                                                            <th class="text-center">I.V.A 19%</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="IndividualTableLoader">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:20px">
                                        <div class="pull-right">
                                            <b><span style="font-size:14px">Total Facturas: <span id="totalFacturasIndividual">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Facturas: <span id="cantidadFacturasIndividual">0</span></span></b><br>
                                            <b><span style="font-size:14px">Total Boletas: <span id="totalBoletasIndividual">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Boletas: <span id="cantidadBoletasIndividual">0</span></span></b><br>
                                        </div>
                                    </div>
                                </div>
                                <div id="instalacion" class="tab-pane fade">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-md-12" style="margin-bottom:10px">
                                            <div class="col-sm-3">
                                                <select class="selectpicker form-control" id="TipoInstalacion" data-container="body">
                                                    <option value="">Todos</option>
                                                    <option value="Boleta">Boleta</option>
                                                    <option value="Factura">Factura</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="InstalacionTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Tipo</th>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Rut</th>
                                                            <th class="text-center">Grupo Factura</th>
                                                            <th class="text-center">Neto</th>
                                                            <th class="text-center">I.V.A 19%</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="InstalacionTableLoader">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:20px">
                                        <div class="pull-right">
                                            <b><span style="font-size:14px">Total Facturas: <span id="totalFacturasInstalacion">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Facturas: <span id="cantidadFacturasInstalacion">0</span></span></b><br>
                                            <b><span style="font-size:14px">Total Boletas: <span id="totalBoletasInstalacion">0</span></span></b><br>
                                            <b><span style="font-size:14px">Cantidad Boletas: <span id="cantidadBoletasInstalacion">0</span></span></b><br>
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
<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
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
<script src="../js/methods_global/methods.js"></script>
<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
<script src="../plugins/numbers/jquery.number.min.js"></script>
<script src="../js/facturacion/Facturacion.js"></script>
</body>
</html>