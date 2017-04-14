<?php
require_once('../db/db.php');
require_once('../class/session/session.php');
$objetoSession = new Session('1,3,4',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "gra,ges_dia"));
// ** Logout the current user. **
$objetoSession->creaLogoutAction(); // VERIFICAR FUNCIONAMIENTO DE ESTE METODO
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    $objetoSession->logoutGoTo("../index.php");
}
$validar = $_SESSION['MM_UserGroup'];
$objetoSession->creaMM_restrictGoTo();
$usuario = $_SESSION['MM_Username'];
$cedente = $_SESSION['cedente'];
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
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">
                        <img src="../img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Foco Estrategico </span>
                        </div>
                    </a>
                </div>
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="pli-view-list"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links pull-right">
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="boxed">
            <div id="content-container">
                <div id="page-title">
                </div>
                <div id="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary">Gestiones Por Ejecutivo Hoy</h3>
                                </div>
                                <div class="panel-body ">
                                  <div>
                                    <table id="t_gest_ejec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                          	        <thead>
                          	        <th class="text-sm"><center>Usuario</center></th>
                          	        <th class="text-sm"><center>Cantidad Gestiones</center></th>
                          	        <th class="text-sm"><center>Contacto Titular</center></th>
                          	        <th class="text-sm"><center>Contacto Tercero</center></th>
                          	        <th class="text-sm"><center>Administrativa</center></th>
                          	        <th class="text-sm"><center>Sin Contacto</center></th>
                          	        </thead>
                                    <tbody>
                                      <?php
                                        $q1 = mysql_query("SELECT DISTINCT nombre_ejecutivo FROM gestion_diaria ORDER BY nombre_ejecutivo ASC");
                                        $c = mysql_num_rows($q1);
                                        if ($c == 0) {
                                          echo "<tr>";
                                          echo '<td colspan="6" class="text-sm"><center>No se han realizado gestiones hoy</center></td>';
                                          echo "</tr>";
                                        }
                                        else {
                                          while($r = mysql_fetch_array($q1)){
                                            $qcg = mysql_query("SELECT fechahora FROM gestion_diaria WHERE nombre_ejecutivo = '$r[0]'");
                                            $gest_tot = mysql_num_rows($qcg);
                                            $qcg2 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion IN (1,5)");
                                            $gest_tit = mysql_num_rows($qcg2);
                                            $qcg3 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion = 2");
                                            $gest_ter = mysql_num_rows($qcg3);
                                            $qcg4 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion = 9");
                                            $gest_adm = mysql_num_rows($qcg4);
                                            $qcg5 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion IN (3,4)");
                                            $gest_sc = mysql_num_rows($qcg5);
                                            echo "<tr>";
                                            echo "<td class='text-sm'><center>$r[0]</center></td>";
                                            echo "<td class='text-sm'><center>$gest_tot</center></td>";
                                            echo "<td class='text-sm'><center>$gest_tit</center></td>";
                                            echo "<td class='text-sm'><center>$gest_ter</center></td>";
                                            echo "<td class='text-sm'><center>$gest_adm</center></td>";
                                            echo "<td class='text-sm'><center>$gest_sc</center></td>";
                                            echo "</tr>";
                                          }

                                      }?>
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel" id="demo-panel-collapse" class="collapse in">
                                <div class="panel-heading">
                                    <h3 class="panel-title bg-primary">Gestiones Por Cartera Hoy</h3>
                                </div>
                                <div class="panel-body ">
                                  <div>
                                    <table id="t_gest_ejec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                          	        <thead>
                          	        <th class="text-sm"><center>Cartera</center></th>
                          	        <th class="text-sm"><center>Cantidad Gestiones</center></th>
                          	        <th class="text-sm"><center>Contacto Titular</center></th>
                          	        <th class="text-sm"><center>Contacto Tercero</center></th>
                          	        <th class="text-sm"><center>Administrativa</center></th>
                          	        <th class="text-sm"><center>Sin Contacto</center></th>
                          	        </thead>
                                    <tbody>
                                    <?php
                                        $q1 = mysql_query("SELECT DISTINCT c.Nombre_Cedente,g.cedente FROM Cedente c, gestion_diaria g WHERE c.Id_Cedente = g.cedente ORDER BY c.Nombre_Cedente DESC");
                                        $c = mysql_num_rows($q1);
                                        if ($c == 0) {
                                          echo "<tr>";
                                          echo '<td colspan="6" class="text-sm"><center>No se han realizado gestiones hoy</center></td>';
                                          echo "</tr>";
                                        }
                                        else {
                                          while($r = mysql_fetch_array($q1)){
                                            $qcg = mysql_query("SELECT fechahora FROM gestion_diaria WHERE cedente = '$r[1]'");
                                            $gest_tot = mysql_num_rows($qcg);
                                            $qcg2 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE cedente = '$r[1]' and Id_TipoGestion IN (1,5)");
                                            $gest_tit = mysql_num_rows($qcg2);
                                            $qcg3 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE cedente = '$r[1]' and Id_TipoGestion = 2");
                                            $gest_ter = mysql_num_rows($qcg3);
                                            $qcg4 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE cedente = '$r[1]' and Id_TipoGestion = 9");
                                            $gest_adm = mysql_num_rows($qcg4);
                                            $qcg5 = mysql_query("SELECT fechahora FROM gestion_diaria WHERE cedente = '$r[1]' and Id_TipoGestion IN (3,4)");
                                            $gest_sc = mysql_num_rows($qcg5);
                                            echo "<tr>";
                                            echo "<td class='text-sm'><center>$r[0]</center></td>";
                                            echo "<td class='text-sm'><center>$gest_tot</center></td>";
                                            echo "<td class='text-sm'><center>$gest_tit</center></td>";
                                            echo "<td class='text-sm'><center>$gest_ter</center></td>";
                                            echo "<td class='text-sm'><center>$gest_adm</center></td>";
                                            echo "<td class='text-sm'><center>$gest_sc</center></td>";
                                            echo "</tr>";
                                          }
                                        }?>
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
        <!--MAIN NAVIGATION-->

        <?php include("../layout/main-menu.php"); ?>
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
</body>
</html>
