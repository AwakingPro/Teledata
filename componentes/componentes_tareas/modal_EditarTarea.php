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
                                <label class="control-label" for="FechaInstalacion">Fecha de Instalación (Fecha usada para cálculo de los propocionales o mes completo)</label>
                                <input id="FechaInstalacion" name="FechaInstalacion" validate="not_null"  type="text" placeholder="Seleccione la Fecha de Instalacion" class="form-control date" data-nombre="Fecha de Instalacion">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="actualizaFechaUltimoCobro">Quieres actualizar la fecha del último cobro a la de esta intalación para facturación automática?</label>
                                <div class="select">
                                    <select class="form-control" name="actualizaFechaUltimoCobro" id="actualizaFechaUltimoCobro" data-live-search="true" data-container="body" validate="not_null" data-nombre="Actualizar Fecha Último Cobro">
                                        <option value = "1">Si Actualizar</option>
                                        <option value = "0">No actualizar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="InstaladoPor">Instalado Por</label>
                                <div class="select">
                                    <select class="form-control IdUsuarioAsignado" name="InstaladoPor" id="InstaladoPor" data-live-search="true" data-container="body" validate="not_null" data-nombre="Instalado Por">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix m-b-10"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="UsuarioPppoeTeorico">Posible Usuario PPPoE</label>
                                <input id="UsuarioPppoeTeorico" name="UsuarioPppoeTeorico" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="UsuarioPppoe">Usuario PPPoE Final</label>
                                <input id="UsuarioPppoe" name="UsuarioPppoe" type="text" placeholder="Ingrese el Usuario PPPoE" class="form-control input-sm" validate="not_null" data-nombre="Usuario PPPoE">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="SenalTeorica">Señal Teorica</label>
                                <input id="SenalTeorica" name="SenalTeorica" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="SenalFinal">Señal Final</label>
                                <input id="SenalFinal" name="SenalFinal" type="text" placeholder="Ingrese la Señal Final" class="form-control input-sm" validate="not_null" data-nombre="Señal Final">
                            </div>
                        </div>
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="PosibleEstacion">Estaciones de Referencia</label>
                                <input id="PosibleEstacion" name="PosibleEstacion" type="text" class="form-control input-sm" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="EstacionFinal">Estación Final</label>
                                <select name="EstacionFinal" id="EstacionFinal" class="form-control selectpicker" data-live-search="true" validate="not_null" data-nombre="Estación Final">
                                    <option value="">Seleccione...</option>
                                </select>
                            </div>
                        </div>
 
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="Estatus">Estatus</label>
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
                                <label class="control-label" for="Comentario">Comentario</label>
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