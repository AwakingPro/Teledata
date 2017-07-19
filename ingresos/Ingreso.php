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
                            <input type="hidden" id="json" name="json">
                            <input type="hidden" class="estado" id="estado" name="estado">
                            <input type="hidden" class="tipo_ingreso" id="tipo_ingreso" name="tipo_ingreso" value="1">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Estado</label>

                                        <div class="clearfix"></div>

                                        <label class="form-radio form-icon form-text label_estado label_nuevo"><input class="input_nuevo" id="nuevo" name="tmp_estado" type="radio" value="1">Nuevo</label>
                                        <label class="form-radio form-icon form-text label_estado label_reacondicionado"><input class="input_reacondicionado" id="reacondicionado" name="tmp_estado" type="radio" value="2">Reacondicionado</label>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Compra</label>
                                        <input id="fecha_compra" name="fecha_compra" validation="not_null"  type="text" placeholder="Seleccione la fecha de compra" class="form-control date fecha_compra" data-nombre="Fecha de Compra">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Ingreso</label>
                                        <input id="fecha_ingreso" name="fecha_ingreso" validation="not_null" type="text" placeholder="Seleccione la fecha de ingreso" class="form-control date fecha_ingreso" data-nombre="Fecha de Ingreso">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Proveedor - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalProveedor">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="selectpicker form-control proveedor_id proveedor" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-nombre="Proveedor" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Factura</label>
                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number numero_factura" data-nombre="Numero de Factura">
                                    </div>
                                </div>


                                <div class="clearfix m-b-10"></div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Modelo - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalModelo">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="selectpicker form-control modelo_producto_id modelo" id="modelo_producto_id" name="modelo_producto_id" validation="not_null" data-live-search="true" data-nombre="Modelo" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Tipo de Ingreso</label>

                                        <div class="clearfix"></div>

                                        <label class="form-radio form-icon form-text active"><input id="unico" name="tmp_ingreso" checked="" type="radio" value="1">Ingreso Único</label>
                                        <label class="form-radio form-icon form-text"><input id="multiple" name="tmp_ingreso" type="radio" value="2">Ingreso Múltiple</label>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Cantidad</label>
                                        <input id="cantidad" name="cantidad" validation="not_null" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm number cantidad" data-nombre="Cantidad">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group unico">
                                        <label class="control-label" for="name">Numero de Serie</label>
                                        <input id="numero_serie" name="numero_serie" validation="not_null" placeholder="Ingrese el numero de serie" class="form-control input-sm number numero_serie" data-nombre="Numero de Serie">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 unico">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Mac Address</label>
                                        <input id="mac_address" name="mac_address" validation="not_null" placeholder="Ingrese la mac address" class="form-control input-sm mac_address" data-nombre="Mac Address">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Valor</label>
                                        <input id="valor" name="valor" type="text" placeholder="Ingrese el valor" class="form-control input-sm valor" value="0">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Bodega - <label style="cursor:pointer" class="label label-purple" data-toggle="modal" href="#modalBodega">Crear Registro Nuevo</label></label>
                                        <div class="select">
                                            <select class="selectpicker form-control bodega_id bodega" id="bodega_id" name="bodega_id" validation="not_null" data-live-search="true" data-nombre="Bodega" data-container="body">
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
                                <input type="hidden" class="estado" id="estado" name="estado">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Estado</label>

                                        <div class="clearfix"></div>

                                        <label class="form-radio form-icon form-text label_estado label_nuevo"><input class="input_nuevo" id="nuevo" name="tmp_estado" type="radio" value="1">Nuevo</label>
                                        <label class="form-radio form-icon form-text label_estado label_reacondicionado"><input class="input_reacondicionado" id="reacondicionado" name="tmp_estado" type="radio" value="2">Reacondicionado</label>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Compra</label>
                                        <input id="fecha_compra" name="fecha_compra" validation="not_null"  type="text" placeholder="Seleccione la fecha de compra" class="form-control date fecha_compra" data-nombre="Fecha de Compra">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Fecha de Ingreso</label>
                                        <input id="fecha_ingreso" name="fecha_ingreso" validation="not_null" type="text" placeholder="Seleccione la fecha de ingreso" class="form-control date fecha_ingreso" data-nombre="Fecha de Ingreso">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>


                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Proveedor</label>
                                        <div class="select">
                                            <select class="selectpicker form-control proveedor_id proveedor" id="proveedor_id" name="proveedor_id" validation="not_null"  data-live-search="true" data-nombre="Proveedor" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Factura</label>
                                        <input id="numero_factura" name="numero_factura" validation="not_null" placeholder="Ingrese el numero de factura" class="form-control input-sm number numero_factura" data-nombre="Numero de Factura">
                                    </div>
                                </div>


                                <div class="clearfix m-b-10"></div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Modelo</label>
                                        <div class="select">
                                            <select class="selectpicker form-control modelo_producto_id modelo" id="modelo_producto_id" name="modelo_producto_id" validation="not_null" data-live-search="true" data-nombre="Modelo" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Cantidad</label>
                                        <input id="cantidad" name="cantidad" validation="not_null" type="text" placeholder="Ingrese la cantidad" class="form-control input-sm number cantidad" data-nombre="Cantidad">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Numero de Serie</label>
                                        <input id="numero_serie" name="numero_serie" validation="not_null" placeholder="Ingrese el numero de serie" class="form-control input-sm number numero_serie" data-nombre="Numero de Serie">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Mac Address</label>
                                        <input id="mac_address" name="mac_address" validation="not_null" placeholder="Ingrese la mac address" class="form-control input-sm mac_address" data-nombre="Mac Address">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12 nuevo">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Valor</label>
                                        <input id="valor" name="valor" type="text" placeholder="Ingrese el valor" class="form-control input-sm valor" value="0">
                                    </div>
                                </div>

                                <div class="clearfix m-b-10"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Bodega</label>
                                        <div class="select">
                                            <select class="selectpicker form-control bodega_id bodega" id="bodega_id" name="bodega_id" validation="not_null" data-live-search="true" data-nombre="Bodega" data-container="body">
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

         <div id="CantidadForm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ingresar Datos<button type="button" data-dismiss="modal" class="close f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "updateCantidad">


                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                          <button type="button" class="btn btn-purple" id="guardarCantidad" name="guardarCantidad">Guardar</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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

        <div id="modalBodega" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Bodega <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeBodega">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm" validation="not_null" data-nombre="Nombre">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Principal</label>
                                        <div class="select">
                                            <select class="selectpicker form-control principal" name="principal" id="principal"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Principal">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
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
                                        <label class="control-label" for="name">Correo</label>
                                        <input id="nombre" name="correo" type="text" placeholder="Ingrese su correo" class="form-control input-sm" validation="not_null" data-nombre="Correo">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Responsable</label>
                                        <div class="select">
                                            <select class="selectpicker form-control personal_id" name="personal_id" id="personal_id"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Responsable">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarBodega" name="guardarBodega">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="modalModelo" class="modal fade" tabindex="-1" role="dialog" id="load">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                        <h4 class="modal-title c-negro">Agregar Modelo Producto <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding:20px">
                            <form class="form-horizontal" id = "storeModelo">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Marca</label>
                                        <div class="select">
                                            <select class="selectpicker form-control marca_producto_id" name="marca_producto_id" id="marca_producto_id"  data-live-search="true" data-container="body">
                                                <option value="">Seleccione Opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Descripción</label>
                                        <textarea id="descripcion" name="descripcion" rows="4" class="form-control" placeholder="Ingrese su descripción"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer p-b-20 m-b-20">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-purple" id="guardarModelo" name="guardarModelo">Guardar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="container" class="effect mainnav-sm">

            <div class="containerHeader"></div>

            <div class="boxed">
                <div id="content-container">
                    <div id="page-title">
                    </div>
                    <br>
                    <ol class="breadcrumb">
                        <li><a href="#">Módulo Inventario</a></li>
                        <li class="active">Ingresos</li>
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
                                                <li class="active"><a data-toggle="tab" href="#ingreso_registro" aria-expanded="true">Ingresar Registros</a></li>
                                                <li class=""><a data-toggle="tab" href="#busqueda_registro" aria-expanded="true">Buscar Registro</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="panel-title">Modulo Ingresos</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="ingreso_registro" class="tab-pane fade active in">
                                                <div class="table-responsive">
                                                    <div class="col-md-12">

                                                        <button data-toggle="modal" href="#IngresoForm" class="btn btn-success">Agregar</button>

                                                        <table id="IngresoTable" class="table table-striped table-bordered">
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
                                                                    <th class="text-center">Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="busqueda_registro" class="tab-pane fade">
                                                <div class="col-md-12">

                                                    <h4>Buscar por</h4>

                                                    <div class="clearfix"></div>

                                                    <div class="col-md-4 no-padding-left">
                                                        <div class="select">
                                                            <select class="selectpicker form-control" name="tipo_busqueda_ingreso" id="tipo_busqueda_ingreso"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Campo de Busqueda">
                                                                <option value="">Seleccione</option>
                                                                <option value="1">Modelo</option>
                                                                <option value="2">Marca</option>
                                                                <option value="3">Tipo</option>
                                                                <option value="4">Mac Address</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix mar-btm"></div>

                                                    <div class="col-md-4 no-padding-left">
                                                        <select class="selectpicker form-control" name="input_registro" id="input_registro"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Campo de Busqueda">
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

                                                <div class="clearfix"></div>

                                                <div class="pull-right" style="margin-top: 40px ">
                                                    <div class="col-sm-12">
                                                        <button style="margin-right: 5px" type="button" class="btn btn-purple" id="generar" name="generar">Generar Excel</button>
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
        <script src="../plugins/moment/moment.js"></script>
        <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert.min.js"></script>
        <script src="../js/global/validations.js"></script>
        <script src="../js/inventario/ingresos/Ingreso.js"></script>
    </body>
</html>