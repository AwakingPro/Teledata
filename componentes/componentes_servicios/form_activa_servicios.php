<div id="loader_servicios"></div>
<form id="formEstatus">
    <input type="hidden" class="Id" name="Id" id="Id">
    <input type="hidden" class="" name="servicio_rut_dv" id="servicio_rut_dv">
    <input type="hidden" class="" name="servicio_nombre_cliente" id="servicio_nombre_cliente">
    <input type="hidden" class="" name="servicio_codigo_cliente" id="servicio_codigo_cliente">
    <div class="row" style="padding:20px">
        <div class="col-md-12">
            <div class="form-group">
                <label class="compo-grupo">Estado del Servicio</label>
                <div class="compo-grupo">
                    <select id="Activo" name="Activo" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione...</option>
                        <option value="1">Activo</option>
                        <option value="2">Suspendido</option>
                        <option value="0">Corte Comercial</option>
                    </select>
                </div>
                <br>
                <div id="divFechaActivacion" style="display:none">
                    <label>Fecha de suspensión</label>
                    <div class="form-group">
                        <div id="date-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" id="FechaInicioDesactivacion" name="FechaInicioDesactivacion" data-nombre="Fecha de Activación" />
                                <span class="input-group-addon">a</span>
                                <input type="text" class="form-control" id="FechaFinalDesactivacion" name="FechaFinalDesactivacion" data-nombre="Fecha de Activación" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="compo-grupo">Enviar correo a Técnicos</label>
                <div class="compo-grupo">
                    <select id="selectEnviaCorreo" name="selectEnviaCorreo" class="form-control selectpicker" data-live-search="true">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>