<?php require_once('../../class/methods_global/methods.php'); ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foco | Software de Estrategia</title>

        <!--STYLESHEET-->

        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/nifty.min.css" rel="stylesheet">
        <link href="../../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
        <link href="../../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="../../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
        <link href="../../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
        <link href="../../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../../plugins/animate-css/animate.min.css" rel="stylesheet">
        <link href="../../plugins/switchery/switchery.min.css" rel="stylesheet">
        <link href="../../plugins/morris-js/morris.min.css" rel="stylesheet">
        <link href="../../css/demo/nifty-demo.min.css" rel="stylesheet">
        <link href="../../plugins/pace/pace.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
        <link href="../../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">


        <style type="text/css">

            #navbar .brand-title {
                padding: 0 1.5em 0 5px;
            }

        </style>

    </head>
    <body>


        <div id="IngresoForm" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Ingreso <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeIngreso">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Compra</label>
                                        <input id="fecha_compra" name="fecha_compra" validation="not_null"  type="text" placeholder="Seleccione la fecha de compra" class="form-control date" data-nombre="Fecha de Compra">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Ingreso</label>
                                        <input id="fecha_ingreso" name="fecha_ingreso" validation="not_null" type="text" placeholder="Seleccione la fecha de ingreso" class="form-control date" data-nombre="Fecha de Ingreso">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Factura</label>
                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number" data-nombre="Numero de Factura">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Modelo</label>
                                        <div class="select">
                                            <select class="selectpicker modelo_producto_id" id="modelo_producto_id" name="modelo_producto_id" validation="not_null"  data-live-search="true" data-width="100%" data-nombre="Modelo">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Proveedor</label>
                                        <div class="select">
                                            <select class="selectpicker proveedor_id" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-width="100%" data-nombre="Proveedor">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Valor</label>
                                        <input id="valor" name="valor" validation="not_null" type="text" placeholder="Ingrese el valor" class="form-control input-sm" data-nombre="Valor">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Cantidad</label>
                                        <input id="cantidad" name="cantidad" validation="not_null" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm" data-nombre="Cantidad">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Bodega</label>
                                        <div class="select">
                                            <select class="selectpicker bodega_id" id="bodega_id" name="bodega_id" validation="not_null" data-live-search="true" data-width="100%" data-nombre="Bodega">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                          <button type="button" class="btn btn-purple" id="guardarIngreso" name="guardarIngreso">Guardar</button>
                        </div>
                    </div></form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="IngresoFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Actualizar Ingreso <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateIngreso">
                                <input type="hidden" id="id" name="id">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Compra</label>
                                        <input id="fecha_compra" name="fecha_compra" validation="not_null"  type="text" placeholder="Seleccione la fecha de compra" class="form-control date" data-nombre="Fecha de Compra">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Ingreso</label>
                                        <input id="fecha_ingreso" name="fecha_ingreso" validation="not_null" type="text" placeholder="Seleccione la fecha de ingreso" class="form-control date" data-nombre="Fecha de Ingreso">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Factura</label>
                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number" data-nombre="Numero de Factura">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Modelo</label>
                                        <div class="select">
                                            <select class="selectpicker modelo_producto_id" id="modelo_producto_id" name="modelo_producto_id" validation="not_null"  data-live-search="true" data-width="100%" data-nombre="Modelo">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Proveedor</label>
                                        <div class="select">
                                            <select class="selectpicker proveedor_id" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-width="100%" data-nombre="Proveedor">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Valor</label>
                                        <input id="valor" name="valor" validation="not_null" type="text" placeholder="Ingrese el valor" class="form-control input-sm" data-nombre="Valor">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Cantidad</label>
                                        <input id="cantidad" name="cantidad" validation="not_null" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm" data-nombre="Cantidad">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Bodega</label>
                                        <div class="select">
                                            <select class="selectpicker bodega_id" id="bodega_id" name="bodega_id" validation="not_null" data-live-search="true" data-width="100%" data-nombre="Bodega">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                          <button type="button" class="btn btn-purple" id="actualizarIngreso" name="actualizarIngreso">Actualizar</button>
                        </div>
                    </div></form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="container" class="effect mainnav-sm ">

            <?php
                include("../../layout/header.php");
            ?>

            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Módulo Inventario</a></li>
                        <li class="active">Ingresos</li>
                    </ol>
                    <div id="page-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-base ">
                                    <div class="tab-content">
                                        <div class="table-responsive">
                                            <div class="col-md-12">

                                                <button data-toggle="modal" href="#IngresoForm" class="btn btn-success">Agregar</button>

                                                <table id="IngresoTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Fecha de Compra</th>
                                                            <th class="text-center">Fecha de Ingreso</th>
                                                            <th class="text-center">Numero de Factura</th>
                                                            <th class="text-center">Modelo</th>
                                                            <th class="text-center">Proveedor</th>
                                                            <th class="text-center">Valor</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Bodega</th>
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
                <?php include("../../layout/footer.php"); ?>
        </div>

        <!--SCRIPT-->
        
        <script src="../../js/jquery-2.2.1.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../plugins/fast-click/fastclick.min.js"></script>
        <script src="../../js/nifty.min.js"></script>
        <script src="../../plugins/morris-js/morris.min.js"></script>
        <script src="../../plugins/morris-js/raphael-js/raphael.min.js"></script>
        <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="../../plugins/skycons/skycons.min.js"></script>
        <script src="../../plugins/switchery/switchery.min.js"></script>
        <script src="../../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../../js/demo/nifty-demo.min.js"></script>
        <script src="../../plugins/bootbox/bootbox.min.js"></script>
        <script src="../../js/demo/ui-alerts.js"></script>
        <script src="../../plugins/audiojs/audio.min.js"></script>                        
        <script src="../../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
        <script src="../../plugins/bootbox/bootbox.min.js"></script>
        <script src="../../plugins/moment/moment.js"></script>
        <script src="../../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../../plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="../../js/global/validations.js"></script>
        <script src="../../js/inventario/ingresos/Ingreso.js"></script>

    </body>
</html>