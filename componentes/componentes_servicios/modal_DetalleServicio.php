<div id="modalServicio" class="modal fade" tabindex="-1" role="dialog" id="load">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gris-oscuro p-t-10 p-b-10">
                <h4 class="modal-title c-negro">Código: <span class="Codigo"></span> <button type="button" data-dismiss="modal" class="close c-negro f-25" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
            </div>
            <div class="modal-body">
                <form id = "showServicio">
                    <div class="row" style="padding:20px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="campo-cliente" >Cliente</label>
                                <div class="campo-cliente">
                                    <select id="Rut" name="Rut" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <label class="compo-grupo">Grupo</label>
                                <div class="compo-grupo">
                                    <select id="Grupo" name="Grupo" class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                        <option value="1">Grupo 1</option>
                                        <option value="2">Grupo 2</option>
                                        <option value="3">Grupo 3</option>
                                    </select>
                                </div>
                                <br>
                                <label class="campo-cobreServicio">Tipo de Cobro de servicio</label>
                                <div class="campo-cobreServicio">
                                    <select id="TipoFactura" name="TipoFactura" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <div class="campo-servicio">
                                    <label >Servicio</label>
                                    <select id="IdServicio" name="IdServicio" class="form-control" data-live-search="true" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <br>
                                <label class="campo-Valor">Valor</label>
                                <div class="form-group">
                                    <input id="Valor" type="text"  name="Valor" class="form-control" disabled>
                                </div>
                                <br>
                                <label>Descuento</label>
                                <div class="input-group">
                                    <input type="text" id="Descuento" name="Descuento" class="form-control" disabled>
                                    <span class="input-group-addon">%</span>
                                </div>
                                <br >
                                <br>
                                <label > Descripción</label>
                                <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5" disabled></textarea>
                                <br>

                                <label class="campo-Conexiones">Conexiones</label>
                                <div class="form-group">
                                    <input id="Alias" type="text" name="Alias" class="form-control campo-Conexiones" disabled>
                                </div>

                                <label class="campo-direccion">Dirección</label>
                                <textarea id="Direccion" name="Direccion" class="form-control campo-direccion" rows="5" disabled></textarea>
                                <br class="campo-direccion">

                                <div class="col-md-6 campo-cordenadas">
                                    <div class="form-group">
                                        <label class="control-label" for="Latitud">Coordenadas</label>
                                        <input id="Latitud" name="Latitud" type="text" placeholder="Ingrese la latitud" class="form-control input-sm coordenadas" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 campo-cordenadas">
                                    <div class="form-group">
                                        <label class="control-label" for="name">&nbsp;</label>
                                        <input id="Longitud" name="Longitud" type="text" placeholder="Ingrese la longitud" class="form-control input-sm coordenadas" disabled>
                                    </div>
                                </div>
                                <br class="campo-cordenadas">

                                <div id="Map" style="height:350px; width:100%;" class="campo-cordenadas"></div>
                                <br class="campo-cordenadas">
                                <label class="campo-referencia">Referencia</label>
                                <div class="form-group campo-referencia">
                                    <input id="Referencia" type="text" name="Referencia" class="form-control" disabled>
                                </div>
                                <br class="campo-referencia">
                                <label class="campo-contacto">Contacto</label>
                                <div class="form-group campo-contacto">
                                    <input id="Contacto" type="text" name="Contacto" class="form-control" disabled>
                                </div>
                                <br  class="campo-contacto">
                                <label class="campo-telefonoContacto">Fono Contacto</label>
                                <div class="form-group campo-telefonoContacto">
                                    <input id="Fono" type="text" name="Fono" class="form-control" disabled>
                                </div>
                                <br class="campo-telefonoContacto">
                                <label class="campo-estacionReferencia">Estaciones de Referencia</label>
                                <div class="form-group campo-estacionReferencia">
                                    <input id="PosibleEstacion" type="text" name="PosibleEstacion" class="form-control" disabled>
                                </div>
                                <br class="campo-estacionReferencia">
                                <label class="campo-usuarioPPPoE">Usuario PPPoE</label>
                                <div class="form-group campo-usuarioPPPoE">
                                    <input id="UsuarioPppoeTeorico" type="text" name="UsuarioPppoeTeorico" class="form-control" disabled>
                                </div>
                                <br class="campo-usuarioPPPoE">
                                <label class="campo-equipamiento">Equipamiento</label>
                                <div class="form-group campo-equipamiento">
                                    <input id="Equipamiento" type="text" name="Equipamiento" class="form-control" disabled>
                                </div>
                                <br class="campo-equipamiento">
                                <label class="campo-señalTeorica">Señal Teorica</label>
                                <div class="form-group campo-señalTeorica">
                                    <input id="SenalTeorica" type="text" name="SenalTeorica" class="form-control" disabled>
                                </div>
                            </div>
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