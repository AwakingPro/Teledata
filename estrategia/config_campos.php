<?php
require_once('../db/db.php');
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "adm,sis,config_cp"));
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
    <link href="../plugins/bootstrap-dataTables/jquery.dataTables.css" rel="stylesheet"  media="screen">
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
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
<?php
if (isset($_SESSION['cedente'])){
    $cedente = $_SESSION['cedente'];
}
?>
  <input type="hidden" name="cedente" id="cedente" value="<?php echo $cedente;?>">
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
            <li class="active">Configuración Campos</li>
          </ol>
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <!--End breadcrumb-->
          <!--Page content-->
          <!--===================================================-->
          <div id="page-content">
            <div class="row">
						  <div class="eq-height">
  						  <div class="col-sm-12 eq-box-sm">
                  <div id="contenedor"></div>
                    <div class="panel" id='sql'>
                      <div class="panel-heading">
                        <h2 class="panel-title"> <i class="fa fa-pencil-square-o"></i> Configuración </h2>
                      </div>
                      <!-- Panel model -->
                      <!--===================================================-->
                      <div class="panel-body">
                        <div class="col-sm-12">
                        <!-- INICIO CONTENIDO PRINCIPAL -->
                           <!-- Inicio listar tablas -->
                            <div class="table-responsive">
                                <table id="listaTablas" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:90%">Tabla</th>
                                            <!-- <th>Campos</th> -->
                                            <th style="width:10%">Acción</th>
                                        </tr>
                                    </thead>
                                 </table>
                            </div>
                           <!-- Fin listar tablas -->
                           <!-- Inicio Asignar tablas al cedente (Registrar tabla y campos) -->
                          <script id="configurarCampos" type="text/template">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-sm-3">
                                  <div class="form-group" id="nomtabla">
                        
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <button class="btn btn-success btn-block agregarCampo">Agregar campos</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                <!-- Inicio configurar campos -->
                                <div class="table-responsive">
                                    <table id="listaCampos" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Campo</th>
                                                <th style="width:12%">Tipo dato</th>
                                                <th style="width:10%">Orden</th>
                                                <th style="width:12%">Logica</th>
                                                <th style="width:10%">Eliminar</th>
                                            </tr>
                                        </thead>
                                     </table>
                                </div>
                                <!-- Fin configurar campos -->
                                </div>
                              </div>

                              <br><br><br><br><br>

                             </div>
                           </script>
                          <!--  Fin Asignar tablas al cedente (Registrar tabla y campos) -->
                           <!-- Inicio combo campos -->
                          <script id="listaCamposNoConfigurados" type="text/template">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-sm-3">
                                  <div class="form-group" id="nomtabla2">
                            
                                  </div>
                                </div>                                
                              </div>                   
                             </div>
                             <div class="col-md-12">
                             <!--<div class="col-sm-6">
                                </div> -->
                                <div class="col-md-12">
                                <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <select class="selectpicker" id="campoBD" name="campoBD" data-live-search="true" data-width="100%">
                                         <option value="5">Holaaaaa</option>
                                    </select>
                                  </div>
                                </div>
                                 <div class="col-sm-3"></div>
                                </div>
                                </div>
                             </div>
                           </script>
                          <!--  Fin combo campos -->
                        <!-- FIN CONTENIDO PRINCIPAL -->
                        </div>
                      </div>
                      <!--===================================================-->
      								<!--End Panel model-->
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
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
    <script src="../js/jquery-2.2.1.min.js"></script>
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
    <script src="../js/estrategia/config_campos.js"></script>

</body>
</html>
