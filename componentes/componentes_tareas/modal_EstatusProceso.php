<div id="modalEstatusServicio" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:20px">
                    <form class="form-horizontal" id = "storeEstatusServicio">
                        <input type="hidden" id="Id" name="Id">
                        <div class="clearfix m-b-10"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="EstatusServicio">Cambiar estatus del servicio</label>
                                <div class="select">
                                    <select class="selectpicker form-control" name="EstatusServicio" id="EstatusServicio"  data-live-search="true" data-container="body">
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
                    <button type="button" class="btn btn-purple" id="guardarEstatus" name="guardarEstatus">Guardar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->