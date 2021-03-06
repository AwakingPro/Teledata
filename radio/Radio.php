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
        <div id="EstacionForm" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Estación <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeEstacion">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" validate="not_null" data-nombre="Nombre">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección" validate="not_null" data-nombre="Dirección"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Télefono Estación</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" validate="not_null" data-nombre="Télefono">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Contacto Estación</label>
                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese el contacto" class="form-control input-sm" validate="not_null" data-nombre="Contacto">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validate="not_null" data-nombre="Correo">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Responsable Teledata</label>
                                        <div class="select">
                                            <select class="form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Responsable">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dueño Cerro</label>
                                        <input id="dueno_cerro" name="dueno_cerro" type="text" placeholder="Ingrese Dueño Cerro" class="form-control input-sm" data-nombre="Dueño Cerro">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Coordenadas</label>
                                        <input id="latitud_coordenada" name="latitud_coordenada" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas insert" data-nombre="Latitud">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="longitud_coordenada" name="longitud_coordenada" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas insert" data-nombre="Longitud">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div id="EstacionFormMap" style="height:350px; width:100%;"></div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Coordenadas Acceso Site</label>
                                        <input id="latitud_coordenada_site" name="latitud_coordenada_site" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas insert" data-nombre="Latitud">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="longitud_coordenada_site" name="longitud_coordenada_site" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas insert" data-nombre="Longitud">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div id="EstacionFormSiteMap" style="height:350px; width:100%;"></div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Datos Proveedor Eléctrico</label>
                                        <textarea id="datos_proveedor_electrico" name="datos_proveedor_electrico" rows="4" class="form-control" placeholder="Ingrese los datos del proveedor eléctrico" data-nombre="Datos Proveedor Eléctrico"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarEstacion" name="guardarEstacion">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="EstacionFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro"><span id="span_estacion">Actualizar</span> Estación <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateEstacion">
                                <input type="hidden" id="id" name="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" validate="not_null" data-nombre="Nombre">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección" validate="not_null" data-nombre="Dirección"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Télefono Estación</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" validate="not_null" data-nombre="Télefono">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Contacto Estación</label>
                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese el contacto" class="form-control input-sm" validate="not_null" data-nombre="Contacto">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validate="not_null" data-nombre="Correo">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Responsable Teledata</label>
                                        <div class="select">
                                            <select class="form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Responsable">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dueño Cerro</label>
                                        <input id="dueno_cerro" name="dueno_cerro" type="text" placeholder="Ingrese Dueño Cerro" class="form-control input-sm" data-nombre="Dueño Cerro">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Coordenadas</label>
                                        <input id="latitud_coordenada" name="latitud_coordenada" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas update" data-nombre="Latitud">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="longitud_coordenada" name="longitud_coordenada" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas update" data-nombre="Longitud">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div id="EstacionFormUpdateMap" style="height:350px; width:100%;"></div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Coordenadas Acceso Site</label>
                                        <input id="latitud_coordenada_site" name="latitud_coordenada_site" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas update" data-nombre="Latitud">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="longitud_coordenada_site" name="longitud_coordenada_site" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas update" data-nombre="Longitud">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div id="EstacionFormUpdateSiteMap" style="height:350px; width:100%;"></div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Datos Proveedor Eléctrico</label>
                                        <textarea id="datos_proveedor_electrico" name="datos_proveedor_electrico" rows="4" class="form-control" placeholder="Ingrese los datos del proveedor eléctrico" data-nombre="Datos Proveedor Eléctrico"></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="actualizarEstacion" name="actualizarEstacion">Actualizar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
                                        <label class="control-label" for="name">Estación</label>
                                        <div class="select">
                                            <select class="selectpicker form-control estacion_id" name="estacion_id" id="estacion_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Estación">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Función</label>
                                        <div class="select">
                                            <select class="selectpicker form-control funcion" id="funcion" name="funcion" validate="not_null" data-live-search="true" data-nombre="Función" data-container="body">
                                                <option value="PMP">PMP</option>
                                                <option value="PTP">PTP</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Alarma Activada</label>
                                        <div class="select">
                                            <select class="selectpicker form-control alarma_activada" id="alarma_activada" name="alarma_activada" validate="not_null" data-live-search="true" data-nombre="Alarma Activada" data-container="body">
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección IP</label>
                                        <input id="direccion_ip" name="direccion_ip" type="text" placeholder="Ingrese la Dirección IP" class="form-control input-sm direccion_ip" validate="not_null" data-nombre="Dirección IP">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Puerto de Acceso</label>
                                        <input id="puerto_acceso" name="puerto_acceso" type="text" placeholder="Ingrese el Puerto de Acceso" class="form-control input-sm puerto_acceso" validate="not_null" data-nombre="Puerto de Acceso">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Ancho de Canal</label>
                                        <input id="ancho_canal" name="ancho_canal" type="text" placeholder="Ingrese el Ancho de Canal" class="form-control input-sm ancho_canal" validate="not_null" data-nombre="Ancho de Canal">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Frecuencia</label>
                                        <input id="frecuencia" name="frecuencia" type="text" placeholder="Ingrese la Frecuencia" class="form-control input-sm frecuencia" validate="not_null" data-nombre="Frecuencia">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">TX Power</label>
                                        <input id="tx_power" name="tx_power" type="text" placeholder="Ingrese el TX Power" class="form-control input-sm tx_power" validate="not_null" data-nombre="TX Power">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Mac Address</label>
                                        <div class="select">
                                            <select class="form-control producto_id" name="producto_id" id="producto_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Mac Address">
                                                <option value="">Seleccione</option>
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
                        <h4 class="modal-title c-negro"><span id="span_ingreso">Actualizar</span> Ingreso <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateIngreso">
                                <input type="hidden" id="id" name="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Estación</label>
                                        <div class="select">
                                            <select class="selectpicker form-control estacion_id" name="estacion_id" id="estacion_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Estación">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Función</label>
                                        <div class="select">
                                            <select class="selectpicker form-control funcion" id="funcion" name="funcion" validate="not_null" data-live-search="true" data-nombre="Función" data-container="body">
                                                <option value="PMP">PMP</option>
                                                <option value="PTP">PTP</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Alarma Activada</label>
                                        <div class="select">
                                            <select class="selectpicker form-control alarma_activada" id="alarma_activada" name="alarma_activada" validate="not_null" data-live-search="true" data-nombre="Alarma Activada" data-container="body">
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección IP</label>
                                        <input id="direccion_ip" name="direccion_ip" type="text" placeholder="Ingrese la Dirección IP" class="form-control input-sm direccion_ip" validate="not_null" data-nombre="Dirección IP">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Puerto de Acceso</label>
                                        <input id="puerto_acceso" name="puerto_acceso" type="text" placeholder="Ingrese el Puerto de Acceso" class="form-control input-sm puerto_acceso" validate="not_null" data-nombre="Puerto de Acceso">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Ancho de Canal</label>
                                        <input id="ancho_canal" name="ancho_canal" type="text" placeholder="Ingrese el Ancho de Canal" class="form-control input-sm ancho_canal" validate="not_null" data-nombre="Ancho de Canal">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Frecuencia</label>
                                        <input id="frecuencia" name="frecuencia" type="text" placeholder="Ingrese la Frecuencia" class="form-control input-sm frecuencia" validate="not_null" data-nombre="Frecuencia">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">TX Power</label>
                                        <input id="tx_power" name="tx_power" type="text" placeholder="Ingrese el TX Power" class="form-control input-sm tx_power" validate="not_null" data-nombre="TX Power">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Mac Address</label>
                                        <div class="select">
                                            <select class="form-control producto_id" name="producto_id" id="producto_id"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Mac Address">
                                                <option value="">Seleccione</option>
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
                <div id="container" class="effect aside-float aside-bright mainnav-sm">
                    <div class="containerHeader"><?php require('../ajax/header/mainHeader.php') ?></div>
                    <div class="boxed">
                        <div id="content-container">
                            <div id="page-title">
                            </div>
                            <br>
                            <ol class="breadcrumb">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Radio Planning</li>
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
                                                        <li class="active"><a data-toggle="tab" href="#busqueda_registro" aria-expanded="true">Buscar Registro</a>
                                                    </li>
                                                    <li class=""><a data-toggle="tab" href="#ingreso_registro" aria-expanded="true">Ingresar Registros</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#ingreso_estacion" aria-expanded="false">Estaciones</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="panel-title">Modulo Radio Planning</h3>
                                </div>
                                <!--Panel body-->
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="ingreso_estacion" class="tab-pane fade">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <button data-toggle="modal" href="#EstacionForm" class="btn btn-success">Agregar</button>
                                                    <table id="EstacionTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Dirección</th>
                                                                <th class="text-center">Teléfono</th>
                                                                <th class="text-center">Contacto</th>
                                                                <th class="text-center">Responsable</th>
                                                                <th class="text-center">Correo</th>
                                                                <th class="text-center">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="TableLoader">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ingreso_registro" class="tab-pane fade">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <button data-toggle="modal" href="#IngresoForm" class="btn btn-success">Agregar</button>
                                                    <table id="IngresoTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Estación</th>
                                                                <th class="text-center">Función</th>
                                                                <th class="text-center">Alarma Activada</th>
                                                                <th class="text-center">Dirección IP</th>
                                                                <th class="text-center">Puerto de Acceso</th>
                                                                <th class="text-center">Ancho de Canal</th>
                                                                <th class="text-center">Frecuencia</th>
                                                                <th class="text-center">TX Power</th>
                                                                <th class="text-center">Mac Address</th>
                                                                <th class="text-center">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="busqueda_registro" class="tab-pane fade active in">
                                            <div class="col-md-12">
                                                <h4>Buscar por</h4>
                                                <div class="clearfix"></div>
                                                <div class="col-md-4 no-padding-left">
                                                    <div class="select">
                                                        <select class="selectpicker form-control" name="tipo_busqueda_ingreso" id="tipo_busqueda_ingreso"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Campo de Busqueda">
                                                            <option value="">Seleccione</option>
                                                            <option value="1">Estación | Repetidor</option>
                                                            <option value="2">Dirección IP</option>
                                                            <option value="4">Mac Address</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix mar-btm"></div>
                                                <div class="col-md-4 no-padding-left">
                                                    <select class="selectpicker form-control" name="input_registro" id="input_registro"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Campo de Busqueda">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                                <button id="buscarRegistro" class="btn btn-success">Buscar</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="BusquedaIngresoTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Estación</th>
                                                                <th class="text-center">Función</th>
                                                                <th class="text-center">Alarma Activada</th>
                                                                <th class="text-center">Dirección IP</th>
                                                                <th class="text-center">Puerto de Acceso</th>
                                                                <th class="text-center">Ancho de Canal</th>
                                                                <th class="text-center">Frecuencia</th>
                                                                <th class="text-center">TX Power</th>
                                                                <th class="text-center">Mac Address</th>
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
        <!--SCRIPT-->
        <script src="../js/jquery-2.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
	    <script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../plugins/bootbox/bootbox.min.js"></script>
        <script src="../js/methods_global/methods.js?v=<?php echo (rand()); ?>"></script>
        <script src="../js/radio/Radio.js?v=<?php echo (rand()); ?>"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
    </body>
</html>