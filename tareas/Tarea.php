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
                                                <li class="active"><a data-toggle="tab" href="#pendientes" aria-expanded="true">Pendientes</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#asignadas" aria-expanded="true">Asignadas</a>
                                                <li class=""><a data-toggle="tab" href="#finalizadas" aria-expanded="true">Finalizadas</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="panel-title">Modulo Tareas</h3>
                                    </div>
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="pendientes" class="tab-pane fade active in">
                                                <div class="col-md-12" style="margin-bottom:10px">
                                                    <button id="AsignarModal" data-toggle="modal" href="#ModeloProductoForm" class="btn btn-success pull-right" style="opacity: 0.2;" disabled>Asignar</button>
                                                </div>

                                                <table id="PendientesTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"><input class="select-checkbox" name="select_all" id="select_all" type="checkbox"></th>
                                                            <th class="text-center">Cliente</th>
                                                            <th class="text-center">Código</th>
                                                            <th class="text-center">Tiempo de Facturación</th>
                                                            <th class="text-center">Descripción</th>
                                                            <th class="text-center">Grupo</th>
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
                                                                        <th class="text-center">Tiempo de Facturación</th>
                                                                        <th class="text-center">Descripción</th>
                                                                        <th class="text-center">Grupo</th>
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
                                                                        <th class="text-center">Usuario Asignado</th>
                                                                        <th class="text-center">Cliente</th>
                                                                        <th class="text-center">Código</th>
                                                                        <th class="text-center">Tiempo de Facturación</th>
                                                                        <th class="text-center">Descripción</th>
                                                                        <th class="text-center">Grupo</th>
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
                                    <select class="selectpicker form-control IdUsuarioAsignado" name="IdUsuarioAsignado" id="IdUsuarioAsignado"  data-live-search="true" data-container="body">
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
            </div></form>
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
                                    <select class="selectpicker form-control IdUsuarioAsignado" name="IdUsuarioAsignado" id="IdUsuarioAsignado"  data-live-search="true" data-container="body">
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
            </div></form>
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
                                <label class="control-label" for="name">Fecha de Instación</label>
                                <input id="FechaInstalacion" name="FechaInstalacion" validation="not_null"  type="text" placeholder="Seleccione la Fechade Instalacion" class="form-control date" data-nombre="FechaInstalacion">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Instalado Por</label>
                                <input id="nombre" name="InstaladoPor" type="text" placeholder="Ingrese el campo Instalado Por" class="form-control input-sm" validation="not_null" data-nombre="Instalado Por">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Comentario</label>
                                <textarea id="Comentario" name="Comentario" rows="4" class="form-control" placeholder="Ingrese el Comentario" validation="not_null" data-nombre="Comentario"></textarea>
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Usuario PPPoE</label>
                                <input id="UsuarioPppoe" name="UsuarioPppoe" type="text" placeholder="Ingrese el Usuario PPPoE" class="form-control input-sm" validation="not_null" data-nombre="Usuario PPPoE">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Señal Final</label>
                                <input id="SenalFinal" name="SenalFinal" type="text" placeholder="Ingrese la Señal Final" class="form-control input-sm" validation="not_null" data-nombre="Señal Final">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Estación Final</label>
                                <input id="EstacionFinal" name="EstacionFinal" type="text" placeholder="Ingrese la Estación Final" class="form-control input-sm" validation="not_null" data-nombre="Estación Final">
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
                    </form>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer p-b-20 m-b-20">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-purple" id="guardarTarea" name="guardarTarea">Guardar</button>
                </div>
            </div></form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->