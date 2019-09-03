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
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="../css/teledata.css" rel="stylesheet">
    </head>
    <body>
        <div id="modalNotaVenta" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Editar Nota de Venta <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:10px">
                            <form class="form-horizontal" id = "formNotaVenta">
                                <input type="hidden" name="nota_venta_id" id="nota_venta_id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="personaempresa_id_update">Cliente</label>
                                        <select class="selectpicker form-control" name="personaempresa_id_update" id="personaempresa_id_update" data-live-search="true" data-container="body" validate="not_null" data-nombre="Cliente">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="fecha_update">Fecha</label>
                                        <input id="fecha_update" name="fecha_update" validate="not_null" type="text" placeholder="Seleccione la fecha" class="form-control date" data-nombre="Fecha">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="numero_oc_update">Numero de OC</label>
                                        <input id="numero_oc_update" name="numero_oc_update" class="form-control input-sm" data-nombre="Numero de OC">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="padding-left:20px;padding-right:20px">
                                        <label class="control-label" for="fecha_oc_update">Fecha emisión OC</label>
                                        <input id="fecha_oc_update" name="fecha_oc_update" class="form-control input-sm" data-nombre="Fecha emisión OC">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="numero_hes_update">Numero de HES</label>
                                        <input id="numero_hes_update" name="numero_hes_update" class="form-control input-sm" data-nombre="Numero de HES">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="padding-left:20px;padding-right:20px">
                                        <label class="control-label" for="fecha_hes_update">Fecha emisión HES</label>
                                        <input id="fecha_hes_update" name="fecha_hes_update" class="form-control input-sm" data-nombre="Fecha emisión HES">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="solicitado_por_update">Solicitado Por</label>
                                        <select class="selectpicker form-control" name="solicitado_por_update" id="solicitado_por_update" data-live-search="true" data-container="body" validate="not_null" data-nombre="Solicitado Por">
                                        </select>
                                    </div>
                                </div>
                                
                            </form>
                            <form class="form-horizontal" id = "formDetalle">
                                <input type="hidden" name="nota_venta_id" id="nota_venta_id">
                                <div class="row" style="margin:0">
                                    <div class="col-md-2" style="padding-left:20px;padding-right:20px">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <label class="control-label h5" for="concepto">Concepto</label>
                                            </div>
                                            <input id="concepto" name="concepto" class="form-control input-sm" validate="not_null" data-nombre="Concepto">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-left:20px;padding-right:20px">
                                            <div class="text-center">
                                                <label class="control-label h5" for="precio">Precio</label>
                                            </div>
                                            <input id="precio" name="precio" class="form-control input-sm number" validate="not_null" data-nombre="Precio">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="text-center" style="padding-left:20px;padding-right:20px">
                                                <label class="control-label h5" for="moneda">Moneda</label>
                                            </div>
                                            <select class="selectpicker form-control" name="moneda" id="moneda"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Moneda">
                                                <option value="1">Pesos</option>
                                                <option value="2">UF</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="padding-left:20px;padding-right:20px">
                                            <div class="text-center">
                                                <label class="control-label h5" for="cantidad">Cantidad</label>
                                            </div>
                                            <input id="cantidad" name="cantidad" class="form-control input-sm" maxlength="6" validate="not_null" data-nombre="Cantidad" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-left:20px;padding-right:20px">
                                            <div class="text-center">
                                                <label class="control-label h5" for="total">Total</label>
                                            </div>
                                            <input id="total" name="total" class="form-control input-sm" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-left:20px;padding-right:20px">
                                            <div class="text-center">
                                                <label class="control-label h5" for="descuento">Descuento</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" name="descuento" id="descuento" class="form-control" min="0" max="100" step="1" value="0">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="insertDetalle" name="insertDetalle" style="margin-top: 30px" class="btn btn-success btn-icon btn-circle icon-lg fa fa-plus" disabled></button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="DetalleTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Concepto</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Total I.V.A. Incluido</th>
                                                <th class="text-center">Descuento %</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                     </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="updateNotaVenta" name="updateNotaVenta">Actualizar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="modalDetalle" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Editar Detalle <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "formDetalleUpdate">
                                <input type="hidden" name="detalle_id" id="detalle_id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="concepto_update">Concepto</label>
                                        <input id="concepto_update" name="concepto_update" class="form-control input-sm" validate="not_null" data-nombre="Concepto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="precio_update">Precio</label>
                                        <input id="precio_update" name="precio_update" class="form-control input-sm number" validate="not_null" data-nombre="Precio">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="moneda_update">Moneda</label>
                                        <select class="selectpicker form-control" name="moneda_update" id="moneda_update"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Moneda">
                                            <option value="1">Pesos</option>
                                            <option value="2">UF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="cantidad_update">Cantidad</label>
                                        <input id="cantidad_update" name="cantidad_update" class="form-control input-sm_update" maxlength="6" validate="not_null" data-nombre="Cantidad" value="1">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="total_update">Total</label>
                                        <input id="total_update" name="total_update" class="form-control input-sm" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label h5" for="descuento_update">Descuento</label>
                                        <div class="input-group">
                                            <input type="text" name="descuento_update" id="descuento_update" class="form-control" min="0" max="100" step="1">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div>
                     </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="updateDetalle" name="updateDetalle">Actualizar</button>
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
                        <li class="active">Nota de Venta</li>
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
                                                <li class="active"><a data-toggle="tab" href="#ingreso_registro" aria-expanded="true">Ingresar Registro</a>
                                            </li>
                                            <li class=""><a data-toggle="tab" href="#mostrar_registros" aria-expanded="true">Mostrar Registros</a>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="panel-title">Modulo Nota de Venta</h3>
                            </div>
                            <!--Panel body-->
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="ingreso_registro" class="tab-pane fade active in">
                                        <form id="formCliente">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="personaempresa_id">Cliente</label>
                                                        <select class="selectpicker form-control" name="personaempresa_id" id="personaempresa_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Cliente">
                                                            <option value="">Seleccione Cliente</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="fecha">Fecha</label>
                                                        <input id="fecha" name="fecha" validate="not_null"  type="text" placeholder="Seleccione la fecha" class="form-control date" data-nombre="Fecha">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="rut">Rut</label>
                                                        <input id="rut" name="rut" class="form-control input-sm" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="giro">Giro</label>
                                                        <input id="giro" name="giro" class="form-control input-sm" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="contacto">Contacto</label>
                                                        <input id="contacto" name="contacto" class="form-control input-sm" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="direccion">Dirección</label>
                                                        <input id="direccion" name="direccion" class="form-control input-sm" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="numero_oc">Numero de OC</label>
                                                        <input id="numero_oc" name="numero_oc" class="form-control input-sm" data-nombre="Numero de OC">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="fecha_oc">Fecha emisión OC</label>
                                                        <input id="fecha_oc" name="fecha_oc" class="form-control input-sm" data-nombre="Fecha emisión OC">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="solicitado_por">Solicitado Por</label>
                                                        <select class="selectpicker form-control" name="solicitado_por" id="solicitado_por" data-live-search="true" data-container="body" validate="not_null" data-nombre="Solicitado Por">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="numero_hes">Numero de HES</label>
                                                        <input id="numero_hes" name="numero_hes" class="form-control input-sm" data-nombre="Numero de HES">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="fecha_hes">Fecha emisión HES</label>
                                                        <input id="fecha_hes" name="fecha_hes" class="form-control input-sm" data-nombre="Fecha emisión HES">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="ServiciosSeleccionados" name="ServiciosSeleccionados">
                                        </form>
                                        <div class="row" style="margin-top: 20px">
                                            <div class="col-md-2">
                                                <label id="label_automatico" class="form-radio label_tipo  form-icon form-text" for="automatico">
                                                    <input id="automatico" class="switch_tipo" name="switch_tipo" type="radio" value="1" checked>
                                                Automático</label>
                                                    
                                                <label id="label_manual" class="form-radio label_tipo  form-icon form-text" for="manual">
                                                    <input id="manual" class="switch_tipo" name="switch_tipo" type="radio" value="2">
                                                Manual</label>
                                            </div>
                                            <div class="clearfix"></div>

                                            <form id="formDetalleTmp">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="concepto_tmp">Concepto</label>
                                                        </div>
                                                        <div id="concepto_container">
                                                            <select class="selectpicker form-control" name="concepto_tmp" id="concepto_tmp"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Concepto">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="precio_tmp">Precio</label>
                                                        </div>
                                                        <input id="precio_tmp" name="precio_tmp" class="form-control input-sm" validate="not_null" data-nombre="Precio">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="moneda_tmp">Moneda</label>
                                                        </div>
                                                        <select class="selectpicker form-control" name="moneda_tmp" id="moneda_tmp"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Moneda">
                                                            <option value="1">Pesos</option>
                                                            <option value="2">UF</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="cantidad_tmp">Cantidad</label>
                                                        </div>
                                                        <input id="cantidad_tmp" name="cantidad_tmp" class="form-control input-sm" maxlength="6" validate="not_null" data-nombre="Cantidad" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="total_tmp">Total</label>
                                                        </div>
                                                        <input id="total_tmp" name="total_tmp" class="form-control input-sm" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <label class="control-label h5" for="descuento">Descuento</label>
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="text" name="descuento" id="descuento" class="form-control" min="0" max="100" step="1" value="0">
                                                            <span class="input-group-addon">%</span>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="insertDetalleTmp" name="insertDetalleTmp" style="margin-top: 30px" class="btn btn-success btn-icon btn-circle icon-lg fa fa-plus" disabled></button>
                                                </div>
                                                
                                            </form>
                                        </div>

                                        <!-- inicio ver servicios asociados -->
                                        <h3 class="panel-title">Seleccione los servicios que estaran asociados a esta nota de venta</h3>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12" id="componenteNotaCreditoParcial" >
                                            <div class="form-group">
                                                <div class="table-responsive">
                                                        <table id="TablaFacturaDetalle" class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center">Código</th>
                                                                    <th class="text-center">Descripción / Conexión</th>
                                                                    <th class="text-center">Valor UF</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fin ver servicios asociados -->
                                        
                                        <div class="clearfix"></div>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="DetalleTableTmp" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Concepto</th>
                                                                <th class="text-center">Precio</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-center">Total I.V.A. Incluido</th>
                                                                <th class="text-center">Descuento %</th>
                                                                <th class="text-center">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="col-sm-3 col-sm-offset-9">
                                                <h4>Totales</h4>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-7">
                                                <div class="col-sm-offset-4">
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5>Valor Total Neto:</h5>
                                                    </div>
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5 id="neto_nota" style="border-bottom: 1px solid #ccc;">0</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-4">
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5>I.V.A.:</h5>
                                                    </div>
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5 id="iva_nota" style="border-bottom: 1px solid #ccc;">0</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-4">
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5>Valor Total I.V.A. Incluido:</h5>
                                                    </div>
                                                    <div class="col-md-6" style="text-align: right">
                                                        <h5 id="total_nota" style="border-bottom: 1px solid #ccc;">0</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-top: 40px ">
                                            <div class="col-sm-12">
                                                <button style="margin-right: 5px" type="button" class="btn btn-purple" id="insertNotaVenta" name="insertNotaVenta">Guardar</button>
                                                <button type="button" class="btn btn-default" id="cancelar" name="cancelar">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mostrar_registros" class="tab-pane fade">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="NotaVentaTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Rut</th>
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Numero de OC</th>
                                                                <th class="text-center">Numero de HES</th>
                                                                <th class="text-center">Solicitado Por</th>
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Total Descuento %</th>
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
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../plugins/sweetalert/sweetalert.min.js"></script>
<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../plugins/moment/moment.js"></script>
<script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../js/methods_global/methods.js"></script>
<script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
<script src="../plugins/numbers/jquery.number.min.js"></script>
<script src="../js/nota_venta/NotaVenta.js"></script>
</body>
</html>