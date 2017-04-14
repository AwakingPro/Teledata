<?PHP
//$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
//mysql_select_db("foco",$conexion);
include("../class/global/global.php");
require_once('../db/db.php');
if (!isset($_SESSION))
{
    session_start();
}

//Para Id de Menu Actual (Menu Padre, Menu hijo)
$_SESSION['idMenu'] = "est,cco";

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != ""))
{
    $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);
    $logoutGoTo = "../../index.php";
    if ($logoutGoTo)
    {
        header("Location: $logoutGoTo");
        exit;
    }
}

if (!isset($_SESSION))
{
    session_start();
}
$MM_authorizedUsers = "1,2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup)
{
    $isValid = False;
    if (!empty($UserName))
    {
        $arrUsers = Explode(",", $strUsers);
        $arrGroups = Explode(",", $strGroups);
        if (in_array($UserName, $arrUsers))
        {
            $isValid = true;
        }
    // Or, you may restrict access to only certain users based on their username.
        if (in_array($UserGroup, $arrGroups))
        {
            $isValid = true;
        }
        if (($strUsers == "") && false)
        {
            $isValid = true;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = "../../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']))))
{
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
    $MM_referrer .= "?" . $QUERY_STRING;
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo);
    exit;
}
$usuario = $_SESSION['MM_Username'];
$cedente = $_SESSION['cedente'];
$sql="SELECT * FROM SIS_Tablas WHERE view=1 order by id asc";
$res=mysql_query($sql);
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
        display: none;
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
    .modal
    {
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
  <input type="hidden" id="cedente" value="<?php echo $cedente; ?>">
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
                    <li><a href="#">Estrategia</a></li>
                    <li class="active">Crear Estrategia</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->




                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					<div class="row">
						<div class="eq-height">




								<!--Panel with Header-->
								<!--===================================================-->
							<div class="col-sm-12 eq-box-sm">
                                                                <div id="contenedor"></div>

                                <div id="mostrar_estrategia">
                                    <div class="panel" id='sql'>
                                            <div class="panel-heading">
                                              <h2 class="panel-title"> <i class="fa fa-pencil-square-o"></i> Nueva Categoria </h2>
                                            </div>
                                                <div class="panel-body">
                                                 <form id="crear_categoria" autocomplete="off" name="crear_categoria" action="#" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                              <label for="sel1">Seleccione Color</label>
                                                              <br>
                                                              <input type="color" name="color" id="color" >

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                             <label class="control-label">Nombre Categoria</label>
                                                             <input type="text" name="nombre" id="nombre" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                             <label class="control-label">Comentario</label>
                                                             <input type="text" name="comentario" id="comentario" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                             <input type="submit" class="btn btn-primary btn-block" value="Crear Color">
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </form>
                                                </div>
                                                <div class="panel-heading">
                                     <h2 class="panel-title"> Colores Creados</h2>
                                    </div>
                                                 <div class="panel-body">

                                     <div class="tab-content">
                                        <div class="tab-pane fade in active" id="demo-tabs-box-1">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">Color</th>
                                                            <th class="text-xs">Nombre</th>
                                                            <th class="text-sm">Comentario</th>

                                                            <th class="text-sm">Eliminar</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $query_color = mysql_query("SELECT * FROM SIS_Colores");
                                                    while($row = mysql_fetch_array($query_color)){?>
                                                        <tr>
                                                            <td class="text-sm"><input type="text" style="background:<?php echo $row[2];?> ;width: 30px;" /></td>
                                                            <td class="text-sm"><?php echo $row[1]; ?></td>
                                                            <td class="text-sm"><?php echo $row[3]; ?></td>
                                                            <td><center><a href="delete_colores.php?id=<?php echo $row[0];?>"><i class='fa fa-trash'></i></a></center></td>
                                                        </tr>
                                                    <?php }?>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                             </div>

								<!--===================================================-->
								<!--End Panel with Header-->

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
    <script src="../js/funciones.js"></script>
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
    <script src="../js/global.js"></script>
    <script src="../js/global/funciones-global.js"></script>
</body>
</html>
