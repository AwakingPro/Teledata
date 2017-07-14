<?php require_once('../class/methods_global/methods.php'); ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foco | Software de Estrategia</title>

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

    
    <div id="container" class="effect mainnav-sm">

            <?php
                include("../layout/header.php");
            ?>

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
                                            <!-- <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#ingreso_registro" aria-expanded="true">Ingresar Registro</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#busqueda_registro" aria-expanded="true">Buscar Registros</a>
                                                </li>
                                            </ul> -->
                                        </div>
                                        <h3 class="panel-title">Modulo Nota de Venta</h3>
                                    </div>
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="ingreso_registro" class="tab-pane fade active in">
                                                <form id="showCliente">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Cliente</label>
                                                                <select class="selectpicker form-control" name="personaempresa_id" id="personaempresa_id"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Cliente">
                                                                    <option value="">Seleccione Cliente</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Fecha</label>
                                                                <input id="fecha" name="fecha" validation="not_null"  type="text" placeholder="Seleccione la fecha" class="form-control date" data-nombre="Fecha">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Rut</label>
                                                                <input id="rut" name="rut" class="form-control input-sm" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Giro</label>
                                                                <input id="giro" name="giro" class="form-control input-sm" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Contacto</label>
                                                                <input id="contacto" name="contacto" class="form-control input-sm" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Dirección</label>
                                                                <input id="direccion" name="direccion" class="form-control input-sm" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                <div class="row" style="margin-top: 20px">
                                                    <form id="addServicio">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Código</label>
                                                                </div>
                                                                <input id="codigo" name="codigo" class="form-control input-sm" validation="not_null" data-nombre="Código" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Servicio</label>
                                                                </div>
                                                                <input id="servicio" name="servicio" class="form-control input-sm" validation="not_null" data-nombre="Servicio" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Cantidad</label>
                                                                </div>
                                                                <input id="cantidad" name="cantidad" class="form-control input-sm" maxlength="6" validation="not_null" data-nombre="Cantidad" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Precio</label>
                                                                </div>
                                                                <input id="precio" name="precio" class="form-control input-sm number" validation="not_null" data-nombre="Precio" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Indic. Exención</label>
                                                                </div>
                                                                <select class="selectpicker form-control" name="exencion" id="exencion"  data-live-search="true" data-container="body">
                                                                    <option value="1">Afecto</option>
                                                                    <option value="2">No Afecto</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="text-center">
                                                                    <label class="control-label h5" for="name">Total</label>
                                                                </div>
                                                                <input id="total" name="total" class="form-control input-sm number" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" id="guardarServicio" name="guardarServicio" style="margin-top: 30px" class="btn btn-success btn-icon btn-circle icon-lg fa fa-plus"></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                                <div class="clearfix"></div>

                                                <div class="row" style="margin-top: 10px">
                                                    <div class="table-responsive">
                                                        <div class="col-md-12">

                                                            <table id="ServicioTable" class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Código</th>
                                                                        <th class="text-center">Servicio</th>
                                                                        <th class="text-center">Cantidad</th>
                                                                        <th class="text-center">Precio</th>
                                                                        <th class="text-center">Indic. Exención</th>
                                                                        <th class="text-center">Total</th>
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
                                                                <h5>Neto:</h5>
                                                            </div>
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5 id="neto" style="border-bottom: 1px solid #ccc;">0</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-offset-4">
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5>Exento:</h5>
                                                            </div>
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5 id="exencion_nota" style="border-bottom: 1px solid #ccc;">0</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-offset-4">
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5>I.V.A.:</h5>
                                                            </div>
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5 id="iva" style="border-bottom: 1px solid #ccc;">0</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-offset-4">
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5>Total:</h5>
                                                            </div>
                                                            <div class="col-md-6" style="text-align: right">
                                                                <h5 id="total_nota" style="border-bottom: 1px solid #ccc;">0</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer" style="margin-top: 20px ">
                                                    <div class="col-sm-12">
                                                        <button type="button" class="btn btn-purple" id="guardar" name="guardar">Guardar</button>

                                                        <button type="button" class="btn btn-default" id="cancelar" name="cancelar">Cancelar</button>
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
        <script src="../js/nifty.min.js"></script>
        <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../plugins/moment/moment.js"></script>
        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/global/validations.js"></script>
        <script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="../plugins/numbers/jquery.number.min.js"></script>
        <script src="../js/nota_venta/NotaVenta.js"></script>

    </body>
</html>