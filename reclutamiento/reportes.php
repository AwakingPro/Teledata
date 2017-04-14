<?php
    require_once('../db/db.php');
    include("../class/global/global.php");
    require_once('../class/session/session.php');
    $objetoSession = new Session('5',false); // 1,4
    //Para Id de Menu Actual (Menu Padre, Menu hijo)
    $objetoSession->crearVariableSession($array = array("idMenu" => "rec,rep"));
    // ** Logout the current user. **
    $objetoSession->creaLogoutAction();
    if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
    {
    //to fully log out a visitor we need to clear the session varialbles
        $objetoSession->borrarVariablesSession();
        $objetoSession->logoutGoTo("../index.php");
    }
    $validar = $_SESSION['MM_UserGroup'];
    $objetoSession->creaMM_restrictGoTo();
    $usuario = $_SESSION['MM_Username'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nifty.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
    <style type="text/css">
    .select1
             {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

             }
    .select2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            }
    .text1
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

            }
    .text2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            }
    .mostrar_condiciones
           {
           }
    #midiv100
           {
            display: none;
           }

    #oculto
           {
            display: none;
           }
    #guardar
           {
            display: none;
           }
    #folder
           {
            display: none;
           }
    .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('../img/gears.gif')
            50% 50%
            no-repeat;
            }
body.loading
           {
            overflow: hidden;
           }
body.loading .modal
          {
           display: block;
          }

 #divtablapeq {
    width: 500px;
    }
 #divtablamed {
    width: 600px;
    }

    </style>
</head>
<body>
  <div id="container" class="effect mainnav-sm">
    <!--NAVBAR-->
    <!--===================================================-->
    <?php
    include("../layout/header.php");
    ?>
    <!--===================================================-->
    <!--END NAVBAR-->
      <div class="boxed">
        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
          <!--Page Title-->
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <div id="page-title">
          <!--Searchbox-->
          </div>
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <!--End page title-->
          <!--Breadcrumb-->
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <ol class="breadcrumb">
            <li><a href="#">Administrador</a></li>
            <li class="active">Gestionar Usuarios</li>
          </ol>
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <!--End breadcrumb-->
          <!--Page content-->
          <!--===================================================-->
          <div id="page-content">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading bg-primary">
                        <h2 class="panel-title">Reporte de Reclutamiento</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Seleccione rango de fecha</label>
                                    <div id="date-range">
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control" name="start" />
                                            <span class="input-group-addon">a</span>
                                            <input type="text" class="form-control" name="end" />
                                        </div>
                                    </div>
                                    <button id="FiltrarPorFecha" class="btn btn-primary" style="margin-top: 10px;" type="submit">Filtrar Fecha</button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Calificación:</label>
                                    <select class="selectpicker form-control" name="Calificacion" title="Todas" data-live-search="true" data-width="100%">
                                        <option value="1">Todos</option>
                                        <option value="2">Aprobados</option>
                                        <option value="3">Reprobados</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Perfil:</label>
                                    <select disabled="disabled" class="selectpicker form-control" name="Perfil" title="Seleccione" data-live-search="true" data-width="100%">
                                        <option value="">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Aspirantes:</label>
                                    <select disabled="disabled" class="selectpicker form-control" name="Aspirante" title="Seleccione" data-live-search="true" data-width="100%">
                                        <option value="1">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="ResultTables" style="display: none;">
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-heading bg-primary">
                            <h2 class="panel-title"></h2>
                        </div>
                        <div class="panel-body">
                            <table id="Calificaciones">
                                <thead>
                                    <th>Nombre Completo</th>
                                    <th>Promedio Calificación</th>
                                    <th>Promedio Calificación Minima</th>
                                    <th>Gráfico</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-heading bg-primary">
                            <h2 class="panel-title"></h2>
                        </div>
                        <div class="panel-body">
                            <div id="ChartContainer">
                                <canvas id="radarChart" width="640" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!--===================================================-->
          <!--End page content-->
        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->
        <!--MAIN NAVIGATION-->
        <!--===================================================-->
        <?php include("../layout/main-menu.php"); ?>
        <!--===================================================-->
        <!--END MAIN NAVIGATION-->
      </div>
        <!-- FOOTER -->
        <!--===================================================-->
        <?php include("../layout/footer.php"); ?>
        <!--===================================================-->
        <!-- END FOOTER -->
        <!-- SCROLL TOP BUTTON -->
        <!--===================================================-->
        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
        <div class="modal"><!-- Place at bottom of page --></div>
        <!--===================================================-->
        <div class="modal fade" tabindex="-1" role="dialog" id="Cargando">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="spinner loading"></div>
                            <h4 class="text-center">Procesando por favor espere...</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
    <script src="../js/jquery-2.2.1.min.js"></script>
    <script src="../js/usuarios/usuarios.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <script src="../js/nifty.min.js"></script>
	  <script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../plugins/bootstrap-dataTables/jquery.dataTables.js"></script>
    <script src="../js/global/funciones-global.js"></script>
    <script src="../plugins/Chart.js/Chart.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        
        $("#FiltrarPorFecha").click(function(){
            var startDate = $("input[name='start']").val();
            var endDate = $("input[name='end']").val();
            if((startDate == "") || (endDate == "")){
                bootbox.alert("Debe seleccionar un rango de fecha valido");
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/FiltrarFecha.php",
                dataType: "html",
                data: {
                    startDate: startDate,
                    endDate: endDate,
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    if(data != ""){
                        $("select[name='Perfil']").html(data);
                        $("select[name='Perfil']").prop("disabled",false);
                        $("select[name='Perfil']").selectpicker('refresh');
                    }else{
                        $("select[name='Perfil']").html(data);
                        $("select[name='Perfil']").prop("disabled",true);
                        $("select[name='Perfil']").selectpicker('refresh');
                        bootbox.alert("No se consiguieron pruebas comprendidas entre las fechas "+startDate+" y "+endDate);
                    }
                },
                error: function(){
                }
            });
        });
        $("select[name='Perfil']").change(function(){
            var startDate = $("input[name='start']").val();
            var endDate = $("input[name='end']").val();
            var Perfil = $(this).val();
            $.ajax({
                type: "POST",
                url: "ajax/FiltrarPerfil.php",
                dataType: "html",
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    perfil: Perfil,
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    if(data != ""){
                        $("select[name='Aspirante']").html(data);
                        $("select[name='Aspirante']").prop("disabled",false);
                        $("select[name='Aspirante']").selectpicker('refresh');
                    }
                    
                },
                error: function(){
                }
            });
        });
        var CalificationTable;
        $("select[name='Aspirante']").change(function(){
            var CalificationsArray = [];
            var startDate = $("input[name='start']").val();
            var endDate = $("input[name='end']").val();
            var Perfil = $("select[name='Perfil']").val();
            var Aspirante = $(this).val();
            $.ajax({
                type: "POST",
                url: "ajax/getCalifications.php",
                dataType: "html",
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    perfil: Perfil,
                    aspirante: Aspirante,
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    CalificationsArray = JSON.parse(data);
                    CalificationTable = $('#Calificaciones').DataTable({
                        data: CalificationsArray,
                        "bDestroy": true,
                        columns: [
                            { data: 'NombreCompleto' },
                            { data: 'PromedioCalificacion' },
                            { data: 'PromedioCalificacionMinima' },
                            { data: 'Grafico' }
                        ],
                        "columnDefs": [ 
                            {
                                "targets": 3,
                                "searchable": false,
                                "data": "Grafico",
                                "render": function( data, type, row ) {
                                    return "<div style='text-align: center;' id="+data+"><i style='cursor: pointer; margin: 0 10px;' class='psi-bar-chart-4 icon-lg ShowGraph'></i></div>";
                                }
                            },
                        ]
                    });
                    $("#ResultTables").show();
                },
                error: function(){
                }
            });
        });
        $("body").on("click",".ShowGraph",function(){
            var ObjectMe = $(this);
            var ObjectDiv = ObjectMe.closest("div");
            var Prueba = ObjectDiv.attr("id");
            $.ajax({
                type: "POST",
                url: "ajax/getGraphData.php",
                dataType: "html",
                data: {
                    prueba: Prueba
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#ChartContainer").find("iframe").remove();
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    var json = JSON.parse(data);
                    var data = {
                        labels: json.Preguntas,//["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                        datasets: [
                            {
                                label: "Calificación Obtenida",
                                backgroundColor: "rgba(0,0,255,0.2)",
                                borderColor: "rgba(0,0,255,1)",
                                pointBackgroundColor: "rgba(0,0,255,1)",
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "rgba(0,0,255,1)",
                                data: json.Calificacion//[65, 59, 90, 81, 56, 55, 40]
                            },
                            {
                                label: "Calificación Minima",
                                backgroundColor: "rgba(255,99,132,0.2)",
                                borderColor: "rgba(255,99,132,1)",
                                pointBackgroundColor: "rgba(255,99,132,1)",
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "rgba(255,99,132,1)",
                                data: json.CalificacionMinima//[28, 48, 40, 19, 56, 27, 73]
                            }
                        ]
                    };
                    var ctx = document.getElementById("radarChart").getContext("2d");
                    new Chart(ctx, {
                        type: "radar",
                        data: data,
                        options: {
                            pointLabel: {
                                fontSize: 0
                            },
                            scale: {
                                reverse: false,
                                ticks: {
                                    beginAtZero: true,
                                    display: false
                                }
                            }
                        }
                    });
                },
                error: function(){
                }
            });
        });
    });
</script>