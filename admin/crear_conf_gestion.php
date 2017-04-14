<?PHP
require_once('../db/db.php');
include("../class/admin/conf_gestion.php");
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1,4',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "adm,cpg"));
// ** Logout the current user. **
$objetoSession->creaLogoutAction(); // VERIFICAR FUNCIONAMIENTO DE ESTE METODO
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{ //
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    $objetoSession->logoutGoTo("../index.php");
}
$validar = $_SESSION['MM_UserGroup'];
$objetoSession->creaMM_restrictGoTo();
$usuario = $_SESSION['MM_Username'];
$cedente = $_SESSION['cedente'];
$nombreUsuario = $_SESSION['nombreUsuario'];
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
    <input type="hidden" id="cedente" value="<?php echo $cedente; ?>">
    <div id="container" class="effect mainnav-sm">

        <!--NAVBAR-->
        <!--===================================================-->
        <?php include("../layout/header.php"); ?>
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
                    <li class="active">Conf. Pantalla Gestión</li>
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


                            <div id="mostrar_estrategia">
                            <div class="panel" id='sql'>
                                    <div class="panel-heading">
                                      <h2 class="panel-title"> <i class="fa fa-pencil-square-o"></i> Nueva Configuración </h2>
                                    </div>
                                        <div class="panel-body">
                                 <form id="guardarConfig" autocomplete="off" name="guardarConfig" action="#" method="POST">
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                             <label class="control-label">Nombre Configuración</label>
                                             <input type="text" name="nombre_confi" id="nombre_confi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                              <label for="sel1">Cedente</label>
                                              <select  class="selectpicker" height="1" id="idCedente" name="idCedente" data-live-search="true" data-width="100%">
                                             <?php $result=mysql_query("SELECT Id_Cedente,Nombre_Cedente FROM Cedente ");
                                             while($row=mysql_fetch_array($result)){
                                             ?>
                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                              <?php }?>
                                              </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                             <label class="control-label">Tabla</label>
                                             <select class="selectpicker" id="nomTabla" name="nomTabla" data-live-search="true" data-width="100%">
                                            <option value="Deuda">Deuda</option>
                                            <option value="Persona">Persona</option>
                                             </select>

                                            </div>
                                        </div>
                                    </div>
                                     <div class="row"> <h5>Agregue Campos a Mostrar</h5>
<div id="divtablamed">
<table  class="table table-bordered" >
        <thead>
        <tr>
          <th class="col-sm-3">Nombre de Campo</th>
          <th class="col-sm-3">Encabezado de Columna</th>
          <th class="col-sm-3"></th>
        </tr>
      </thead>
      <tr id="colum1" class="colum1">
        <td>

            <?php
                $camposTabla = new ConfGestion();
                $camposTabla->listarCamposTabla("Deuda");
            ?>
            <div id="colum2" class="colum2">
            </div>
          </td>
        <td><input type="text" class="form-control" id="nombre0" name="nombre"  maxlength="15"></td>
        <td><button type="button" id="addfila" class="btn btn-default">Agregar Campo</button>
        </td>
      </tr>

    </table>
    </div>
<div id="divtablapeq">
    <table id="mitabla" class="table table-bordered mitabla" WIDTH="50%">
    <thead>
    <tr>
    <th class="col-sm-3">Campos Seleccionados</th>
    <th class="col-sm-3"></th>
    </tr>
    </thead>
    </table>
 </div>
         <button type="button" id="delfila" class="btn btn-default">Eliminar Campo</button>




                                     </div>
                                      <div class="row"> <br><br>
                                      </div>
                                       <div class="row"> <br><br>
                                       </div>

                                    <div class="row" >
                                        <div class="col-sm-3" >
                                            <div class="form-group" >
                                             <input type="submit" class="btn btn-primary btn-block" value="Guardar Configuración">
                                             <input type="button" class="btn btn-primary btn-block" value="Volver" onClick="location.href = 'conf_gestion.php' ">
                                            </div>

                                        </div>
                                    </div>
                      <div class="row">
                        <div class="col-xs-12">
                            <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
                            <div class="outer_div"></div><!-- Datos ajax Final -->
                        </div>
                     </div>

                                 </form>
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
    <script src="../js/admin/admin-funciones.js"></script>
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
