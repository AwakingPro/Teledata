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
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../css/themes/type-a/theme-dark.min.css" rel="stylesheet">
        <link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../css/teledata.css" rel="stylesheet">
    </head>
    <body>
        <div id="IngresoForm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Ingreso <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeIngreso">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Razón Social / Proveedor - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalProveedor">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="form-control proveedor_id" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-nombre="Razon Social / Proveedor" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Factura</label>
                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number numero_factura" data-nombre="Numero de Factura">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha Emisión Factura</label>
                                        <input id="fecha_emision_factura" name="fecha_emision_factura" validation="not_null"  type="text" placeholder="Seleccione la fecha de emisión de la factura" class="form-control date fecha_emision_factura" data-nombre="Fecha Emisión Factura">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Estado de Pago</label>
                                        <div class="select">
                                            <select class="form-control estado_id" id="estado_id" name="estado_id" validation="not_null" data-live-search="true" data-nombre="Estado de Pago" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label label_numero_detalle" for="name">Detalle</label>
                                        <input id="numero_detalle" name="numero_detalle" placeholder="Ingrese el detalle" class="form-control input-sm number numero_detalle" data-nombre="Detalle">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12 detalle" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Pago</label>
                                        <input id="fecha_detalle" name="fecha_detalle" type="text" placeholder="Seleccione la fecha de pago" class="form-control date fecha_detalle" data-nombre="Fecha de Pago">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Centro de Costos - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalCosto">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="form-control centro_costo_id" id="centro_costo_id" name="centro_costo_id" validation="not_null" data-live-search="true" data-nombre="Centro de Costos" data-container="body">
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
                                        <h4 class="modal-title c-negro"><span id="span_ingreso">Actualizar</span> Ingreso <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" style="padding:20px">
                                            <form class="form-horizontal" id = "updateIngreso">
                                                <input type="hidden" id="id" name="id">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Numero de Factura</label>
                                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number numero_factura" data-nombre="Numero de Factura">
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Fecha Emisión Factura</label>
                                                        <input id="fecha_emision_factura" name="fecha_emision_factura" validation="not_null"  type="text" placeholder="Seleccione la fecha de emisión de la factura" class="form-control date fecha_emision_factura" data-nombre="Fecha Emisión Factura">
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Razón Social / Proveedor</label>
                                                        <div class="select">
                                                            <select class="form-control proveedor_id" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-nombre="Razon Social / Proveedor" data-container="body">
                                                                <option value="">Seleccione Opción</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Estado de Pago</label>
                                                        <div class="select">
                                                            <select class="form-control estado_id" id="estado_id" name="estado_id" validation="not_null" data-live-search="true" data-nombre="Estado de Pago" data-container="body">
                                                                <option value="">Seleccione Opción</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label label_numero_detalle" for="name">Numero de Cuenta</label>
                                                        <input id="numero_detalle" name="numero_detalle" placeholder="Ingrese el numero de cuenta" class="form-control input-sm number numero_detalle" data-nombre="Numero de Cuenta">
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12 detalle">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Fecha de Pago</label>
                                                        <input id="fecha_detalle" name="fecha_detalle" type="text" placeholder="Seleccione la fecha de pago" class="form-control date fecha_detalle" data-nombre="Fecha de Pago">
                                                    </div>
                                                </div>
                                                <div class="clearfix m-b-10"></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Centro de Costos</label>
                                                        <div class="select">
                                                            <select class="form-control centro_costo_id" id="centro_costo_id" name="centro_costo_id" validation="not_null" data-live-search="true" data-nombre="Centro de Costos" data-container="body">
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
                                        <div id="modalProveedor" class="modal fade" tabindex="-1" role="dialog" id="load">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                                                        <h4 class="modal-title c-negro">Agregar Proveedor <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" style="padding:20px">
                                                            <form class="form-horizontal" id = "storeProveedor">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Rut</label>
                                                                        <input id="rut" name="rut" type="text" placeholder="Ingrese su rut" class="form-control input-sm">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix m-b-10"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Nombre</label>
                                                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" validation="not_null" data-nombre="Nombre">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix m-b-10"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Dirección</label>
                                                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección" validation="not_null" data-nombre="Dirección"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix m-b-10"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Teléfono</label>
                                                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" validation="not_null" data-nombre="Télefono">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix m-b-10"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Contacto</label>
                                                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese su contacto" class="form-control input-sm" validation="not_null" data-nombre="Contacto">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix m-b-10"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Correo</label>
                                                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validation="not_null" data-nombre="Correo">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        </div><!-- /.modal-body -->
                                                        <div class="modal-footer p-b-20 m-b-20">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-purple" id="guardarProveedor" name="guardarProveedor">Guardar</button>
                                                            </div>
                                                        </div></form>
                                                        </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        <div id="modalCosto" class="modal fade" tabindex="-1" role="dialog" id="load">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                                                                        <h4 class="modal-title c-negro">Agregar Centro de Costo <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row" style="padding:20px">
                                                                            <form class="form-horizontal" id = "storeCosto">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" for="name">Nombre</label>
                                                                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" validation="not_null" data-nombre="Nombre">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix m-b-10"></div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" for="name">Dirección</label>
                                                                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección" validation="not_null" data-nombre="Dirección"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix m-b-10"></div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" for="name">Teléfono</label>
                                                                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" validation="not_null" data-nombre="Télefono">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix m-b-10"></div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" for="name">Responsable</label>
                                                                                        <div class="select">
                                                                                            <select class="form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Responsable">
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix m-b-10"></div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" for="name">Correo</label>
                                                                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validation="not_null" data-nombre="Correo">
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        </div><!-- /.modal-body -->
                                                                        <div class="modal-footer p-b-20 m-b-20">
                                                                            <div class="col-sm-12">
                                                                                <button type="button" class="btn btn-purple" id="guardarCosto" name="guardarCosto">Guardar</button>
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
                                                                                        <li><a href="#">Módulo Compras</a></li>
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
                                                                                                                            <th class="text-center">Numero de Factura</th>
                                                                                                                            <th class="text-center">Fecha Emisión Factura</th>
                                                                                                                            <th class="text-center">Razón Social / Proveedor</th>
                                                                                                                            <th class="text-center">Estado de pago</th>
                                                                                                                            <th class="text-center">Centro de costos</th>
                                                                                                                            <th class="text-center">Acciones</th>
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
                                                                        <script src="../js/demo/nifty.demo.js"></script>
                                                                        <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
                                                                        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
                                                                        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
                                                                        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
                                                                        <script src="../plugins/moment/moment.js"></script>
                                                                        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
                                                                        <script src="../js/global/validations.js"></script>
                                                                        <script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
                                                                        <script src="../plugins/numbers/jquery.number.min.js"></script>
                                                                        <script src="../js/compras/ingresos/Ingreso.js"></script>
                                                                    </body>
                                                                </html>