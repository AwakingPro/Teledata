<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <!-- <div class="col-md-2">
                    <h2 class="marginNull numberMiniPanel" style="color: red;">
                    <span class="getDocsVencidos" id="getDocsVencidos" ></span>
                    </h2>
                </div> -->
                <!-- <div class="col-xs-7">
                    <h4 class="marginNull" style="    color: #cbd4e0;">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        Abonar Documentos
                    </h4>
                </div> -->
                <div class="col-md-12">
                    <h2 class="marginNull textMiniPanel">
                    <span  style="color: red;" class="getDocsVencidos" id="getDocsVencidos" >
                    </span> Documento(s) Vencido(s)
                    <i class="fa fa-eye verDocVencidos" title="Ver Documentos Vencidos"></i>
                    </h2>
                </div>
                <?php include 'ModalDocVencidos.php'; ?>
<!-- 
                <div class="col-md-12" style="margin-top: 27px;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                </div> -->
                
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h2 class="textMiniPanel">Total Adeudado</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="montoAdeudado"></h2>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <h3 class="textMiniPanel">Total Adeudado</h3>
                </div> -->
                
            </div>
        </div>
    </div>
</div>