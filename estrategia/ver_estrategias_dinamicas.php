<?PHP
require_once('../db/db.php');
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1,2',false);
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
$cedente = $_SESSION['cedente'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$id_estrategia = $_GET['id_estrategia'];
$idUsuarioLogin = $_SESSION['id_usuario'];

$sql=mysql_query("SELECT nombre, id_usuario FROM SIS_Estrategias WHERE id=$id_estrategia AND Id_Cedente = $cedente ");
$query_row=mysql_query("SELECT * FROM SIS_Querys WHERE id_estrategia=$id_estrategia AND Id_Cedente = $cedente ");
while($row=mysql_fetch_array($sql))
{
    $nombre_estrategia = $row[0];
    $idUsuarioEstrategia = $row[1];
}
/**
  * Verifico sip el usuario conectado es el mismo que creo la estrategia
  * para asi dejarlo crear y deshacer, de lo contrario deshabilitar los botones
*/
if ($idUsuarioEstrategia == $idUsuarioLogin)
{
  $habilitado = "";
} else {
  $habilitado = "disabled='disabled'";
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/multiple.css" rel="stylesheet"/>
    <link href="../css/nifty.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <style type="text/css">
    .select1
             {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #FFFFFF;
    	border-width: 1px;

             }
    .select2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
		border-width: 1px;
        background-color: #CCC;

            }
    .text1
            {
        width: 100%;
        height: 30px;
        border: solid;
        background-color: #FFFFFF;
    	border-width: 1px;
		border-color: #ccc;

            }
	.text3
            {
	width: 100px;
	height: 30px;
	border: solid;
	border-width: 1px;
	border-color: #ccc;
	text-align: center;

            }
    .text6
            {
    width: 180px;
    height: 30px;
    border: none;
    text-align: center;
    background-color:transparent;
    text-align: left;


            }
    .text4
            {
    width: 30px;
    height: 30px;
    border: solid;
    border-width: 1px;
    border-color: #ccc;
    text-align: center;
            }
    .text2
            {
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
		border-width: 1px;
        background-color: #CCC;

            }
    .mostrar_condiciones
           {
           }
    #midiv99
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

    </style>
</head>
<body>

    <div id="container" class="effect mainnav-sm">
         <?php
        include("../layout/header.php");
        ?>
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
                    <li><a href="#">Estrategia</a></li>
                    <li class="active">Ver Estrategias</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->




                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <input type="hidden" id="IdCedente" value="<?php echo $_SESSION['cedente']; ?>">
					<div class="row">
                        <div class="col-sm-3">
                            <div class="panel">
                                <div class="panel-heading">
                                        <h2 class="panel-title"> <i class="fa fa-pagelines"></i> Estrategia Dinámica<?php echo $_SESSION['IdEstrategia']; ?> </h2>
                                </div>
                                <div class="panel-body">
                                    <div id="DivTabla">
                                    </div>
                                    <div id="DivColumna">
                                        <select class="selectpicker" disabled="disabled" data-width="100%">
                                            <option>Seleccione Columna</option>
                                        </select>
                                    </div>
                                    <div id="DivLogica">
                                        <select class="selectpicker" disabled="disabled" data-width="100%">
                                            <option>Seleccione Columna</option>
                                        </select>
                                    </div>
                                    <div id="DivValor">
                                        <select class="selectpicker" disabled="disabled" data-width="100%">
                                            <option>Seleccione Columna</option>
                                        </select>
                                    </div>
                                    <div id="DivCola">
                                        <input type="text" class="form-control" disabled="disabled">
                                    </div>
                                    <div id='DivBoton'>
                                        <br>
                                        <button class="btn btn-info col-sm-12" id="CrearEstrategia">Crear Estrategia</button>
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
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
    <script src="../js/jquery-2.2.1.min.js"></script>
    <script src="../js/estrategia/dinamica.js"></script>
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
    <script src="../js/global/funciones-global.js"></script>

</body>
</html>