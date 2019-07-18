<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <?php
                    $estado = $lista[0][6];
                    if($estado == 0){
                        $estado = 'Cliente Activo';
                        $colorEstado = '#91c957';
                    }
                    else{
                        $estado = 'Cliente Inactivo';
                        $colorEstado = 'red';
                    }
                ?> 
                <div class="col-md-12" style="margin-top: 34px;color:<?php echo $colorEstado ?>; text-align:center;">
                    
                    <h3>
                    <?php
                        echo $estado;
                    ?>
                    <span class="">
                    <!-- </span class="">01/01/2018 -->
                    </h3>
                </div>
                <div class="col-md-6 relleno"></div>
               
            </div>
        </div>
    </div>
</div>