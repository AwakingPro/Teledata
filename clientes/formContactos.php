<form id="insertContactos" class="insertContactos">
    <div class="col-md-6 form-group">
        <label>Nombre Contacto</label>
        <input id="NombreContacto" name="NombreContacto" class="form-control" validate="not_null">
    </div>
    <div class="col-md-6 form-group">
        <label>Tipo de Contacto</label>
        <input name="TipoContacto" class="form-control">
    </div>

    <div class="col-md-6 form-group">
        <label>Correo</label>
        <input name="CorreoContacto" class="form-control" validate="email">
    </div>
    <div class="col-md-6 form-group">
        <label>Teléfono</label>
        <input name="TelefonoContacto" class="form-control" validate="not_null">
        <input type="hidden" id="IdClienteOculto" name="IdClienteOculto" class="form-control" validate="not_null">
        <input type="hidden" id="IdContactoOculto" name="IdContactoOculto" class="form-control">
    </div>
</form>

<div class="col-md-12">
    <br>
    <button id ="guardarContacto" type="button" class="btn btn-primary guardarContacto">Guardar</button>
</div>