<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <h3 style="color:green">Servicios</h3>
               
                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color: green;" class="servicios-activos"></span>  activos 
                        <i class="fa fa-eye eye-activos" title="Ver Servicios activos"></i>
                    </h2>
                </div>
                <?php   include 'ModalServActivos.php'; ?>
                <br>

                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:orange;" class="servicios-suspendidos"></span>  suspendidos 
                        <i class="fa fa-eye eye-suspendidos" title="Ver Servicios suspendidos"></i>
                    </h2>
                </div>
                <?php   include 'ModalServSuspendidos.php'; ?>

                <br>
                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:red;" class="servicios-corteComercial"></span>  por corte comercial 
                        <i class="fa fa-eye eye-corteComercial" title="Ver servicios por corte comercial"></i>
                    </h2>
                </div>
                <?php   include 'ModalServCorteComercial.php'; ?>

                <br>
                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:red;" class="servicios-cambioRazonSocial"></span>  por cambio razón social
                        <i class="fa fa-eye eye-cambioRazonSocial" title="Ver servicios por cambio razón social"></i>
                    </h2>
                </div>
                <?php   include 'ModalServCambioRazonSocial.php'; ?>

                <br>
                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:orange;" class="servicios-Temporal"></span>  temporales
                        <i class="fa fa-eye eye-Temporal" title="Ver servicios temporales"></i>
                    </h2>
                </div>
                <?php   include 'ModalServTemporal.php'; ?>

                <br>
                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:red;" class="servicios-FinContrato"></span> Fin de contrato
                        <i class="fa fa-eye eye-FinContrato" title="Ver servicios por fin de contrato"></i>
                    </h2>
                </div>
                <?php   include 'ModalServFinContrato.php'; ?>
                

            </div>
        </div>
    </div>
</div>