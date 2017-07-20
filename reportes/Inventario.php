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
        <link href="../css/flot.css" rel="stylesheet">

    </head>
    <body>

        <div id="container" class="mainnav-sm">

          <div class="containerHeader"></div>

            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Módulo Inventario</a></li>
                        <li class="active">Reporte</li>
                    </ol>
                    <div id="page-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form name="showReporte" id="showReporte">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Seleccione Tipo</label>
                                            <div class="select">
                                                <select class="selectpicker form-control" id="bodega_tipo" name="bodega_tipo" data-live-search="true" data-container="body">
                                                    <option value="">Todas</option>
                                                    <option value="1">Bodega</option>
                                                    <option value="2">Cliente</option>
                                                    <option value="3">Estación</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 tipo" style="display: none">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Seleccione <span id="span_tipo"></span></label>
                                            <div class="select">
                                                <select class="selectpicker form-control" id="bodega_id" name="bodega_id" data-live-search="true" data-container="body">
                                                    <option value="">Todas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Modelo de Equipo</label>
                                            <div class="select">
                                                <select class="selectpicker form-control" id="modelo_producto_id" name="modelo_producto_id" data-live-search="true" data-container="body">
                                                    <option value="">Todas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-purple" id="filtrarReporte">Filtrar</button>
                                    </div>

                                    <div class ="clearfix m-b-10"></div>
                                    <div class ="clearfix m-b-10"></div>

                                </form>

                                <div class="col-md-6 reporte" style="display: none">
                                    <h2>Informe de Inventario</h2>
                                    <hr>
                                    <div id="pie-chart" class="flot-chart-pie"></div>
                                    <div id="flc-pie" class="flc-pie hidden-xs"></div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="tab-base ">
                                    <div class="tab-content">
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <table id="ReporteTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Fecha de Compra</th>
                                                            <th class="text-center">Fecha de Ingreso</th>
                                                            <th class="text-center">Proveedor</th>
                                                            <th class="text-center">Numero de Factura</th>
                                                            <th class="text-center">Modelo</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Numero de Serie</th>
                                                            <th class="text-center">Mac Address</th>
                                                            <th class="text-center">Estado</th>
                                                            <th class="text-center">Valor</th>
                                                            <th class="text-center">Bodega</th>
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
        <script src="../plugins/fast-click/fastclick.min.js"></script>
        <script src="../js/nifty.min.js"></script>
        <script src="../plugins/morris-js/morris.min.js"></script>
        <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
        <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="../plugins/skycons/skycons.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../js/demo/nifty-demo.min.js"></script>
        <script src="../plugins/bootbox/bootbox.min.js"></script>
        <script src="../js/demo/ui-alerts.js"></script>
        <script src="../plugins/audiojs/audio.min.js"></script>
        <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
        <script src="../plugins/bootbox/bootbox.min.js"></script>
        <script src="../plugins/numbers/jquery.number.min.js"></script>
        <script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="../plugins/jquery-flot/jquery.flot.js"></script>
        <script src="../plugins/jquery-flot/jquery.flot.resize.js"></script>
        <script src="../plugins/jquery-flot/jquery.flot.pie.js"></script>
        <script src="../plugins/jquery-flot/jquery.flot.tooltip.min.js"></script>
        <script src="../plugins/moment/moment.js"></script>
        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../js/global/validations.js"></script>
        <script src="../js/inventario/reportes/Reporte.js"></script>

    </body>
</html>
