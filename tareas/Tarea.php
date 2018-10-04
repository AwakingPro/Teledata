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
        <link href="../css/loader.css" rel="stylesheet">
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
                        <li class="active">Tareas</li>
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
                                            <li class="active"><a data-toggle="tab" href="#porhacer" aria-expanded="true">Por hacer</a></li>
                                            <li class=""><a data-toggle="tab" href="#asignadas" aria-expanded="true">Asignadas</a></li>
                                            <li class=""><a data-toggle="tab" href="#pendientes" aria-expanded="true">Pendientes</a></li>
                                            <li class=""><a data-toggle="tab" href="#finalizadas" aria-expanded="true">Finalizadas</a></li>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="panel-title">Modulo Tareas</h3>
                            </div>
                            <!--Panel body-->
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="porhacer" class="tab-pane fade active in">
                                        <div class="col-md-12" style="margin-bottom:10px">
                                            <button id="AsignarModal" class="btn btn-success pull-right" style="opacity: 0.2;" disabled>Asignar</button>
                                        </div>
                                        <table id="PorHacerTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"><input class="select-checkbox" name="select_all" id="select_all" type="checkbox"></th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Código</th>
                                                    <th class="text-center">Detalle de Trabajo</th>
                                                    <th class="text-center">Direccion</th>
                                                    <th class="text-center">Fecha Comprometida de Instalación</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="asignadas" class="tab-pane fade">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="AsignadasTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Usuario Asignado</th>
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Código</th>
                                                                <th class="text-center">Detalle de Trabajo</th>
                                                                <th class="text-center">Direccion</th>
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
                                    <div id="pendientes" class="tab-pane fade">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="PendientesTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Usuario Asignado</th>
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Código</th>
                                                                <th class="text-center">Detalle de Trabajo</th>
                                                                <th class="text-center">Direccion</th>
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
                                    <div id="finalizadas" class="tab-pane fade">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <table id="FinalizadasTable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Usuario Instalación</th>
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Código</th>
                                                                <th class="text-center">Detalle de Trabajo</th>
                                                                <th class="text-center">Fecha de Instalación</th>
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

        <?php include("../layout/footer.php"); ?>


        <div id="loader-wrapper">
            <div id="loader"></div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
        <script src="../js/tareas/Tarea.js"></script>
    </body>
</html>

<div id="modalAsignar" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Asignar Tareas <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:20px">
                    <form class="form-horizontal" id = "asignarTareas">
                        <input type="hidden" id="Tareas" name="Tareas">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Usuario</label>
                                <div class="select">
                                    <select class="form-control IdUsuarioAsignado" name="IdUsuarioAsignado" id="IdUsuarioAsignado"  data-live-search="true" data-container="body">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="Asignar" name="Asignar">Asignar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalReasignar" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:20px">
                    <form class="form-horizontal" id = "reasignarTarea">
                        <input type="hidden" id="Id" name="Id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Usuario</label>
                                <div class="select">
                                    <select class="form-control IdUsuarioAsignado" name="IdUsuarioAsignado" id="IdUsuarioAsignado"  data-live-search="true" data-container="body">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="Reasignar" name="Reasignar">Reasignar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalTarea" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:20px">
                    <form class="form-horizontal" id = "storeTarea">
                        <input type="hidden" id="Id" name="Id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Fecha de Instalación</label>
                                <input id="FechaInstalacion" name="FechaInstalacion" validate="not_null"  type="text" placeholder="Seleccione la Fecha de Instalacion" class="form-control date" data-nombre="Fecha de Instalacion">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Instalado Por</label>
                                <div class="select">
                                    <select class="form-control IdUsuarioAsignado" name="InstaladoPor" id="InstaladoPor" data-live-search="true" data-container="body" validate="not_null" data-nombre="Instalado Por">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix m-b-10"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Posible Usuario PPPoE</label>
                                <input id="UsuarioPppoeTeorico" name="UsuarioPppoeTeorico" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Usuario PPPoE Final</label>
                                <input id="UsuarioPppoe" name="UsuarioPppoe" type="text" placeholder="Ingrese el Usuario PPPoE" class="form-control input-sm" validate="not_null" data-nombre="Usuario PPPoE">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Señal Teorica</label>
                                <input id="SenalTeorica" name="SenalTeorica" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Señal Final</label>
                                <input id="SenalFinal" name="SenalFinal" type="text" placeholder="Ingrese la Señal Final" class="form-control input-sm" validate="not_null" data-nombre="Señal Final">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Estaciones de Referencia</label>
                                <input id="PosibleEstacion" name="PosibleEstacion" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Estación Final</label>
                                <select name="EstacionFinal" id="EstacionFinal" class="form-control selectpicker" data-live-search="true" validate="not_null" data-nombre="Estación Final">
                                    <option value="">Seleccione...</option>
                                </select>
                            </div>
                        </div>
 
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Estatus</label>
                                <div class="select">
                                    <select class="selectpicker form-control" name="Estatus" id="Estatus"  data-live-search="true" data-container="body">
                                        <option value = "1">Finalizado</option>
                                        <option value = "2">Pendiente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Comentario</label>
                                <textarea id="Comentario" name="Comentario" rows="4" class="form-control" placeholder="Ingrese el Comentario" data-nombre="Comentario"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="guardarTarea" name="guardarTarea">Guardar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalComparacion" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:20px">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Posible Usuario PPPoE</label>
                            <input id="UsuarioPppoeTeorico_update" name="UsuarioPppoeTeorico" type="text" class="form-control input-sm" validate="not_null" data-nombre="Usuario PPPoE" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Usuario PPPoE Final</label>
                            <input id="UsuarioPppoeFinal_update" name="UsuarioPppoeTeorico" type="text" class="form-control input-sm" validate="not_null" data-nombre="Usuario PPPoE" disabled>
                        </div>
                    </div>
                    <div class="clearfix m-b-10"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Señal Teorica</label>
                            <input id="SenalTeorica_update" name="SenalTeorica" type="text" class="form-control input-sm" validate="not_null" data-nombre="Señal Teorica" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Señal Final</label>
                            <input id="SenalFinal_update" name="SenalFinal" type="text" class="form-control input-sm" validate="not_null" data-nombre="Señal Final" disabled>
                        </div>
                    </div>
                    <div class="clearfix m-b-10"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Estaciones de Referencia</label>
                            <input id="PosibleEstacion_update" name="PosibleEstacion" type="text" class="form-control input-sm" validate="not_null" data-nombre="Estaciones de Referencia" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Estación Final</label>
                            <input id="EstacionFinal_update" name="EstacionFinal" type="text" class="form-control input-sm" validate="not_null" data-nombre="Estación Final" disabled>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-body -->
            <!-- <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="guardarTarea" name="guardarTarea">Guardar</button>
                </div>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalServicio" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <form id = "showServicio">
                    <div class="row" style="padding:20px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="campo-cliente" >Cliente</label>
                                <div class="campo-cliente">
                                    <select id="Rut" name="Rut" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <label class="compo-grupo">Grupo</label>
                                <div class="compo-grupo">
                                    <select id="Grupo" name="Grupo" class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                        <option value="1">Grupo 1</option>
                                        <option value="2">Grupo 2</option>
                                        <option value="3">Grupo 3</option>
                                    </select>
                                </div>
                                <br>
                                <label class="campo-cobreServicio">Tipo de Cobro de servicio</label>
                                <div class="campo-cobreServicio">
                                    <select id="TipoFactura" name="TipoFactura" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <div class="campo-servicio">
                                    <label >Servicio</label>
                                    <select id="IdServicio" name="IdServicio" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <label class="campo-Valor">Valor</label>
                                <div class="form-group">
                                    <input id="Valor" type="text"  name="Valor" class="form-control" disabled>
                                </div>
                                <br>
                                <label>Descuento</label>
                                <div class="input-group">
                                    <input type="text" id="Descuento" name="Descuento" class="form-control" disabled>
                                    <span class="input-group-addon">%</span>
                                </div>
                                <br >
                                <br>
                                <label > Descripción</label>
                                <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5" disabled></textarea>
                                <br>

                                <label class="campo-Conexiones">Conexiones</label>
                                <div class="form-group">
                                    <input id="Alias" type="text" name="Alias" class="form-control campo-Conexiones" disabled>
                                </div>

                                <label class="campo-direccion">Dirección</label>
                                <textarea id="Direccion" name="Direccion" class="form-control campo-direccion" rows="5" disabled></textarea>
                                <br class="campo-direccion">

                                <div class="col-md-6 campo-cordenadas">
                                    <div class="form-group">
                                        <label class="control-label" for="Latitud">Coordenadas</label>
                                        <input id="Latitud" name="Latitud" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 campo-cordenadas">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="Longitud" name="Longitud" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas" disabled>
                                    </div>
                                </div>
                                <br class="campo-cordenadas">

                                <div id="Map" style="height:350px; width:100%;" class="campo-cordenadas"></div>
                                <br class="campo-cordenadas">
                                <label class="campo-referencia">Referencia</label>
                                <div class="form-group campo-referencia">
                                    <input id="Referencia" type="text" name="Referencia" class="form-control" disabled>
                                </div>
                                <br class="campo-referencia">
                                <label class="campo-contacto">Contacto</label>
                                <div class="form-group campo-contacto">
                                    <input id="Contacto" type="text" name="Contacto" class="form-control" disabled>
                                </div>
                                <br  class="campo-contacto">
                                <label class="campo-telefonoContacto">Fono Contacto</label>
                                <div class="form-group campo-telefonoContacto">
                                    <input id="Fono" type="text" name="Fono" class="form-control" disabled>
                                </div>
                                <br class="campo-telefonoContacto">
                                <label class="campo-estacionReferencia">Estaciones de Referencia</label>
                                <div class="form-group campo-estacionReferencia">
                                    <input id="PosibleEstacion" type="text" name="PosibleEstacion" class="form-control" disabled>
                                </div>
                                <br class="campo-estacionReferencia">
                                <label class="campo-usuarioPPPoE">Usuario PPPoE</label>
                                <div class="form-group campo-usuarioPPPoE">
                                    <input id="UsuarioPppoeTeorico" type="text" name="UsuarioPppoeTeorico" class="form-control" disabled>
                                </div>
                                <br class="campo-usuarioPPPoE">
                                <label class="campo-equipamiento">Equipamiento Sugerido</label>
                                <div class="form-group campo-equipamiento">
                                    <input id="Equipamiento" type="text" name="Equipamiento" class="form-control" disabled>
                                </div>
                                <br class="campo-equipamiento">
                                <label class="campo-señalTeorica">Señal Teorica</label>
                                <div class="form-group campo-señalTeorica">
                                    <input id="SenalTeorica" type="text" name="SenalTeorica" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-body -->
            <!-- <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="guardarTarea" name="guardarTarea">Guardar</button>
                </div>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="InfoClienteTable">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del cliente</h4>
            </div>
            <div class="modal-body container-dataCliente">

            </div>
        </div>
    </div>
</div>