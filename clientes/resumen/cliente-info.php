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
            <!-- <label class="label-cliente">Fecha Instalación</label> -->
                <?php
                    // $FechaInstalacion = \DateTime::createFromFormat('Y-m-d',$factura[2])->format('d-m-Y');
                ?>
                <!-- <h5 class="info-cliente"><?php // echo $FechaInstalacion; ?></h5> -->
            <label class="label-cliente">Posee PAC</label>
                <?php
                    $pac = '';
                    if($lista[0][5] == 0)
                        $pac = 'No';
                    else
                        $pac = 'Si';
                ?>
                <h5 class="info-cliente"><?php echo $pac; ?></h5>
           
            </div>
        </div>
    </div>
</div>