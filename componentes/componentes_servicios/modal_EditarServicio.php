<form id = "showServicio">
    <input type="hidden" class="Id" name="Id" id="Id">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="compo-grupo">Grupo</label>
                <div class="compo-grupo">
                    <select id="Grupo" name="Grupo" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione...</option>
                        <option value="1">Grupo 1</option>
                        <option value="2">Grupo 2</option>
                        <option value="3">Grupo 3</option>
                    </select>
                </div>
                <br>
                <label class="campo-cobreServicio">Tipo de Cobro de servicio</label>
                <div class="campo-cobreServicio">
                    <select id="TipoFactura" name="TipoFactura" class="selectpicker form-control" data-live-search="true">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <br>
                <label class="campo-Valor">Valor</label>
                <div class="form-group">
                    <input id="Valor" type="text"  name="Valor" class="form-control ValorEdit">
                </div>
                <br>
                <label>Descuento %</label>
                <div class="input-group">
                    <input type="text" id="Descuento" name="Descuento" class="form-control DescuentoEdit" placeholder="Ingrese el descuento en %">
                    <span class="input-group-addon" id="DescuentoPesosEdit">%</span>
                </div>
                <div class="form-group">
                    <div class="text-center" style="padding-left:20px;padding-right:20px">
                        <label class="control-label h5" for="selectDescuento">Descuento temporal</label>
                    </div>
                    <select class="selectpicker form-control" name="selectDescuento" id="descuentoTemporal"  data-live-search="true" data-container="body" validate="not_null" data-nombre="selectDescuento">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <br >
                <br>
                <div id="otrosServiciosEditar" style="display:none">
                    <label > Descripción</label>
                    <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5"></textarea>
                    <br>

                    <label class="campo-Conexiones">Conexiones</label>
                    <div class="form-group">
                        <input id="Conexion" type="text" name="Conexion" class="form-control campo-Conexiones">
                    </div>

                    <label class="campo-direccion">Dirección</label>
                    <textarea id="Direccion" name="Direccion" class="form-control campo-direccion" rows="5"></textarea>
                    <br class="campo-direccion">

                    <div class="col-md-6 campo-cordenadas">
                        <div class="form-group">
                            <label class="control-label" for="LatitudEdit">Coordenadas</label>
                            <input id="LatitudEdit" name="LatitudEdit" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadasEdit">
                        </div>
                    </div>
                    <div class="col-md-6 campo-cordenadas">
                        <div class="form-group">
                            <label class="control-label" for="LongitudEdit">&nbsp;</label>
                            <input id="LongitudEdit" name="LongitudEdit" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadasEdit">
                        </div>
                    </div>
                    <br class="campo-cordenadas">

                    <div id="MapEdit" style="height:350px; width:100%;" class="campo-cordenadas"></div>

                    <br class="campo-cordenadas">
                    <label class="campo-referencia">Referencia</label>
                    <div class="form-group campo-referencia">
                        <input id="Referencia" type="text" name="Referencia" class="form-control">
                    </div>
                    <br class="campo-referencia">
                    <label class="campo-contacto">Contacto</label>
                    <div class="form-group campo-contacto">
                        <input id="Contacto" type="text" name="Contacto" class="form-control">
                    </div>
                    <br  class="campo-contacto">
                    <label class="campo-telefonoContacto">Fono Contacto</label>
                    <div class="form-group campo-telefonoContacto">
                        <input id="Fono" type="text" name="Fono" class="form-control">
                    </div>
                    <label>Fecha Comprometida de Instalación</label>
                    <div class="form-group campo-FechaComprometidaInstalacion">
                        <input id="FechaComprometidaInstalacion" name="FechaComprometidaInstalacion" class="form-control date">
                    </div>
                    <br class="campo-telefonoContacto">
                    <label class="campo-estacionReferencia">Estaciones de Referencia</label>
                    <div class="form-group campo-estacionReferencia">
                        <input id="PosibleEstacion" type="text" name="PosibleEstacion" class="form-control">
                    </div>
                    <br class="campo-estacionReferencia">
                    <label class="campo-usuarioPPPoE">Usuario PPPoE</label>
                    <div class="form-group campo-usuarioPPPoE">
                        <input id="UsuarioPppoeTeorico" type="text" name="UsuarioPppoeTeorico" class="form-control">
                    </div>
                    <br class="campo-usuarioPPPoE">
                    <label class="campo-equipamiento">Equipamiento Sugerido</label>
                    <div class="form-group campo-equipamiento">
                        <input id="Equipamiento" type="text" name="Equipamiento" class="form-control">
                    </div>
                    <br class="campo-equipamiento">
                    <label class="campo-señalTeorica">Señal Teorica</label>
                    <div class="form-group campo-señalTeorica">
                        <input id="SenalTeorica" type="text" name="SenalTeorica" class="form-control">
                    </div>
                </div>
                <br class="campo-equipamiento">
                <label class="campo-señalTeorica">Facturación Costo de instalación / Habilitación</label>
                <div class="form-group campo-señalTeorica">
                    <select id="BooleanCostoInstalacion" name="BooleanCostoInstalacion" class="form-control selectpicker">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <br>
                <div id="divCostoInstalacionEditar">
                    <label class="campo-CostoInstalacion">Costo de instalación / Habilitación</label>
                    <div class="form-group">
                        <input type="text" id="CostoInstalacion" name="CostoInstalacion" class="form-control" validate="not_null" data-nombre="Costo de Instalacion">
                    </div>
                    <br>
                    <label>Descuento Instalación</label>
                    <div class="input-group">
                        <input type="text" id="CostoInstalacionDescuento" name="CostoInstalacionDescuento" class="form-control" min="0" max="100" step="1">
                        <span class="input-group-addon">%</span>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</form>