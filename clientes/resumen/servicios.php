<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <div class="row">

                <!-- <div class="col-xs-5">
                    <h1 class="marginNull numberMiniPanel" style="color: #91c957; margin-left: 5px;">
                        <span class="servicios-activos"></span>
                        <h5 style="color: red;"><span class="servicios-error"></span></h5>
                    </h1>
                 </div> -->

                <div class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color: green;" class="servicios-activos"></span> Servicios Activos 
                        <i class="fa fa-eye eye-activos" title="Ver Servicios Activos"></i>
                    </h2>
                </div>

                <?php   include 'ModalServActivos.php'; ?>
                <br>
                <!-- <div class="col-md-12" style="margin-top: 27px;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-xs-5">
                    <h1 class="marginNull numberMiniPanel" style="color: red; margin-left: 5px;">
                        <span class="servicios-inactivos"></span>
                        <h5 style="color: red;"><span class="servicios-error"></span></h5>
                    </h1>
                 </div> -->

                <div style="padding-left: 0px;" class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span style="color:orange;" class="servicios-inactivos"></span> Servicios Suspendidos 
                        <i class="fa fa-eye eye-inactivos" title="Ver Servicios Suspendidos"></i>
                    </h2>
                </div>

                <?php   include 'ModalServInactivos.php'; ?>
            </div>
        </div>
    </div>
</div>