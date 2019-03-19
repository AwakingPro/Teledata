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
                        <?php 
                            include '../componentes/componentes_tareas/tabla_tareas_servicios.php';
                        ?>
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

        <?php
            // Muestra Modal con select de usuarios al cual asignarle una tarea
            include '../componentes/componentes_tareas/modal_Asignar.php';
            // Muestra Modal con select de usuarios al cual Reasignarle una tarea
            include '../componentes/componentes_tareas/modal_Reasignar.php';

            // Muestra Modal para editar una tarea
            include '../componentes/componentes_tareas/modal_EditarTarea.php';

            // Muestra Modal para comparar una tarea
            include '../componentes/componentes_tareas/modal_CompararTarea.php';

            // Muestra Modal para Editar Servicio
            include '../componentes/componentes_servicios/modal_EditarServicio.php';

            // Muestra Modal con info del cliente
            include '../componentes/componentes_servicios/modal_InfoCliente.php';
        ?>

        <!--SCRIPT-->
        <script src="../js/jquery-2.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../plugins/bootstrap-select/i18n/defaults-es_CL.min.js"></script>
        <script src="../plugins/moment/moment.js"></script>
        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/methods_global/methods.js"></script>
        <script src="../plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="../plugins/numbers/jquery.number.min.js"></script>
        <script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7_zeAQWpASmr8DYdsCq1PsLxLr5Ig0_8" type="text/javascript"></script>
        <script src="../js/tareas/Tarea.js"></script>
    </body>
</html>