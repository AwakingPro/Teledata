<div class="col-md-4">
    <div class="panel">
        <!-- <div class="panel-bg-cover">
            <img class="img-responsive" src="../img/thumbs/img1.jpg" alt="Image">
        </div> -->

        
       

        <div class="panel-body panel-body-cliente">
        <div class="panel-media imgUser">
            <img class="panel-media-img img-circle img-border-light" src="../img/av1.png" alt="Imagen de perfil">
        </div>
        <br><br>
            <!-- <h3 class="nameUser">Teledata ERP</h3> -->
            <div class="col-md-12">
                <label class="label-cliente">Nombre Contacto</label>
                <h4 class="info-cliente"><?php echo $lista[0][2]; ?></h4>
                <?php
                    $estado = $lista[0][6];
                    if($estado == 0){
                        $estado = 'Activo';
                        $colorEstado = '#91c957';
                    }
                    else{
                        $estado = 'Inactivo';
                        $colorEstado = 'red';
                    }
                ?>
                <label class="label-cliente">Estado</label>
                <h5 class="info-cliente" style="color:<?php echo $colorEstado ?>; text-align:;">
                <?php
                    echo $estado;
                ?>
                </h5>
                <label class="label-cliente">Mail Contacto</label>
                <h5 class="info-cliente"><?php echo $lista[0][3]; ?></h5>
            </div>
            <div class="col-md-6">
            <label class="label-cliente">Teléfono Contacto</label>
                <h5 class="info-cliente"><?php echo $lista[0][4]; ?></h5>
                <?php
                    $pac = '';
                    if($lista[0][5] == 0)
                        $pac = 'No';
                    else
                        $pac = 'Si';
                ?>
            <label class="label-cliente"><b><?php echo $pac; ?> </b>Posee PAC </label>
                
            </div>
        </div>
    </div>
</div>