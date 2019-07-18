<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                
                <div class="col-md-12" style="margin-top: 34px;color:#91c957; text-align:center;">
                    <?php
                    $estado = $lista[0][6];
                    if($estado == 0)
                    $estado = 'Cliente Activo';
                    else
                    $estado = 'Cliente Inactivo';
                    ?> 
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