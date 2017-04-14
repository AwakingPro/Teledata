<?PHP
require_once('../db/db.php');
include("../class/crm/crm.php");
require_once('../class/session/session.php');
include("../class/global/global.php");
$objetoSession = new Session('1,3,4,2',false);
$objetoSession->crearVariableSession($array = array("idMenu" => "gra,gra_son"));
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    $objetoSession->logoutGoTo("../index.php");
}
$objetoSession->creaMM_restrictGoTo();
$usuario = $_SESSION['MM_Username'];
$id_dial = $_SESSION['id'];
$nombre_usuario = '';
$validar = $_SESSION['MM_UserGroup'];
$cedente = $_SESSION['cedente'];
$q = mysql_query("SELECT nombre FROM Usuarios WHERE usuario = '$usuario' LIMIT 1");
while($r = mysql_fetch_array($q))
{
    $nombre_usuario = $r['0'];
}
$user_dial = $_SESSION['user_dial'];
$pass_dial = $_SESSION['pass_dial'];
$sumas = $_SESSION['suma'];

unset($_SESSION['correos']);
unset($_SESSION['correos_cc']);
unset($_SESSION['mfacturas']);
unset($_SESSION['suma']);

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
    <link href="../css/multiple.css" rel="stylesheet"/>
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../css/global/global.css" rel="stylesheet">
     <link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
     <link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    <style type="text/css">
    .select1
    {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        border-width: thin;
        background-color: #FFF;
    }
    .select2
    {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        border-width: thin;
        background-color: #F6F6F6;
    }

    #oculto
    {
        display: none;
    }
    #colas_mostrar
    {
        display: none;
    }
    #colas_mostrar2
    {
        display: none;
    }
    #mostrar_rut
    {
        display: none;
    }
    #respuesta_rapida
    {
        display: none;
    }
    #script_cobranza_mostrar
    {
        display: none;
    }
    #busqueda_estrategia
    {
        display: none;
    }
    #busqueda_rut
    {
        display: none;
    }
    .adjuntar_boton {
    min-width: 30%;
    max-width: 30%;
    }
    #timer{margin:30px auto 0;width:100%;}
    #timer .container{display:table;background:#585858;color:#eee;font-weight:bold;width:100%;text-align:center;text-shadow:1px 1px 4px #999;}
    #timer .container div{display:table-cell;font-size:20px;padding:10px;width:10px;}
    #timer .container .divider{width:5px;color:#ddd;}
    .text6
    {
        width: 180px;
        height: 30px;
        border: none;
        text-align: center;
        background-color:transparent;
        text-align: left;
    }
    .fa-file-pdf-o
    {
        color: #FF4000;
    }
</style>
</head>
<body>
<input type="hidden" id="id_dial"  name="id_dial" value="<?php echo $id_dial; ?>">
<input type="hidden" id="prefijo"  name="prefijo" value="">
<input type="hidden" id="idc"  name="idc" value="0">
<input type="hidden" id="cedente"  name="cedente" value="0">
<input type="hidden" id="cortar_valor"  name="cortar_valor" value="0">
<input type="hidden" id="rut_ultimo"  name="rut_ultimo" value="0">
<input type="hidden" id="fono_discado"  name="fono_discado" value="0">
<input type="hidden" id="ultimo_fono"  name="ultimo_fono" value="0">
<input type="hidden" id="duracion_llamada"  name="duracion_llamada" value="0">
<input type="hidden" id="user_dial"  name="user_dial" value="<?php echo $user_dial;?>">
<input type="hidden" id="pass_dial"  name="pass_dial" value="<?php echo $pass_dial;?>">
<input type="hidden" id="nombre_usuario_foco"  name="nombre_usuario_foco" value="<?php echo $nombre_usuario;?>">
    <div id="container" class="effect mainnav-sm">
      <!--NAVBAR-->
      <!--===================================================-->
      <?php
      include("../layout/header.php");
      ?>
      <!--===================================================-->
      <!--END NAVBAR-->
        <div class="boxed">
            <div id="content-container">
                <div id="page-title">
                </div>
                <div id="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary">Seleccione Grafico</h3>
                                </div>
                                <div class="panel-body ">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sel1">Seleccione Cedente</label>
                                            <select class="form-control ChartTortaSelector" id="seleccione_cedente">
                                            <option value="0">Seleccionar</option>
                                            <?php
                                                $qc = mysql_query("SELECT Id_Cedente , Nombre_Cedente FROM Cedente  ORDER BY Nombre_Cedente ASC");
                                                while($r = mysql_fetch_array($qc))
                                                 { ?>
                                                <option value="<?php echo $r[0]?>"><?php echo $r[1]?></option>
                                                 <?php }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div id = "div1">
                                                <label for="sel1">Seleccione Estrategia</label>
                                                <select class="form-control ChartTortaSelector" disabled="disabled" >
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div id = "div2">
                                                <label for="sel1">Seleccione Cola</label>
                                                <select class="form-control ChartTortaSelector" disabled="disabled">
                                                    <option value="0">Seleccione Cola</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sel1">Seleccione Rango Fecha</label>
                                            <select class="form-control ChartTortaSelector" id="seleccione_periodo">
                                                <option value="0">Seleccione</option>
                                                <option value="1">Periodo</option>
                                                <option value="2">Historica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary">Grafico Tabla</h3>
                                </div>
                                <div class="panel-body ">
                                    <div id="grafico"></div>
                                    <input type="hidden" id='remover4' value=''>
                                    <input type="hidden" id='remover5' value=''>
                                    <input type="hidden" id='remover6' value=''>
                                    <input type="hidden" id='tipo' value='1'>
                                    <input type="hidden" id='id_gestion' value='0'>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary">Graficos Torta</h3>
                                </div>
                                <div class="panel-body ">
                                    <div id="demo-flot-donut" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary"><a href="#" class='fa fa-file-excel-o'>Exportar Tabla</a></h3>
                                </div>
                                <div class="panel-body ">
                                 <div class="" id="detalle">
                                 Seleccione Fuente de Datos.
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <?php include("../layout/main-menu.php"); ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->



    </div>

        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">
            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pull-right">
                <ul class="footer-list list-inline">
                </li>
                </ul>
            </div>

        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->
        <!-- SCROLL TOP BUTTON -->
        <!--===================================================-->
        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
        <div class="modal"><!-- Place at bottom of page --></div>
        <!--===================================================-->


    <!--===================================================-->

    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
   <script src="../js/jquery-2.2.1.min.js"></script>
    <script src="../js/crm/crm2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <script src="../js/nifty.min.js"></script>
	<script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../plugins/chosen/chosen.jquery.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>
    <script src="../plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../js/demo/ui-modals.js"></script>
    <!--Demo script [ DEMONSTRATION ]-->
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../js/global/funciones-global.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.min.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.min.js"></script>
                        <!--Flot Pie Chart [ REQUIRED ]-->
    <script src="../plugins/flot-charts/jquery.flot.pie.min.js"></script>
      <script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
     <script src="../js/demo/tables-datatables.js"></script>
    <script src=" https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <!--Charts [ SAMPLE ]-->
    <script src="../js/global.js"></script>
</body>
</html>
