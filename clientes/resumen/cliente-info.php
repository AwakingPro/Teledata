<div class="col-md-4">
    <div class="panel">
        <div class="panel-bg-cover">
            <img class="img-responsive" src="../img/thumbs/img1.jpg" alt="Image">
            
        </div>
        <div class="panel-media imgUser">
            <img class="panel-media-img img-circle img-border-light" src="../img/av1.png" alt="Profile Picture">
            
        </div>
        <div class="panel-body panel-body-cliente">
            <!-- <h3 class="nameUser">Teledata ERP</h3> -->
            <div class="col-md-6">
                <label class="label-cliente">Nombre Contacto</label>
                <h5 class="info-cliente"><?php echo $lista[0][2]; ?></h5>
                <label class="label-cliente">Mail Contacto</label>
                <h5 class="info-cliente"><?php echo $lista[0][3]; ?></h5>
            </div>
            <div class="col-md-6">
            <label class="label-cliente">Teléfono Contacto</label>
                <h5 class="info-cliente"><?php echo $lista[0][4]; ?></h5>
            </div>
            <br>
            <div class="col-md-12">
                Para obtener ayuda descargue aquí el manual de usuario <br>
                <i class="pli-information icon-lg icon-fw"></i> Ayuda
            </div>
            <br><br>
            <div class="col-md-6 boton-volver">
                <a href="../clientes/listaCliente.php" class="btn btn-primary"><i class="fa fa-paper-plane-o"> Volver</i></a>
            </div>
            
        </div>
    </div>
</div>