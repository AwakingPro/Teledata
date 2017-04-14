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
if(empty($id_estrategia))
{
    header("Location: ". $MM_restrictGoTo);
}
else
{}
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

include('test3.php');

//<------------------------------Consulta Tablas Vacias------------------------------->

//<------------------------------Consulta Tablas Vacias------------------------------->
$sql100="SELECT * FROM SIS_Tablas WHERE view=1 order by id asc";
$res=mysql_query($sql100);
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
                    <li class="active">Ver Estrategias</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->




                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					<div class="row">
						<div class="eq-height">


							<div class="col-sm-3 eq-box-sm">

								<!--Panel with Header-->
								<!--===================================================-->
                                <div class="panel" id='padre'>
									<div class="panel-heading">
									 <h2 class="panel-title"> <i class="fa fa-pagelines"></i> Árbol de Decisión <?php echo  $_SESSION['cedente']; ?></h2>
									</div>
									<div class="panel-body">
                                        <form name="form1"  id='form1' autocomplete="off" method='POST' action="ver.php">
                                        <!--Nivel-->
                                        <div id="id_clases"><input type='hidden' value='1' id='id_clases' name='id_clases'></div>
                                        <div id="divnivel"><input type="hidden" value="0" id="nivel" name="nivel"></div>
                                        <div id="clasesnivel"></div>

                                        <div id="estrategia"><input type='hidden' value='<?php echo $id_estrategia; ?>' id='id_estrategia' name='id_estrategia'></div>
                                        <input type='hidden' value='<?php echo $cedente; ?>' id='cedente' name='cedente'>

                                        <?php if(mysql_num_rows($query_row)>0){?>
                                        <div id="midiv200">
                                        <div class="alert alert-warning fade in">
                                        Registros : 0<br>
                                        Monto : $  0
                                        <!--End Nivel-->
                                        <!--Tabla-->
                                        </div>
                                        </div>
                                    <?php } else {?>
                                        <div id="midiv200">
                                        <div class="alert alert-warning fade in">
                                        Registros :  <?php
                                        $query_1=mysql_query("SELECT Rut FROM Persona WHERE 1 AND FIND_IN_SET('$cedente',Id_Cedente) ");

                                        $numero = mysql_num_rows($query_1);
                                        echo $numero = number_format($numero, 0, "", ".");

                                         ?><br>
                                        Monto :
                                        <?php
                                            $monto1 = mysql_query("SELECT Monto_Mora FROM Deuda WHERE Id_Cedente = $cedente");
                                            while($row=mysql_fetch_assoc($monto1))
                                              {
                                                $monto_1= $monto_1 + $row['Monto_Mora'];
                                              }
                                            echo $monto_1 = '$  '.number_format($monto_1, 0, "", ".");
                                        ?>
                                        <!--End Nivel-->
                                        <!--Tabla-->
                                        </div>
                                        </div>

                                        <?php }?>
                                        <div id="midiv101">
                                        </div>
                                         <div id="midiv99">
                                          <select  disabled="disabled" class="select2">
                                             <option value="">Seleccione Tabla</option>
                                         </select><br><br>

                                        </div>
                                        <div id="midiv100">

                                        <select name="tablas" id="tablas"  class="select1">
				                            <option value="0"><center>Seleccione Tabla</center></option>
				                            <?php while ($fila=mysql_fetch_array($res)){ ?>
					                        <option value="<?php echo $fila['id']?>"><center><?php echo $fila['nombre']?></center></option>
				                        <?php } ?>
		                                </select>	<br><br>
                                        </div>
                                        <!--End Tabla-->
                                        <!--Columna-->
                                    <div id="midiv">
                                        <select name="tablas" id="tablas"  disabled="disabled" class="select2">
	                                         <option value="">Seleccione Columna</option>
                                        </select>
                                    </div>
                                    <!--End Columna-->
                                    <!--Logica-->
                                    <br>
                                    <div id="midiv2">
			                            <select  class="select2" disabled="disabled">
	                                        <option value="">Seleccione Lógica</option>
                                        </select>
                                    </div>
                                    <!--End Logica-->
                                    <!--Valor-->
                                    <br>
                                    <div id="midiv3">
			                            <input type="text" value="  Ingrese Valor" disabled="disabled" class="text2" >
	                                </div>
                                    <!--End Valor-->

                                    <div id="midiv4">
                                    <br /><input type="text" id="nombre_nivel" value="  Nombre Cola" class="text2" name="nombre_nivel" disabled="disabled">
	                                </div>
                                     <div id="midiv5">
                                     <br><input type="submit" disabled="disabled" value="Crear Consulta " class="btn btn-primary btn-block" >
	                                </div>
                                    </form>
								  </div>
								</div>

								<!--===================================================-->
								<!--End Panel with Header-->

							</div>

								<!--Panel with Header-->
								<!--===================================================-->
							<div class="col-sm-9 eq-box-sm">
                                                                <div id="contenedor"></div>



                                <div class="mostrar_condiciones">
                                        <div class="panel" id='sql'>
    									    <div class="panel-heading">
    										  <h3 class="panel-title"><?php echo $nombre_estrategia; ?>
                                                <?php $q_est = mysql_query("SELECT * FROM SIS_Querys WHERE id_estrategia = $id_estrategia AND Id_Cedente = $cedente");
                                                $c = mysql_num_rows($q_est);
                                                if($c>0)
                                                {
                                                ?>
                                               <button id="deshacer" value="<?php echo $id_estrategia;?>" class="btn pull-right btn-default btn-icon icon-lg fa fa-mail-reply btn-danger" <?php echo $habilitado ?> ></button> <button id="refrescar" value="<?php echo $id_estrategia;?>" class="btn pull-right btn-default btn-icon icon-lg fa fa-refresh btn-primary"></button>
                                               <?php
                                               }
                                               else
                                               {

                                               }
                                               ?>

</h3>
    									    </div>
                                            <div class="panel-body">
                                            <div class="mostrar">
                                            </div>
                                            <div class="oculto">
                                            <?php $q_est = mysql_query("SELECT * FROM SIS_Querys WHERE id_estrategia = $id_estrategia AND Id_Cedente = $cedente");
                                            $c = mysql_num_rows($q_est);
                                            if($c>0)
                                            {
                                            ?>

    							              <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    								           <thead>
    									        <tr>
            										<th>Nombre de la Cola</th>
                                                    <th class="min-desktop"><center>Cantidad<br> Registros</center></th>
                                                    <th class="min-desktop"><center>Monto</center></th>
                                                    <th class="min-desktop"><center>Prioridad</center></th>
                                                    <th class="min-desktop"><center>Comentario</center></th>
            										<th class="min-desktop"><center>Sub Consulta</center></th>
                                                    <th class="min-desktop"><center>Terminal</center></th>
                                                    <th class="min-desktop"><center>Decargar <br></center></th>
    									        </tr>
    								           </thead>
    								          <tbody>
    									   <?php
                                                $contar = count($array_central);
                                                $i=0;
                                                while($i<$contar)
                                                    {
                                                        $arre = $array_central[$i];
                                                        $sq = mysql_query("SELECT * FROM SIS_Querys WHERE id=$arre AND Id_Cedente = $cedente ");
                                                        while($row4=mysql_fetch_array($sq))
                                                            {
                                                                $id = $row4[0];
                                            ?>
                                                    <tr id='<?php echo $id; ?>'>
                                                    <td><?php
                                                        $numeroEspacios = $row4[13]*5;
                                                        $folder = $row4[14];
                                                        $sub= $row4[15];
														$check= $row4[7];
                                                        $eliminar= $row4[16];
														$prioridad= $row4[17];
                                                        $f = 1;
                                                        $espacios = "&nbsp;";
                                                        while($f<$numeroEspacios)
                                                            {
                                                                $espacios = $espacios."&nbsp;";
                                                                $f++;
                                                            }
                                                        echo $espacios;
                                                        ?><?php if($folder==1){echo "<i class='fa fa-folder-open'></i>";}else{}?><i class='fa fa-folder-open' id="b<?php echo $id; ?>" style='display: none;'></i>
                                                        <input type="text" class="cambiar_cola text6"  value="<?php echo $row4[8];?>" name="cambiar_cola" id="cola<?php echo $id; ?>"></td>
                                                    <td><center><?php echo $row4[4];?></center></td>
                                                    <td><center><?php echo $row4[5];?></center></td>
                                                    <td>
                                                    <center>
                               <input type="text" class="cambiar_prioridad text4" value='<?php echo $prioridad;?>' name="prioridad" id="p<?php echo $id; ?>">


                                                    </center></td>
                                                     <td>
                                                    <center>
                               <input type="text" class="cambiar_comentario text3"  value="<?php echo $row4[18];?>" name="comentario" id="q<?php echo $id; ?>">

                                                    </center></td>
                                                    <td><center><?php if($sub==0){}else {?>
                                                            <a class='subestrategia_editar'  href='#'><i class='fa fa-sitemap fa-lg btn-success btn' <?php echo $habilitado; ?> id="d<?php echo $id; ?>"></i></a> <?php }?></center></td>
                                            <td><center>
                                            <?php if($check==1)
											{?>
                                            <input type="checkbox"  name="checkeo" class="checkeo" id="k<?php echo $id; ?>" checked>
                                            <?php } else {?>
                                            <input type="checkbox" name="checkeo" class="checkeo" id="k<?php echo $id; ?>">
											<?php }?>
                                            </center></td>
                                            <td><center><a href="download_rut.php?id=<?php echo $id; ?>"><i class='fa fa-download fa-lg btn-primary btn'></i></a></center></td>

                                                            </tr>
                                                        <?php }

                                                        $i++;
                                                    }
?>
    								          </tbody>
    							             </table>
                                             <?php
                                             }
                                             else
                                             {
                                                echo "Seleccione Estrategia desde la Base de Datos";
                                             }

                                             ?>

                                            </div>
                                            <div id='guardar'>
                                             <div class="col-sm-3">
                                            <form action="#" method="POST" name="refrescar" id="refrescar">
                                             <input type="submit" class="btn btn-primary btn-block col-sm-3" value="Guardar Estrategia">
                                             </form>
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
    <script src="../js/global/funciones-global.js"></script>

</body>
</html>
