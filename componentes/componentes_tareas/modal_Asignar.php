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
                                        <option value="0" data-content="Asigne un técnico"></option>
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