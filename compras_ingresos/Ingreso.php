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
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../css/teledata.css" rel="stylesheet">
        <style type="text/css">
            
        </style>
    </head>
    
    <body>
    
        <div id="IngresoForm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Factura de Proveedor <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeIngreso">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Razón Social / Proveedor - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalProveedor">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="form-control proveedor_id" id="proveedor_id" name="proveedor_id" validate="not_null"  data-live-search="true" data-nombre="Razon Social / Proveedor" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Tipo de documento</label>
                                        <div class="select">
                                            <select class="form-control tipo_documento_id" id="tipo_documento_id" name="tipo_documento_id" validate="not_null" data-live-search="true" data-nombre="Estado de Pago" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">N* de Documento</label>
                                        <input id="numero_documento" name="numero_documento" validate="not_null" placeholder="Ingrese el numero de documento" class="form-control input-sm number numero_documento" data-nombre="N* de Documento">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha Emisión</label>
                                        <input id="fecha_emision" name="fecha_emision" validate="not_null"  type="text" placeholder="Seleccione la fecha de emisión" class="form-control date fecha_emision" data-nombre="Fecha de Emisión">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha Vencimiento</label>
                                        <input id="fecha_vencimiento" name="fecha_vencimiento" validate="not_null"  type="text" placeholder="Seleccione la fecha de vencimiento" class="form-control date fecha_vencimiento" data-nombre="Fecha de Vencimiento">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Detalle</label>
                                        <input id="detalle" name="detalle" placeholder="Ingrese el detalle" class="form-control input-sm detalle" data-nombre="Detalle">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Monto</label>
                                        <input id="total_documento" name="total_documento" validate="not_null" placeholder="Ingrese el monto" class="form-control input-sm money total_documento" data-nombre="Monto">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Cuentas Contables - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalCosto">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select data-size="5" class="form-control  centro_costo_id" id="centro_costo_id" name="centro_costo_id" validate="not_null" data-live-search="true" data-nombre="Centro de Costos" data-container="body">
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
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="IngresoFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro"><span id="span_ingreso">Actualizar</span> Factura de Proveedor <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateIngreso">
                                <input type="hidden" id="id" name="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Razón Social / Proveedor - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalProveedor">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="form-control proveedor_id" id="proveedor_id" name="proveedor_id" validate="not_null"  data-live-search="true" data-nombre="Razon Social / Proveedor" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Tipo de documento</label>
                                        <div class="select">
                                            <select class="form-control tipo_documento_id" id="tipo_documento_id" name="tipo_documento_id" validate="not_null" data-live-search="true" data-nombre="Estado de Pago" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">N* de Documento</label>
                                        <input id="numero_documento" name="numero_documento" validate="not_null" placeholder="Ingrese el numero de documento" class="form-control input-sm number numero_documento" data-nombre="N* de Documento">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha Emisión</label>
                                        <input id="fecha_emision" name="fecha_emision" validate="not_null"  type="text" placeholder="Seleccione la fecha de emisión" class="form-control date fecha_emision" data-nombre="Fecha de Emisión">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha Vencimiento</label>
                                        <input id="fecha_vencimiento" name="fecha_vencimiento" validate="not_null"  type="text" placeholder="Seleccione la fecha de vencimiento" class="form-control date fecha_vencimiento" data-nombre="Fecha de Vencimiento">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Detalle</label>
                                        <input id="detalle" name="detalle" placeholder="Ingrese el detalle" class="form-control input-sm detalle" data-nombre="Detalle">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Monto</label>
                                        <input id="total_documento" name="total_documento" validate="not_null" placeholder="Ingrese el monto" class="form-control input-sm money total_documento" data-nombre="Monto">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Centro de Costos - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalCosto">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="form-control centro_costo_id" id="centro_costo_id" name="centro_costo_id" validate="not_null" data-live-search="true" data-nombre="Centro de Costos" data-container="body">
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
                    </div>
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
                                        <label class="control-label" for="name">Rut sin el DV</label>
                                        <input id="rut" name="rut" type="text" placeholder="Ingrese rut del proveedor" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese nombre del proveedor" class="form-control input-sm" validate="not_null" data-nombre="Nombre">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección" validate="not_null" data-nombre="Dirección"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Teléfono</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" validate="not_null" data-nombre="Télefono">
                                    </div>
                                </div> -->
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Contacto</label>
                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese nombre de contacto" class="form-control input-sm" validate="not_null" data-nombre="Contacto">
                                    </div>
                                </div>
                                <!-- <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validate="not_null" data-nombre="Correo">
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarProveedor" name="guardarProveedor">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="modalCosto" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Cuentas Contables <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeCosto">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Código Cuenta</label>
                                        <input id="codigo_cuenta" name="codigo_cuenta" type="text" placeholder="Ingrese el Código de la Cuenta" class="form-control input-sm" validate="not_null" data-nombre="Código Cuenta">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese Nombre de la cuenta" class="form-control input-sm" validate="not_null" data-nombre="Nombre">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"  data-nombre="Dirección"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Teléfono</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" data-nombre="Télefono">
                                    </div>
                                </div> -->
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Responsable</label>
                                        <div class="select">
                                            <select class="form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Responsable">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" data-nombre="Correo">
                                    </div>
                                </div> -->
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
        <div id="modalIngreso" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Pago <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storePago">
                                <input type="hidden" id="CompraId" name="CompraId">
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Pago</label>
                                        <input id="FechaPago" name="FechaPago" validate="not_null"  type="text" placeholder="Seleccione la fecha de pago" class="form-control date FechaPago" data-nombre="Fecha de Pago">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Monto</label>
                                        <input id="Monto" name="Monto" validate="not_null" placeholder="Ingrese el monto" class="form-control input-sm money Monto" data-nombre="Monto">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Tipo de Pago</label>
                                        <div class="select">
                                            <select class="form-control TipoPago" id="TipoPago" name="TipoPago" validate="not_null" data-live-search="true" data-nombre="Tipo de Pago" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label label_Detalle" for="name">Observacion</label>
                                        <input id="Detalle" name="Detalle" placeholder="Ingrese la observación" class="form-control input-sm Detalle" data-nombre="Observación">
                                    </div>
                                </div>
                                <div class="Cheque" style="display:none">
                                    <div class="clearfix m-b-10"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Fecha de emision de Cheque</label>
                                            <input id="FechaEmisionCheque" name="FechaEmisionCheque" type="text" placeholder="Seleccione la fecha de emision del cheque" class="form-control date FechaEmisionCheque" data-nombre="Fecha de Emision">
                                        </div>
                                    </div>
                                    <div class="clearfix m-b-10"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Fecha de vencimiento de Cheque</label>
                                            <input id="FechaVencimientoCheque" name="FechaVencimientoCheque" type="text" placeholder="Seleccione la fecha de vencimiento del cheque" class="form-control date FechaVencimientoCheque" data-nombre="Fecha de Vencimiento" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarPago" name="guardarPago">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="modalShow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pagos <button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="margin-top: 10px">
                            <div class="table-responsive">
                                <div class="col-md-12">
                                    <table id="ModalTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Fecha Pago</th>
                                                <th class="text-center">Monto</th>
                                                <th class="text-center">Tipo Pago</th>
                                                <th class="text-center">Detalle</th>
                                                <th class="text-center">Fecha Emisión Cheque</th>
                                                <th class="text-center">Fecha Vencimiento Cheque</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="TablePagosLoader">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                            <div class="col-md-6">
                                                <button data-toggle="modal" href="#IngresoForm" class="btn btn-success">Agregar</button><br><br>
                                                <div class="col-sm-6">
                                                    <div id="date-range">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <input type="text" class="form-control" name="start" />
                                                            <span class="input-group-addon">a</span>
                                                            <input type="text" class="form-control" name="end" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <button id="filtrar" class="btn btn-success">Filtrar</button><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right">
                                                    <b><span style="font-size:16px">Pagado: <span id="pagado">0</span></span><br>
                                                    <span style="font-size:16px">Por pagar: <span id="por_pagar">0</span></span></b>
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <table id="IngresoTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N* de Documento</th>
                                                            <th class="text-center">Tipo de Documento</th>
                                                            <th class="text-center">Fecha Emisión</th>
                                                            <th class="text-center">Fecha Vencimiento</th>
                                                            <th class="text-center">Total Doc.</th>
                                                            <th class="text-center">Saldo Doc.</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="IngresoTableLoader">
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
        <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../plugins/moment/moment.js"></script>
        <script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
        <script src="../plugins/bootbox/bootbox.min.js"></script>
        <script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="../plugins/numbers/jquery.number.min.js"></script>
        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
        <script src="../js/compras/ingresos/Ingreso.js?v=<?php echo (rand()); ?>"></script>
    </body>
</html>