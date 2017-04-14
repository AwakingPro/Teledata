<?php
require_once('../db/db.php');
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "adm,sis,usu"));
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
include("../includes/usuarios/datos_usuario.php");
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
    <style type="text/css">
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
        <div id="page-title"></div>
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
            <div class="eq-height">
              <div class="col-sm-12" id="Resultado">
                  <div class="col-sm-6">
                      <div class="panel">
                          <div class="panel-heading">
                              <h2 class="panel-title bg-primary">Datos Generales</h2>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input type="text" name="nombre_usu" id="nombre_usu" class="form-control" value="<?php echo $nombre_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="sel1">Cargo</label>
                                <input type="text" name="cargo_usu" id="cargo_usu" class="form-control" value="<?php echo $cargo_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" name="email_usu" id="email_usu" class="form-control" value="<?php echo $email_usu; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Usuario</label>
                              <input type="text" name="usuario_usu" id="usuario_usu" class="form-control" value="<?php echo $usuario_usu; ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="sel1">Contraseña</label>
                              <input type="password" name="password_usu" id="password_usu" class="form-control" value="<?php echo $password_usu; ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Nivel</label>
                              <select class="selectpicker" id="nivel_usu" name="nivel_usu" data-live-search="false" data-width="100%">
                                <option value = "<?php echo $nivelusu; ?>"><?php echo $nombreNivel;?></option>
                                <?php
                                  $sql2 = mysql_query("SELECT nombre, nivel FROM Roles ORDER BY nivel ASC");
                                  while($row2=mysql_fetch_array($sql2))
                                  {
                                  ?>
                                   <option value = "<?php echo $row2[1]; ?>"><?php echo $row2[0];?></option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">
                          <?php if ((($nivelusu == "2") or ($nivelusu == "4") or ($nivelusu == "6"))){
                                  $hidden = "";
                                }else {
                                  $hidden = 'hidden="hidden"';
                                }
                          ?>
                          <div class="form-group" id="selectorMandante" <?php echo $hidden; ?> >
                            <?php   ?>
                            <label class="control-label">Mandante</label>
                            <select name="id_mandante" id="id_mandante" class="selectpicker" data-width="100%">
                              <?php if ($idMandanteUsu <> "") { ?>
                              <option value = "<?php echo $idMandanteUsu; ?>"><?php echo $nomMandanteUsu;?></option>
                              <?php } ?>
                              <option value="">Seleccione</option>
                              <?php
                                              $sql = mysql_query("SELECT id,nombre FROM mandante ORDER BY nombre ASC");
                                              while($row=mysql_fetch_array($sql))
                                              {

                                              ?>
                              <option value = "<?php echo $row[0];?>"><?php echo $row[1];?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <?php if (($nivelusu == "4")){
                                  $hidden = "";
                                }else {
                                  $hidden = 'hidden="hidden"';
                                }
                          ?>
                          <div class="form-group" id="selectorCedente" <?php echo $hidden; ?> >
                            <label class="control-label">Cedente</label>
                              <select name="cedentes" id="cedentes" class="selectpicker" data-width="100%">
                                <?php if ($idCedenteUsu <> 0) { ?>
                                <option value = "<?php echo $idCedenteUsu; ?>"><?php echo $nomCedenteUsu;?></option>
                                <?php } ?>
                                <option value="0">Seleccione</option>
                                <?php
                                    $cedeMan = $objetoCedente->getCedentesMandante($idMandanteUsu);
                                    foreach($cedeMan as $cedeMans){
                                        if($cedeMans["idCedente"] != $idCedenteUsu){
                                            ?>
                                            <option value = "<?php echo $cedeMans["idCedente"];?>"><?php echo $cedeMans["NombreCedente"];?></option>
                                            <?php
                                        }
                                    } ?>
                              </select>
                          </div>
                        </div>

                      </div>

                      <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="sel1">Usuario Dial</label>
                          <input type="text"  id="usuarioDial_usu" class="form-control" value="<?php echo $usuarioDial_usu; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="sel1">Contraseña Dial</label>
                          <input type="password" name="passwordDial_usu" id="passwordDial_usu" value="<?php echo $passworDial_usu; ?>" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">

                        </div>
                      </div>
                    </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="panel">
                          <div class="panel-heading">
                              <h2 class="panel-title bg-primary">Domicilio</h2>
                          </div>
                          <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="control-label">Dirección</label>
                                <input type="text" name="direccion_usu" id="direccion_usu" class="form-control" value="<?php echo $direccion_usu; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="control-label">Región</label>
                                <input type="text" name="region_usu" id="region_usu" class="form-control" value="<?php echo $region_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="sel1">Ciudad</label>
                                <input type="text" name="ciudad_usu" id="ciudad_usu" class="form-control" value="<?php echo $ciudad_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="control-label">Comuna</label>
                                <input type="text" name="comuna_usu" id="comuna_usu" class="form-control" value="<?php echo $comuna_usu; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="control-label">Teléfono particular</label>
                                <input type="text" name="telefPart__usu" id="telefPart1_usu" class="form-control" value="<?php echo $telefPart_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="sel1">Teléfono móvil</label>
                                <input type="text" name="telefMovil_usu" id="telefMovil_usu" class="form-control" value="<?php echo $telefMovil_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">

                              </div>
                            </div>
                          </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12" id="Resultado">
                  <div class="col-sm-6">
                      <div class="panel">
                          <div class="panel-heading">
                              <h2 class="panel-title bg-primary">Contactos</h2>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label class="control-label">Nombre Contacto 1</label>
                                <input type="text" name="nombCont1_usu" id="nombCont1_usu" class="form-control" value="<?php echo $nombCont1_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="sel1">Parentesco</label>
                                <input type="text" name="parent1_usu" id="parent1_usu" class="form-control" value="<?php echo $parent1_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label class="control-label">Nº Celular 1</label>
                                <input type="text" name="cel1Cont1_usu" id="cel1Cont1_usu" class="form-control" value="<?php echo $cel1Cont1_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label class="control-label">Nº Celular 2</label>
                                <input type="text" name="cel2Cont1_usu" id="cel2Cont1_usu" class="form-control" value="<?php echo $cel2Cont1_usu; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Nombre Contacto 2</label>
                              <input type="text" name="nombCont2_usu" id="nombCont2_usu" class="form-control" value="<?php echo $nombCont2_usu; ?>">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="sel1">Parentesco</label>
                              <input type="text" name="parent2_usu" id="parent2_usu" class="form-control" value="<?php echo $parent2_usu; ?>">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Nº Celular 1</label>
                              <input type="text" name="cel1Cont2_usu" id="cel1Cont2_usu" class="form-control" value="<?php echo $cel1Cont2_usu; ?>">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Nº Celular 2</label>
                              <input type="text" name="cel2Cont2_usu" id="cel2Cont2_usu" class="form-control" value="<?php echo $cel2Cont2_usu; ?>">
                            </div>
                          </div>
                        </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="panel">
                          <div class="panel-heading">
                              <h2 class="panel-title bg-primary">Datos Previsionales</h2>
                          </div>
                          <div class="panel-body">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <div class="form-group">
                                  <label class="control-label">AFP</label>
                                  <input type="text" name="afp_usu" id="afp_usu" class="form-control" value="<?php echo $afp_usu; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="sel1">Sistema de Salud</label>
                                <input type="text" name="sisSalud_usu" id="sisSalud_usu" class="form-control" value="<?php echo $sisSalud_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label class="control-label">UF</label>
                                <input type="text" name="uf_usu" id="uf_usu" class="form-control" value="<?php echo $uf_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label class="control-label">GES</label>
                                <input type="text" name="ges_usu" id="ges_usu" class="form-control" value="<?php echo $ges_usu; ?>">
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label class="control-label">Pensionado</label>
                                <input type="text" name="pensionado_usu" id="pensionado_usu" class="form-control" value="<?php echo $pensionado_usu; ?>">
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="panel">
                          <div class="panel-body">
                            <div class="col-sm-1">
                              <div class="form-group">
                                <div class="form-group">
                                  <input type="hidden" id="valorocultoarescatar" value="<?php echo $id_usu; ?>">
                                  <input id="<?php echo $creaModificaUsua; ?>" type="submit" class="btn btn-success btn-block" value="Guardar">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <input type="button" class="btn btn-success btn-block" value="Volver" onClick="location.href = 'usuarios.php' ">
                              </div>
                            </div>
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
    <script src="../js/usuarios/usuarios.js"></script>
    <script src="../js/usuarios/gestionar_usuario.js"></script>
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
    <script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../js/global/funciones-global.js"></script>
</body>
</html>
