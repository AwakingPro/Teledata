<?PHP
//$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
//mysql_select_db("foco",$conexion);
include("../class/global/global.php");
require_once('../db/db.php');
require_once('../class/session/session.php');
$objetoSession = new Session('1,2',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "est,cci"));
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
        <!--Chosen [ OPTIONAL ]-->


    <!--noUiSlider [ OPTIONAL ]-->
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
	height: 31px;
	border: 1px solid #CDD6E2;
	background-color: #FAFAFA;
	padding-left: 12px;
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
    .condicion_oculta
           {
            display: none;
           }

		  .canvasjs-chart-credit {
   display: none;
}
#bell
{
    display: none;
}


    </style>
        <script src="../js/jquery-2.2.1.min.js"></script>

    <script language="javascript">
var timestamp = null;
function cargar_push()
{
    $.ajax({
    async:  true,
    type: "POST",
    url: "httpush.php",
    data: "&timestamp="+timestamp,
    dataType:"html",
    success: function(data)
    {
        var json           = eval("(" + data + ")");
        timestamp          = json.timestamp;
        mensaje            = json.mensaje;
        id                 = json.id;
        status             = json.status;
        tipo           = json.tipo;

        if(timestamp == null)
        {

        }
        else
        {
            $.ajax({
            async:  true,
            type: "POST",
            url: "mensajes.php",
            data: "",
            dataType:"html",
            success: function(data)
            {
                console.log(data);
                if(data == 2)
                {
                    $('#bell').hide();
                }
                else
                {
                    $('#bell').show();


                }
            }
            });
        }
        setTimeout('cargar_push()',1000);

    }
    });
}

$(document).ready(function()
{
    cargar_push();
});

</script>
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


							<div class="col-sm-12 eq-box-sm">

								<!--Panel with Header-->
								<!--===================================================-->
                                <div class="panel" id='padre'>
									<div class="panel-heading">
									 <h2 class="panel-title"> Crear Condiciones para IVR</h2>
									</div>

									<div class="panel-body">
                                    <?php $colores = mysql_query("SELECT * FROM SIS_Colores");
                                    $cantidad_colores = mysql_num_rows($colores);
                                    if($cantidad_colores>0)
                                    {
                                    ?>
                                        <!--Nivel-->
                                        <div id="id_clases"><input type='hidden' value='1' id='id_clases' name='id_clases'></div>
                                        <div id="divnivel"><input type="hidden" value="0" id="nivel" name="nivel"></div>
                                        <div id="clasesnivel"></div>

                                        <!--End Tabla-->
                                        <!--Columna-->
                                   <form action="" id="categoria_ivr" method="post">
                                        <div class="col-sm-2">
                                            <label class="control-label">Asignar Categoría</label>
                                            <select class="selectpicker"  name="color" id="color" data-width="100%">
                                              <?php $result1=mysql_query("SELECT * FROM SIS_Colores");
                                        while($row=mysql_fetch_array($result1))
                                        { ?>

                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                         <?php } ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                        <label class="control-label">Tipo Contacto</label>
                                             <select class="selectpicker" multiple name="tipo_contacto" id="tipo_contacto" data-width="100%">
                                        <?php $result=mysql_query("SELECT * FROM Tipo_Contacto WHERE mundo = 2");
                                        while($row=mysql_fetch_array($result))
                                        { ?>

                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                         <?php } ?>
                                        </select>

                                        </div>
                                    <div class="col-sm-1">
                                        	<label class="control-label">Días atras : </label>
                                            <input type="number" name="dias" id="dias" class="text1">
                                     </div>
                                      <div class="col-sm-1">
                                                <label class="control-label">Condición</label>
                                            <select class="selectpicker"  name="cond1" id="cond1" data-width="100%">
                                                <option value=1>Menor</option>
                                                <option value=2>Menor o Igual</option>
                                                <option value=3>Igual</option>
                                                <option value=4>Mayor</option>
                                                <option value=5>Mayor o Igual</option>
                                            </select>
                                       </div>
                                     <div class="col-sm-1">
                                        	<label class="control-label">Cantidad </label>
                                            <input type="number" name="cant1" id="cant1" class="text1">
                                       </div>
                                       <div class="col-sm-1">
                                                <label class="control-label">Lógica</label>
                                            <select class="selectpicker"  name="logica" id="logica" data-width="100%">
                                                <option value=1>N/A</option>
                                                <option value=2>Y</option>
                                                <option value=3>O</option>

                                            </select>
                                       </div>
                                       <div class="col-sm-1">
                                                <label class="control-label">Condición</label>
                                            <div class="condicion_ver">
                                            <select class="selectpicker"  disabled="disabled"  data-width="100%">
                                                <option value=0>Menor</option>
                                            </select>
                                            </div>
                                            <div class="condicion_oculta">
                                             <select class="selectpicker"  class="text2" name="cond2" id="cond2" data-width="100%">
                                                <option value=1>Menor</option>
                                                <option value=2>Menor o Igual</option>
                                                <option value=3>Igual</option>
                                                <option value=4>Mayor</option>
                                                <option value=5>Mayor o Igual</option>

                                            </select>
                                            </div>
                                       </div>
                                     <div class="col-sm-1">
                                            <label class="control-label">Cantidad </label>
                                            <div class="condicion_ver">
                                            <input type="number" disabled="disabled" class="text1">
                                            </div>
                                            <div class="condicion_oculta">
                                            <input type="number"  name="cant2" id="cant2" class="text1">
                                            </div>
                                       </div>

                                          <div class="col-sm-1">
                                                <label class="control-label">Escribible</label>

                                            <select class="selectpicker "  name="w" id="w" data-width="100%">
                                                <option value=1>Si</option>
                                                <option value=2>No</option>
                                            </select>
                                       </div>
                                       <div class="col-sm-2">
                                       <input type="hidden" name='mundo' value='2' id='mundo'>
                                       <input type="submit" class="btn btn-primary btn-block" value="Crear ">

                                       </div>
                                      </form>





                                    <!--End Columna-->
                                    <!--Logica-->
                                    <!--End Logica-->
                                    <!--Valor-->


								  </div>
                                  <?php $ver = mysql_query("SELECT  * FROM SIS_Categoria_Fonos WHERE sel = 0 AND mundo = 2");
                                                $contar = mysql_num_rows($ver);
                                                if($contar>0){
                                                ?>
                                  <div class="panel-heading">
									 <h2 class="panel-title"> Categorías IVR Creadas</h2>
									</div>
                                    <div class="panel-body">


                                                <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">ID Color</th>
                                                            <th class="text-xs"><center>Categoría</center></th>
                                                            <th class="text-xs"><center>Color</center></th>
                                                            <th class="text-xs"><center>Prioridad</center></th>
                                                            <th class="text-sm"><center>Tipo Contacto</center></th>
                                                            <th class="text-sm"><center>Dias Atras</center></th>
                                                            <th class="text-sm"><center>Condicion</center></th>
                                                            <th class="text-sm"><center>Cantidad</center></th>
                                                            <th class="text-sm"><center>Lógica</center></th>
                                                            <th class="text-sm"><center>Condición</center></th>
                                                            <th class="text-sm"><center>Cantidad</center></th>
                                                            <th class="text-sm"><center>Escribible</center></th>
                                                            <th class="text-sm"><center>Eliminar</center></th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $query_fonos = mysql_query("SELECT * FROM SIS_Categoria_Fonos WHERE sel = 0 AND mundo = 2");
                                                    while($row = mysql_fetch_array($query_fonos)){?>
                                                        <tr>
                                                            <td class="text-sm"><center><?php echo $row[1]; ?></center></td>
                                                            <td class="text-sm"><center><?php echo $row[12]; ?></center></td>
                                                            <td class="text-sm"><center><input type="text" readonly="readonly" style="background:<?php echo $row[11];?> ;width: 30px;" /></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { echo $row[17]; }?></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { echo $row[14]; }?></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { echo $row[4]; }?></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { if($row[5]==1){ echo "Menor";} elseif($row[5]==2){ echo "Menor o Igual"; } elseif($row[5]==3){ echo "Igual";} elseif($row[5]==4){ echo "Mayor";} elseif($row[5]==5){ echo "Mayor o Igual";} }?></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { echo $row[6]; }?></center></td>
                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { if($row[7]==1){ echo "N/A";} elseif($row[7]==2){  echo "Y";} elseif($row[7]==3){  echo "O";} }?></center></td>
                                                             <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { if($row[7]==1){ echo "--";} else { if($row[8]==1){ echo "Menor";} elseif($row[8]==2){ echo "Menor o Igual"; } elseif($row[8]==3){ echo "Igual";} elseif($row[8]==4){ echo "Mayor";} elseif($row[8]==5){ echo "Mayor o Igual";} } }?>

                                                             </center></td>


                                                            <td class="text-sm"><center><?php if($row[1]==0){ echo "--";} else { if($row[7]==1){ echo "--";} else { echo $row[9]; } }?></center></td>
                                                            <td class="text-sm"><center><?php  if($row[1]==0){ echo "--";} else { if($row[10]==1){ echo "<input type='checkbox'  disabled='disabled' checked>";} else{ echo "<input type='checkbox'  disabled='disabled'>";} }?></center></td>
                                                            <td><center><?php  if($row[1]==0){ echo "--";} else { if($row[13]==1){}else {?><a href="delete_color.php?id=<?php echo $row[0];?>"><i class='fa fa-trash'></i></a> <?php } }?></center></td>
                                                        </tr>
                                                    <?php }?>
                                                    </tbody>
                                                </table>



                                               </div>
                                              <div class="col-sm-2">

                                                <form action="#" id="javaIvr" method="POST">
                                               <input type="submit" class="btn btn-primary btn-block" value="Procesar ">
                                               </form>

                                            </div>




                                  <?php } else {}?>
                                    <?php } else { echo "Debe Crear un color primero";}

                                  ?>

                           </div>
                           </form>
								<!--===================================================-->
								<!--End Panel with Header-->

							</div>

								<!--Panel with Header-->
								<!--===================================================-->
							</div>



                                            <div id='guardar'>
                                             <div class="col-sm-3">
                                            <form action="#" method="POST" name="refrescar" id="refrescar">
                                             <input type="submit" class="btn btn-primary btn-block col-sm-3" value="Guardar Estrategia">
                                             </form>
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

<?php unset($id_estrategia);
unset($_POST['id_estrategia']);?>
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
    <script src="../js/funciones.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <script src="../js/nifty.min.js"></script>
	<script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
     <!--Flot Pie Chart [ OPTIONAL ]-->
      <!--Gauge js [ OPTIONAL ]-->


    <!--Easy Pie Chart [ OPTIONAL ]-->
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>
    <script src="../plugins/chosen/chosen.jquery.min.js"></script>
    <script src="../js/demo/ui-modals.js"></script>
    <script src="../js/global.js"></script>
    <script src="../js/global/funciones-global.js"></script>


</body>
</html>
