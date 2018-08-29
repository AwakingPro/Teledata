<form id="insertContactos">
    <div class="col-md-6 form-group">
        <label>Nombre Contacto</label>
        <input name="Nombre" class="form-control" validate="not_null">
    </div>
    <div class="col-md-6 form-group">
        <label>Tipo de Contacto</label>
        <input name="Tipo" class="form-control">
    </div>

    <div class="col-md-6 form-group">
        <label>Correo</label>
        <input name="Correo" class="form-control" validate="email">
    </div>
    <div class="col-md-6 form-group">
        <label>Teléfono</label>
        <input name="Telefono" class="form-control" validate="not_null">
        <input type="hidden" id="IdClienteOculto" name="IdClienteOculto" class="form-control" validate="not_null">
        <!-- <span class="input-group-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extraTelefono"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </span> -->
    </div>
</form>

<div class="col-md-12">
    <br>
    <button id ="guardarContacto" type="button" class="btn btn-primary guardarContacto">Guardar</button>
</div>