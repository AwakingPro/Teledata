<?php
    require_once('../db/db.php');
    include("../class/global/global.php");
    require_once('../class/session/session.php');
    $objetoSession = new Session('5',false); // 1,4
    //Para Id de Menu Actual (Menu Padre, Menu hijo)
    $objetoSession->crearVariableSession($array = array("idMenu" => "rec,asp"));
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
                        <h2 class="panel-title">Lista de Pruebas Activas</h2>
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-success" id="CrearPrueba">Crear Pruebas</button>
                        <br>
                        <br>
                        <table id="ListaPruebas">
                            <thead>
                                <th>Nombre</th>
                                <th>Perfil</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
        <script id="CrearPruebaTemplate" type="text/template">
            <div class="row">
                <div class="cols-sm-6 col-sm-offset-2">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Aspirantes:</label>
                            <select class="selectpicker form-control" name="Aspirante" title="Seleccione" data-live-search="true" data-width="100%"></select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Perfiles:</label>
                            <select class="selectpicker form-control" name="Perfil" title="Seleccione" data-live-search="true" data-width="100%"></select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Tests:</label>
                            <select class="selectpicker form-control" name="Test" title="Seleccione" data-live-search="true" data-width="100%"></select>
                        </div>
                    </div>
                </div>
            </div>
        </script>
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
</body>
</html>
<script>
    $(document).ready(function(){
        var PruebasArray = [];
        getPruebasList();

        $("#CrearPrueba").click(function(){
            var Template = $("#CrearPruebaTemplate").html()
            bootbox.dialog({
                title: "ASIGNACION DE PRUEBA DE RECLUTAMIENTO",
                message: Template,
                buttons: {
                    confirm: {
                        label: "Asignar",
                        callback: function() {
                            CrearPruebaReclutamiento();
                        }
                    }
                }
            }).off("shown.bs.modal");
            $(".selectpicker").selectpicker('refresh');
            fillAspirantes();
            fillPerfiles();
            fillTests();
        });
        function getPruebasList(){
            $.ajax({
                type: "POST",
                url: "ajax/getPruebasList.php",
                dataType: "html",
                data: {
                    
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    PruebasArray = [];
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    PruebasArray = JSON.parse(data);
                    updatePruebasTable();
                },
                error: function(){
                }
            });
        }
        function updatePruebasTable(){
            PruebaTable = $('#ListaPruebas').DataTable({
                data: PruebasArray,
                "bDestroy": true,
                columns: [
                    { data: 'Nombre' },
                    { data: 'Perfil' },
                    { data: 'Correo' },
                    { data: 'Telefono' },
                    { data: 'Acciones' }
                ],
                "columnDefs": [ 
                    {
                        "targets": 4,
                        "searchable": false,
                        "data": "Acciones",
                        "render": function( data, type, row ) {
                            return "<div style='text-align: center;' id="+data+"><i style='cursor: pointer; margin: 0 10px;' class='fa fa-times-circle icon-lg Delete'></i><i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil Update'></i></div>";
                        }
                    },
                ]
            });
        }
        function fillAspirantes(){
            $.ajax({
                type: "POST",
                url: "ajax/getAspirantesList.php",
                dataType: "html",
                data: {
                    
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    $("select[name='Aspirante']").html(data);
                    $("select[name='Aspirante']").selectpicker('refresh');
                },
                error: function(){
                }
            });
        }
        function fillPerfiles(){
            $.ajax({
                type: "POST",
                url: "ajax/getPerfilesList.php",
                dataType: "html",
                data: {
                    
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    $("select[name='Perfil']").html(data);
                    $("select[name='Perfil']").selectpicker('refresh');
                },
                error: function(){
                }
            });
        }
        function fillTests(){
            $.ajax({
                type: "POST",
                url: "ajax/getTestList.php",
                dataType: "html",
                data: {
                    
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    $("select[name='Test']").html(data);
                    $("select[name='Test']").selectpicker('refresh');
                },
                error: function(){
                }
            });
        }
        function CrearPruebaReclutamiento(){
            var idUsuario = $("select[name='Aspirante']").val();
            var idPerfil = $("select[name='Perfil']").val();
            var idTest = $("select[name='Test']").val();
            
            $.ajax({
                type: "POST",
                url: "ajax/crearPrueba.php",
                dataType: "html",
                data: {
                    idUsuario: idUsuario,
                    idPerfil: idPerfil,
                    idTest: idTest
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    var json = JSON.parse(data);
                    if(json.result == "1"){
                        location.reload();
                    }
                },
                error: function(){
                }
            });
        }
    });
</script>