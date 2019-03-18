
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control">
                    <!--Nav tabs-->
                    <ul class="nav nav-tabs">
                    <?php
                    
                    if(!isset($OcultarTareasPorHacer)){
                        echo '<li class="active"><a data-toggle="tab" href="#porhacer" aria-expanded="true">Por hacer</a></li>';
                        echo '<li class=""><a data-toggle="tab" href="#asignadas" aria-expanded="true">Asignadas</a></li>';
                    }else{
                        echo '<li class="active"><a data-toggle="tab" href="#asignadas" aria-expanded="true">Asignadas</a></li>';
                    }
                    ?>
                    <li class=""><a data-toggle="tab" href="#pendientes" aria-expanded="true">Pendientes</a></li>
                    <li class=""><a data-toggle="tab" href="#finalizadas" aria-expanded="true">Finalizadas</a></li>
                </li>
            </ul>
        </div>
        <h3 class="panel-title">
        <?php
        if(isset($Titulo))
        echo $Titulo;
        else
        echo 'Modulo'; 
        ?>
        Tareas</h3>
    </div>
    <!--Panel body-->
    <div class="panel-body">
        <div class="tab-content">
        <?php
            if(!isset($OcultarTareasPorHacer)){
                ?>
                <div id="porhacer" class="tab-pane fade active in">
                <div class="col-md-12" style="margin-bottom:10px">
                    <button id="AsignarModal" class="btn btn-success pull-right" style="opacity: 0.2;" disabled>Asignar</button>
                </div>
                <table id="PorHacerTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input class="select-checkbox" name="select_all" id="select_all" type="checkbox"></th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Código</th>
                            <th class="text-center">Detalle de Trabajo</th>
                            <th class="text-center">Direccion</th>
                            <th class="text-center">Fecha Comprometida de Instalación</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>

            <?php
            if(!isset($OcultarTareasPorHacer)){
            echo '<div id="asignadas" class="tab-pane fade">';
            }
            else{
            echo '<div id="asignadas" class="tab-pane fade active in">';
            }
            ?>
                <div class="row" style="margin-top: 10px">
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <table id="AsignadasTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Usuario Asignado</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Detalle de Trabajo</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pendientes" class="tab-pane fade">
                <div class="row" style="margin-top: 10px">
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <table id="PendientesTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Usuario Asignado</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Detalle de Trabajo</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="finalizadas" class="tab-pane fade">
                <div class="row" style="margin-top: 10px">
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <table id="FinalizadasTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Usuario Instalación</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Detalle de Trabajo</th>
                                        <th class="text-center">Fecha de Instalación</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>