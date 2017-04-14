<?php
require_once('../db/db.php');
/*include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('2',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "est,rpt"));
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
$cedente = $_SESSION['cedente'];*/
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
    <script>
            var timeout = setInterval(reloadDiv, 360000);    
            function reloadDiv() {
                $('#DivRefresh').load('ReporteActualizado.php');
            }
    </script>
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

          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <!--End breadcrumb-->
          <!--Page content-->
          <!--===================================================-->
          <div id="page-content">
            <div class="row">
                <div class="eq-height">
                    <div class="col-sm-12">
                        <div id="contenedor"></div>
                        <div class="panel">
                            <div class="panel-heading">
                                <h2 class="panel-title bg-success">Reporte Diario Ejecutivo</h2>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div id="DivRefresh">
                                    <table id="demo-dt-selection" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Campaña</th>
                                                <th>Nombre Ejecutivo</th>
                                                <th>Cantidad de Gestiones</th>
                                                <th>Compromisos</th>
                                                <th>Titular</th>
                                                <th>Tercero</th>
                                                <th>No Contesta</th>
                                                <th>Inubicable</th>
                                                <th>Otro</th>
                                            
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $Campanas  =mysql_query("SELECT campaign_id , campaign_name FROM vicidial_campaigns");
                                            while($row = mysql_fetch_array($Campanas)){
                                                $Id = $row[0];
                                                 $Name = $row[1];

                                                $QueryReportes = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad, nombre_ejecutivo FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND cedente = $Id GROUP BY nombre_ejecutivo");
                                                while($row = mysql_fetch_array($QueryReportes)){
                                                $Cantidad = $row[0];
                                                $Ejecutivo = $row[1];
                                                echo "<tr>";
                                                echo "<td>".$Name."</td>";
                                                echo "<td>".$Ejecutivo."</td>";
                                                echo "<td>".$Cantidad."</td>";
                                                $QueryTipo5 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 5 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo5)){
                                                    $Compromiso = $row[0];
                                                }
                                                $QueryTipo1 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 1 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo1)){
                                                    $Titular = $row[0];
                                                }
                                                $QueryTipo2 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 2 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo2)){
                                                    $Tercero = $row[0];
                                                }
                                                $QueryTipo3 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 3 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo3)){
                                                    $NoContesta = $row[0];
                                                }
                                                $QueryTipo4 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 4 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo4)){
                                                    $Inubicable = $row[0];
                                                }
                                                $QueryTipo = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 4 AND nombre_ejecutivo = '$Ejecutivo' AND cedente = $Id");
                                                while($row = mysql_fetch_array($QueryTipo)){
                                                    $Otro = $row[0];
                                                }
                                                
                                                
                                                echo "<td>".$Compromiso."</td>";
                                                echo "<td>".$Titular."</td>";
                                                echo "<td>".$Tercero."</td>";
                                                echo "<td>".$NoContesta."</td>";
                                                echo "<td>".$Inubicable."</td>";
                                                echo "<td>".$Otro."</td>";
                                                echo "</tr>";

                                                }

                                            }
                                            
                                        ?>    

                                        </tbody>
                                        </table>
                                   	
                            </div>
                                    
                                    
                                </div>
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
    <script src="../js/global/funciones-global.js"></script>
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.min.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.min.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.min.js"></script>
    <script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script src="../js/estrategia/reportes.js"></script>
</body>
</html>