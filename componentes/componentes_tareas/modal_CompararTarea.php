<div id="modalComparacion" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span  class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
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