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
        <script src="../plugins/pace/pace.min.js"></script>
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    </head>
    <body>


        <div id="ProveedorForm" class="modal fade" tabindex="-1" role="dialog" id="load">
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
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"></textarea>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Télefono</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Contacto</label>
                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese su contacto" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm">
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

        <div id="ProveedorFormUpdate" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Actualizar Proveedor <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateProveedor">
                                <input type="hidden" id="id" name="id">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Dirección</label>
                                        <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"></textarea>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Télefono</label>
                                        <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Contacto</label>
                                        <input id="contacto" name="contacto" type="text" placeholder="Ingrese su contacto" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                          <button type="button" class="btn btn-purple" id="actualizarProveedor" name="actualizarProveedor">Actualizar</button>
                        </div>
                    </div></form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="container" class="effect mainnav-sm ">

            <?php
               include("../layout/header.php");
            ?>

            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Módulo Inventario</a></li>
                        <li class="active">Proveedores</li>
                    </ol>
                    <div id="page-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-base ">
                                    <div class="tab-content">
                                        <div class="table-responsive">
                                            <div class="col-md-12">

                                                <button data-toggle="modal" href="#ProveedorForm" class="btn btn-success">Agregar</button>

                                                <table id="ProveedorTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Dirección</th>
                                                            <th>Télefono</th>
                                                            <th>Contacto</th>
                                                            <th>Correo</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                            $sql = mysql_query("SELECT * FROM mantenedor_proveedores");

                                                            while($row = mysql_fetch_array($sql)){

                                                                echo "<tr class='text-center' id=".$row[0].">";
                                                                    echo "<td>".$row[1]."</td>";
                                                                    echo "<td>".$row[2]."</td>";
                                                                    echo "<td>".$row[3]."</td>";
                                                                    echo "<td>".$row[4]."</td>";
                                                                    echo "<td>".$row[5]."</td>";
                                                                    echo '<td><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i></td>';
                                                                echo "</tr>";

                                                            }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- <script id="ProveedorForm" type="text/template">

                                            <div class="row" style="padding: 20px">
                                                <form class="form-horizontal" id = "storeProveedor">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Nombre</label>
                                                            <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Dirección</label>
                                                            <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Télefono</label>
                                                            <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Contacto</label>
                                                            <input id="contacto" name="contacto" type="text" placeholder="Ingrese su contacto" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Correo</label>
                                                            <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>

                                        </script> -->

                                        <!-- <script id="ProveedorFormUpdate" type="text/template">

                                            <div class="row" style="padding: 20px">
                                                <form class="form-horizontal" id = "updateProveedor">
                                                    <input type="hidden" id="id" name="id" value="{ID}">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Nombre</label>
                                                            <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" value="{NOMBRE}">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Dirección</label>
                                                            <textarea id="direccion" name="direccion" rows="4" class="form-control" placeholder="Ingrese su dirección">{DIRECCION}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Télefono</label>
                                                            <input id="telefono" name="telefono" type="text" placeholder="Ingrese su télefono" class="form-control input-sm" value="{TELEFONO}">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Contacto</label>
                                                            <input id="contacto" name="contacto" type="text" placeholder="Ingrese su contacto" class="form-control input-sm" value="{CONTACTO}">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-b-10"></div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Correo</label>
                                                            <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" value="{CORREO}">
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>

                                        </script>
 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("../layout/main-menu.php"); ?>
            </div>
                <?php include("../layout/footer.php"); ?>
        </div>

        <!--SCRIPT-->

        <script src="../js/funciones.js"></script>
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

        <link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">

        <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">

        <script src="../plugins/bootbox/bootbox.min.js"></script>
        <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <!-- <script src="../js/global/funciones-global.js"></script> -->
        <script src="../js/global/validations.js"></script>
        <script src="../js/proveedores/Proveedor.js"></script>
    </body>
</html>