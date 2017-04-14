<?php
require_once('../db/db.php');
include("../class/global/global.php");
require_once('../class/session/session.php');
$objetoSession = new Session('1,2,6',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$objetoSession->crearVariableSession($array = array("idMenu" => "cal,cal_grafic"));
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
            <li><a href="#">Calidad</a></li>
            <li class="active">Resumen Comparativo</li>
          </ol>
          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <!--End breadcrumb-->
          <!--Page content-->
          <!--===================================================-->
          <div id="page-content">
            <div class="row">
                <div class="eq-height">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Filtros</h2>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 .Left">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Empresa:</label>
                                                <select class="selectpicker form-control" name="EmpresaLeft" title="Seleccione" data-live-search="true" data-width="100%">
                                                    <option value="recsa">Recsa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Grupo:</label>
                                                <select class="selectpicker form-control" name="GrupoLeft" title="Seleccione" data-live-search="true" data-width="100%">
                                                    <option value="0">Antiguos</option>
                                                    <option value="0">Nuevos</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Ejecutivo:</label>
                                                <select class="selectpicker form-control" name="EjecutivoLeft" title="Seleccione" data-live-search="true" data-width="100%">
                                                    <option value="0">Juan Martin</option>
                                                    <option value="1">Carlos Mata</option>
                                                    <option value="2">Victor Santarrosa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 .Right">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Empresa:</label>
                                                <select class="selectpicker form-control InputForComparison" disabled="disabled" name="EmpresaRight" title="Seleccione" data-live-search="true" data-width="100%">
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Grupo:</label>
                                                <select class="selectpicker form-control InputForComparison" disabled="disabled" name="GrupoRight" title="Seleccione" data-live-search="true" data-width="100%">
                                                <option value="0">Por defecto</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione Ejecutivo:</label>
                                                <select class="selectpicker form-control InputForComparison" disabled="disabled" name="EjecutivoRight" title="Seleccione" data-live-search="true" data-width="100%">
                                                    <option value="0">Rosa Jimenez</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="form-checkbox form-icon btn btn-dark active col-sm-2 col-sm-offset-5 "><input id="Comparar" type="checkbox">COMPARAR</label>
                                <button id="Mostrar" class="btn btn-info col-sm-2 col-sm-offset-5">MOSTRAR</button>
                            </div>
                        </div>
                        <div id="result">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Resumen Comparativo</h2>
                                </div>
                                <!-- Panel model -->
                                <!--===================================================-->
                                <div class="panel-body">
                                    <?php
                                        $Array["Left"] = array();
                                        $Array["Right"] = array();
                                            $Array["Left"][0]["Valor"] = 80;
                                            $Array["Left"][0]["Etiqueta"] = "%";
                                            $Array["Left"][0]["Porcentaje"] = true;
                                            $Array["Right"][0]["Valor"] = 40;
                                            $Array["Right"][0]["Etiqueta"] = "%";
                                            $Array["Right"][0]["Porcentaje"] = true;

                                            $Array["Left"][1]["Valor"] = 35;
                                            $Array["Left"][1]["Etiqueta"] = " años";
                                            $Array["Left"][1]["Porcentaje"] = false;
                                            $Array["Right"][1]["Valor"] = 25;
                                            $Array["Right"][1]["Etiqueta"] = " años";
                                            $Array["Right"][1]["Porcentaje"] = false;

                                            $Array["Left"][2]["Valor"] = 14;
                                            $Array["Left"][2]["Etiqueta"] = " Meses";
                                            $Array["Left"][2]["Porcentaje"] = false;
                                            $Array["Right"][2]["Valor"] = 8;
                                            $Array["Right"][2]["Etiqueta"] = " Meses";
                                            $Array["Right"][2]["Porcentaje"] = false;

                                            $Array["Left"][3]["Valor"] = 26;
                                            $Array["Left"][3]["Etiqueta"] = "%";
                                            $Array["Left"][3]["Porcentaje"] = true;
                                            $Array["Right"][3]["Valor"] = 74;
                                            $Array["Right"][3]["Etiqueta"] = "%";
                                            $Array["Right"][3]["Porcentaje"] = true;

                                            $Array["Left"][4]["Valor"] = 2;
                                            $Array["Left"][4]["Etiqueta"] = " Carga";
                                            $Array["Left"][4]["Porcentaje"] = false;
                                            $Array["Right"][4]["Valor"] = 4;
                                            $Array["Right"][4]["Etiqueta"] = " Carga";
                                            $Array["Right"][4]["Porcentaje"] = false;

                                            $Array["Left"][5]["Valor"] = 80;
                                            $Array["Left"][5]["Etiqueta"] = "%";
                                            $Array["Left"][5]["Porcentaje"] = true;
                                            $Array["Right"][5]["Valor"] = 75;
                                            $Array["Right"][5]["Etiqueta"] = "%";
                                            $Array["Right"][5]["Porcentaje"] = true;

                                            $Array["Left"][6]["Valor"] = 70;
                                            $Array["Left"][6]["Etiqueta"] = "%";
                                            $Array["Left"][6]["Porcentaje"] = true;
                                            $Array["Right"][6]["Valor"] = 50;
                                            $Array["Right"][6]["Etiqueta"] = "%";
                                            $Array["Right"][6]["Porcentaje"] = true;

                                            $Array["Left"][7]["Valor"] = 60;
                                            $Array["Left"][7]["Etiqueta"] = "%";
                                            $Array["Left"][7]["Porcentaje"] = true;
                                            $Array["Right"][7]["Valor"] = 50;
                                            $Array["Right"][7]["Etiqueta"] = "%";
                                            $Array["Right"][7]["Porcentaje"] = true;

                                            $Array["Left"][8]["Valor"] = 60;
                                            $Array["Left"][8]["Etiqueta"] = "%";
                                            $Array["Left"][8]["Porcentaje"] = true;
                                            $Array["Right"][8]["Valor"] = 40;
                                            $Array["Right"][8]["Etiqueta"] = "%";
                                            $Array["Right"][8]["Porcentaje"] = true;

                                            $Array["Left"][9]["Valor"] = 25;
                                            $Array["Left"][9]["Etiqueta"] = "%";
                                            $Array["Left"][9]["Porcentaje"] = true;
                                            $Array["Right"][9]["Valor"] = 50;
                                            $Array["Right"][9]["Etiqueta"] = "%";
                                            $Array["Right"][9]["Porcentaje"] = true;

                                            $Array["Left"][10]["Valor"] = 15;
                                            $Array["Left"][10]["Etiqueta"] = "%";
                                            $Array["Left"][10]["Porcentaje"] = true;
                                            $Array["Right"][10]["Valor"] = 10;
                                            $Array["Right"][10]["Etiqueta"] = "%";
                                            $Array["Right"][10]["Porcentaje"] = true;

                                            $Array["Left"][11]["Valor"] = 10;
                                            $Array["Left"][11]["Etiqueta"] = "%";
                                            $Array["Left"][11]["Porcentaje"] = true;
                                            $Array["Right"][11]["Valor"] = 40;
                                            $Array["Right"][11]["Etiqueta"] = "%";
                                            $Array["Right"][11]["Porcentaje"] = true;
                                    ?>
                                    <div class="HumanComparison">
                                        <div class="col-sm-5">
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][0]["Valor"] / ($Array['Left'][0]["Valor"] + $Array['Right'][0]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][0]["Valor"] / ($Array['Left'][0]["Valor"] + $Array['Right'][0]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][0]["Valor"].$Array['Left'][0]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][1]["Valor"] / ($Array['Left'][1]["Valor"] + $Array['Right'][1]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][1]["Valor"] / ($Array['Left'][1]["Valor"] + $Array['Right'][1]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][1]["Valor"].$Array['Left'][1]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][2]["Valor"] / ($Array['Left'][2]["Valor"] + $Array['Right'][2]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][2]["Valor"] / ($Array['Left'][2]["Valor"] + $Array['Right'][2]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][2]["Valor"].$Array['Left'][2]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][3]["Valor"] / ($Array['Left'][3]["Valor"] + $Array['Right'][3]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][3]["Valor"] / ($Array['Left'][3]["Valor"] + $Array['Right'][3]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][3]["Valor"].$Array['Left'][3]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][4]["Valor"] / ($Array['Left'][4]["Valor"] + $Array['Right'][4]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][4]["Valor"] / ($Array['Left'][4]["Valor"] + $Array['Right'][4]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][4]["Valor"].$Array['Left'][4]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][5]["Valor"] / ($Array['Left'][5]["Valor"] + $Array['Right'][5]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][5]["Valor"] / ($Array['Left'][5]["Valor"] + $Array['Right'][5]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][5]["Valor"].$Array['Left'][5]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][6]["Valor"] / ($Array['Left'][6]["Valor"] + $Array['Right'][6]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][6]["Valor"] / ($Array['Left'][6]["Valor"] + $Array['Right'][6]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][6]["Valor"].$Array['Left'][6]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][7]["Valor"] / ($Array['Left'][7]["Valor"] + $Array['Right'][7]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][7]["Valor"] / ($Array['Left'][7]["Valor"] + $Array['Right'][7]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][7]["Valor"].$Array['Left'][7]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][8]["Valor"] / ($Array['Left'][8]["Valor"] + $Array['Right'][8]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][8]["Valor"] / ($Array['Left'][8]["Valor"] + $Array['Right'][8]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][8]["Valor"].$Array['Left'][8]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][9]["Valor"] / ($Array['Left'][9]["Valor"] + $Array['Right'][9]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][9]["Valor"] / ($Array['Left'][9]["Valor"] + $Array['Right'][9]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][9]["Valor"].$Array['Left'][9]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][10]["Valor"] / ($Array['Left'][10]["Valor"] + $Array['Right'][10]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][10]["Valor"] / ($Array['Left'][10]["Valor"] + $Array['Right'][10]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][10]["Valor"].$Array['Left'][10]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][11]["Valor"] / ($Array['Left'][11]["Valor"] + $Array['Right'][11]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip ProgresRotate"><div style="width: <?php echo ($Array['Left'][11]["Valor"] / ($Array['Left'][11]["Valor"] + $Array['Right'][11]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][11]["Valor"].$Array['Left'][11]["Etiqueta"]; ?></div></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="progress-lg" style="text-align: center;">Estado Civil (Casado)</div>
                                            <div class="progress-lg" style="text-align: center;">Edad</div>
                                            <div class="progress-lg" style="text-align: center;">Antiguedad</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo Contrato (Plazo Fijo)</div>
                                            <div class="progress-lg" style="text-align: center;">Cargas</div>
                                            <div class="progress-lg" style="text-align: center;">Sexo (Femenino)</div>
                                            <div class="progress-lg" style="text-align: center;">Nacionalidad (Chilena)</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo de Ejecutivo (Senior)</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo de Contrato (Indefinido)</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación (Renuncia)</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación (Despido)</div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][0]["Valor"] / ($Array['Left'][0]["Valor"] + $Array['Right'][0]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][0]["Valor"] / ($Array['Left'][0]["Valor"] + $Array['Right'][0]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][0]["Valor"].$Array['Right'][0]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][1]["Valor"] / ($Array['Left'][1]["Valor"] + $Array['Right'][1]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][1]["Valor"] / ($Array['Left'][1]["Valor"] + $Array['Right'][1]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][1]["Valor"].$Array['Right'][1]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][2]["Valor"] / ($Array['Left'][2]["Valor"] + $Array['Right'][2]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][2]["Valor"] / ($Array['Left'][2]["Valor"] + $Array['Right'][2]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][2]["Valor"].$Array['Right'][2]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][3]["Valor"] / ($Array['Left'][3]["Valor"] + $Array['Right'][3]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][3]["Valor"] / ($Array['Left'][3]["Valor"] + $Array['Right'][3]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][3]["Valor"].$Array['Right'][3]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][4]["Valor"] / ($Array['Left'][4]["Valor"] + $Array['Right'][4]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][4]["Valor"] / ($Array['Left'][4]["Valor"] + $Array['Right'][4]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][4]["Valor"].$Array['Right'][4]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][5]["Valor"] / ($Array['Left'][5]["Valor"] + $Array['Right'][5]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][5]["Valor"] / ($Array['Left'][5]["Valor"] + $Array['Right'][5]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][5]["Valor"].$Array['Right'][5]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][6]["Valor"] / ($Array['Left'][6]["Valor"] + $Array['Right'][6]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][6]["Valor"] / ($Array['Left'][6]["Valor"] + $Array['Right'][6]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][6]["Valor"].$Array['Right'][6]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][7]["Valor"] / ($Array['Left'][7]["Valor"] + $Array['Right'][7]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][7]["Valor"] / ($Array['Left'][7]["Valor"] + $Array['Right'][7]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][7]["Valor"].$Array['Right'][7]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][8]["Valor"] / ($Array['Left'][8]["Valor"] + $Array['Right'][8]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][8]["Valor"] / ($Array['Left'][8]["Valor"] + $Array['Right'][8]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][8]["Valor"].$Array['Right'][8]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][9]["Valor"] / ($Array['Left'][9]["Valor"] + $Array['Right'][9]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][9]["Valor"] / ($Array['Left'][9]["Valor"] + $Array['Right'][9]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][9]["Valor"].$Array['Right'][9]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][10]["Valor"] / ($Array['Left'][10]["Valor"] + $Array['Right'][10]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][10]["Valor"] / ($Array['Left'][10]["Valor"] + $Array['Right'][10]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][10]["Valor"].$Array['Right'][10]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Right'][11]["Valor"] / ($Array['Left'][11]["Valor"] + $Array['Right'][11]["Valor"])) * 100,2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php echo ($Array['Right'][11]["Valor"] / ($Array['Left'][11]["Valor"] + $Array['Right'][11]["Valor"])) * 100; ?>%;" class="progress-bar progress-bar-info"><?php echo $Array['Right'][11]["Valor"].$Array['Right'][11]["Etiqueta"]; ?></div></div>
                                        </div>
                                    </div>
                                    <div class="SingleHuman">
                                        <div class="col-sm-2">
                                            <div class="progress-lg" style="text-align: center;">Estado Civil (Casado)</div>
                                            <div class="progress-lg" style="text-align: center;">Edad</div>
                                            <div class="progress-lg" style="text-align: center;">Antiguedad</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo Contrato (Plazo Fijo)</div>
                                            <div class="progress-lg" style="text-align: center;">Cargas</div>
                                            <div class="progress-lg" style="text-align: center;">Sexo (Femenino)</div>
                                            <div class="progress-lg" style="text-align: center;">Nacionalidad (Chilena)</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo de Ejecutivo (Senior)</div>
                                            <div class="progress-lg" style="text-align: center;">Tipo de Contrato (Indefinido)</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación (Renuncia)</div>
                                            <div class="progress-lg" style="text-align: center;">Rotación (Despido)</div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][0]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][0]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][0]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][0]["Valor"].$Array['Left'][0]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][1]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][1]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][1]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][1]["Valor"].$Array['Left'][1]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][2]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][2]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][2]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][2]["Valor"].$Array['Left'][2]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][3]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][3]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][3]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][3]["Valor"].$Array['Left'][3]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][4]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][4]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][4]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][4]["Valor"].$Array['Left'][4]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][5]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][5]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][5]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][5]["Valor"].$Array['Left'][5]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][6]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][6]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][6]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][6]["Valor"].$Array['Left'][6]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][7]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][7]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][7]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][7]["Valor"].$Array['Left'][7]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][8]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][8]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][8]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][8]["Valor"].$Array['Left'][8]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][9]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][9]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][9]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][9]["Valor"].$Array['Left'][9]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][10]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][10]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][10]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][10]["Valor"].$Array['Left'][10]["Etiqueta"]; ?></div></div>
                                            <div data-toggle="tooltip" data-original-title="<?php echo number_format(($Array['Left'][11]["Valor"]),2,'.',''); ?>%" class="progress progress-lg active add-tooltip"><div style="width: <?php if(!$Array['Left'][11]["Porcentaje"]){ echo '100'; }else{ echo $Array['Left'][11]["Valor"];} ?>%;" class="progress-bar progress-bar-danger"><?php echo $Array['Left'][11]["Valor"].$Array['Left'][11]["Etiqueta"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Resumen de notas</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="Charts Comparison" style="text-align: center;">
                                        <h3 style="margin: 20px 0;">Grafica General</h3>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6 Left">
                                                <div class="Chart" style="width:100%;height:400px;"></div>
                                            </div>
                                            <div class="col-sm-6 Right">
                                                <div class="Chart" style="width:100%;height:400px;"></div>
                                            </div>
                                        </div>
                                        <h3 style="margin: 20px 0; padding-top: 30px; clear: both;">Grafica por items</h3>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6 Left">
                                                <div id="BarChartResumenLeft" style="height:300px"></div>
                                                <div class="Items">
                                                    <!--<h4>Entrega Script </h4>
                                                    <div class="Chart" id="1" style="width:100%;height:250px;"></div>
                                                    <h4>Identificación</h4>
                                                    <div class="Chart" id="2" style="width:100%;height:250px;"></div>
                                                    <h4>Montos</h4>
                                                    <div class="Chart" id="3" style="width:100%;height:250px;"></div>
                                                    <h4>Argumentos</h4>
                                                    <div class="Chart" id="4" style="width:100%;height:250px;"></div>
                                                    <h4>Objeciones</h4>
                                                    <div class="Chart" id="5" style="width:100%;height:250px;"></div>
                                                    <h4>Fecha Compromiso</h4>
                                                    <div class="Chart" id="6" style="width:100%;height:250px;"></div>
                                                    <h4>Tercero</h4>
                                                    <div class="Chart" id="7" style="width:100%;height:250px;"></div>
                                                    <h4>Tono Voz</h4>
                                                    <div class="Chart" id="8" style="width:100%;height:250px;"></div>
                                                    <h4>Lenguaje Formal</h4>
                                                    <div class="Chart" id="9" style="width:100%;height:250px;"></div>
                                                    <h4>Acertividad</h4>
                                                    <div class="Chart" id="10" style="width:100%;height:250px;"></div>-->
                                                </div>
                                            </div>
                                            <div class="col-sm-6 Right">
                                                <div id="BarChartResumenRight" style="height:300px"></div>
                                                <div class="Items">
                                                    <h4>Entrega Script</h4>
                                                    <div class="Chart" id="1" style="width:100%;height:250px;"></div>
                                                    <h4>Identificación</h4>
                                                    <div class="Chart" id="2" style="width:100%;height:250px;"></div>
                                                    <h4>Montos</h4>
                                                    <div class="Chart" id="3" style="width:100%;height:250px;"></div>
                                                    <h4>Argumentos</h4>
                                                    <div class="Chart" id="4" style="width:100%;height:250px;"></div>
                                                    <h4>Objeciones</h4>
                                                    <div class="Chart" id="5" style="width:100%;height:250px;"></div>
                                                    <h4>Fecha Compromiso</h4>
                                                    <div class="Chart" id="6" style="width:100%;height:250px;"></div>
                                                    <h4>Tercero</h4>
                                                    <div class="Chart" id="7" style="width:100%;height:250px;"></div>
                                                    <h4>Tono Voz</h4>
                                                    <div class="Chart" id="8" style="width:100%;height:250px;"></div>
                                                    <h4>Lenguaje Formal</h4>
                                                    <div class="Chart" id="9" style="width:100%;height:250px;"></div>
                                                    <h4>Acertividad</h4>
                                                    <div class="Chart" id="10" style="width:100%;height:250px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--===================================================-->
                        <!--End Panel model-->
                    </div>
                    <style>
                        .ProgresRotate{
                            transform: rotate(180deg);
                        }
                            .ProgresRotate > div{
                                transform: rotate(180deg);
                            }
                        h4{
                            margin: 50px 0 10px 0;
                            border-top: 1px solid #cccccc;
                            padding-top: 25px;
                        }
                        #result{
                            display: none;
                        }
                        .HumanComparison{
                            display: none;
                        }
                        .FullWidth{
                            width: 100% !important;
                        }
                        .Right{
                            display: none;
                        }
                    </style>
                    <script>
                        $(document).ready(function(){
                            var Comparison = false;
                            $(".Left").addClass("FullWidth");
                            var General = [
                                    [
                                        [[1, 4.6], [2, 4.7], [3, 4.8], [4, 4.7], [5, 4.9], [6, 5.0]],
                                        [[1, 5.5], [2, 5.7], [3, 5.8], [4, 5.7], [5, 5.9], [6, 6.0]],
                                        [[1, 4.2], [2, 4.3], [3, 4.3], [4, 4.3], [5, 4.4], [6, 4.5]]
                                    ],
                                    [
                                        [[1, 5.2], [2, 5.3], [3, 5.4], [4, 5.4], [5, 5.5], [6, 5.6]],
                                        [[1, 5.4], [2, 5.6], [3, 5.7], [4, 5.6], [5, 5.8], [6, 5.9]],
                                        [[1, 5.3], [2, 5.4], [3, 5.5], [4, 5.5], [5, 5.6], [6, 5.7]]
                                    ]
                                ],
                                Items = [
                                    [
                                        [
                                            { y: 'Entrega Script', calidad: 5.1, ejecutivo: 6.084, empresa: 4.6 },
                                            { y: 'Identificación', calidad: 6,  ejecutivo: 7.2, empresa: 5.4 },
                                            { y: 'Montos', calidad: 5.1,  ejecutivo: 6.12, empresa: 4.6 },
                                            { y: 'Argumentos', calidad: 3.9,  ejecutivo: 4.68, empresa: 3.5 },
                                            { y: 'Objeciones', calidad: 4.1,  ejecutivo: 4.92, empresa: 3.7 },
                                            { y: 'Fecha Compromiso', calidad: 5.3,  ejecutivo: 6.36, empresa: 4.8 },
                                            { y: 'Tercero', calidad: 5.8,  ejecutivo: 6.96, empresa: 5.2 },
                                            { y: 'Tono Voz', calidad: 5.5, ejecutivo: 6.6, empresa: 5.0 },
                                            { y: 'Lenguaje Formal', calidad: 5.6, ejecutivo: 6.72, empresa: 5.0 },
                                            { y: 'Acertividad', calidad: 3.8, ejecutivo: 4.56, empresa: 3.4 },
                                        ],
                                        [
                                            [[1, 4.5], [2, 4.3], [3, 4.1], [4, 4.0], [5, 4.2], [6,  5.1]],
                                            [[1, 5.4], [2, 5.16], [3, 4.92], [4, 4.8], [5, 5.07], [6, 6.084]],
                                            [[1, 4.1], [2, 3.9], [3, 3.7], [4, 3.6], [5, 3.8], [6, 4.6]]
                                        ],
                                        [
                                            [[1, 5.50], [2, 5.80], [3, 5.50], [4, 4.75], [5, 5.30], [6, 6.00]],
                                            [[1, 6.60], [2, 6.96], [3, 6.60], [4, 5.70], [5, 6.36], [6, 7.20]],
                                            [[1, 4.95], [2, 5.22], [3, 4.95], [4, 4.28], [5, 4.77], [6, 5.40]]
                                        ],
                                        [
                                            [[1, 4.50], [2, 4.40], [3, 4.80], [4, 5.00], [5, 5.50], [6, 5.10]],
                                            [[1, 5.40], [2, 5.28], [3, 5.76], [4, 6.00], [5, 6.60], [6, 6.12]],
                                            [[1, 4.05], [2, 3.96], [3, 4.32], [4, 4.50], [5, 4.95], [6, 4.59]]
                                        ],
                                        [
                                            [[1, 4.00], [2, 3.80], [3, 4.10], [4, 3.80], [5, 3.70], [6, 3.90]],
                                            [[1, 4.80], [2, 4.56], [3, 4.92], [4, 4.5], [5, 4.44], [6, 4.68]],
                                            [[1, 3.60], [2, 3.42], [3, 3.69], [4, 3.42], [5, 3.33], [6, 3.51]]
                                        ],
                                        [
                                            [[1, 3.80], [2, 3.90], [3, 4.00], [4, 4.0], [5, 4.40], [6, 4.10]],
                                            [[1, 4.56], [2, 4.68], [3, 4.80], [4, 4.9], [5, 5.28], [6, 4.92]],
                                            [[1, 3.42], [2, 3.51], [3, 3.60], [4, 3.69], [5, 3.96], [6, 3.69]]
                                        ],
                                        [
                                            [[1, 4.50], [2, 4.60], [3, 4.90], [4, 5.0], [5, 5.50], [6, 5.30]],
                                            [[1, 5.40], [2, 5.52], [3, 5.88], [4, 6.0], [5, 6.60], [6, 6.36]],
                                            [[1, 4.05], [2, 4.14], [3, 4.41], [4, 4.50], [5, 4.95], [6, 4.77]]
                                        ],
                                        [
                                            [[1, 4.50], [2, 4.90], [3, 5.00], [4, 5.3], [5, 5.50], [6, 5.80]],
                                            [[1, 5.40], [2, 5.88], [3, 6.00], [4, 6.3], [5, 6.60], [6, 6.96]],
                                            [[1, 4.05], [2, 4.41], [3, 4.50], [4, 4.77], [5, 4.95], [6, 5.22]]
                                        ],
                                        [
                                            [[1, 5.60], [2, 5.80], [3, 5.50], [4, 5.9], [5, 5.80], [6, 5.50]],
                                            [[1, 6.72], [2, 6.96], [3, 6.60], [4, 7.0], [5, 6.96], [6, 6.60]],
                                            [[1, 5.04], [2, 5.22], [3, 4.95], [4, 5.31], [5, 5.22], [6, 4.95]]
                                        ],
                                        [
                                            [[1, 5.50], [2, 5.80], [3, 5.90], [4, 5.8], [5, 5.70], [6, 5.60]],
                                            [[1, 6.60], [2, 6.96], [3, 7.00], [4, 6.96], [5, 6.84], [6, 6.72]],
                                            [[1, 4.95], [2, 5.22], [3, 5.31], [4, 5.22], [5, 5.13], [6, 5.04]]
                                        ],
                                        [
                                            [[1, 3.80], [2, 4.10], [3, 4.30], [4, 4.20], [5, 3.50], [6, 3.80]],
                                            [[1, 4.56], [2, 4.92], [3, 5.16], [4, 5.0], [5, 4.20], [6, 4.56]],
                                            [[1, 3.42], [2, 3.69], [3, 3.87], [4, 3.78], [5, 3.15], [6, 3.42]]
                                        ]
                                    ],
                                    [
                                        [
                                            { y: 'Entrega Script', calidad: 6.1, ejecutivo: 6.4, empresa: 6.2 },
                                            { y: 'Identificación', calidad: 6.3,  ejecutivo: 6.6, empresa: 6.4 },
                                            { y: 'Montos', calidad: 5.6,  ejecutivo: 5.9, empresa: 5.7 },
                                            { y: 'Argumentos', calidad: 5.1,  ejecutivo: 5.3, empresa: 5.2 },
                                            { y: 'Objeciones', calidad: 5.3,  ejecutivo: 5.6, empresa: 5.4 },
                                            { y: 'Fecha Compromiso', calidad: 5.8,  ejecutivo: 6.1, empresa: 5.9 },
                                            { y: 'Tercero', calidad: 6.1,  ejecutivo: 6.4, empresa: 6.2 },
                                            { y: 'Tono Voz', calidad: 5.3, ejecutivo: 5.6, empresa: 5.4 },
                                            { y: 'Lenguaje Formal', calidad: 6.2, ejecutivo: 6.5, empresa: 6.3 },
                                            { y: 'Acertividad', calidad: 4.4, ejecutivo: 4.6, empresa: 4.5 },
                                        ],
                                        [
                                            [[1, 5.40], [2, 5.16], [3, 4.92], [4, 4.80], [5, 5.07], [6, 6.08]],
                                            [[1, 5.67], [2, 5.42], [3, 5.17], [4, 5.04], [5, 5.32], [6, 6.39]],
                                            [[1, 5.51], [2, 5.26], [3, 5.02], [4, 4.90], [5, 5.17], [6, 6.21]]
                                        ],
                                        [
                                            [[1, 5.78],[2, 6.09],[3, 5.78],[4, 4.99],[5, 5.57],[6, 6.30]],
                                            [[1, 6.06],[2, 6.39],[3, 6.06],[4, 5.24],[5, 5.84],[6, 6.62]],
                                            [[1, 5.89],[2, 6.21],[3, 5.89],[4, 5.09],[5, 5.68],[6, 6.43]]
                                        ],
                                        [
                                            [[1, 4.95],[2, 4.84],[3, 5.28],[4, 5.50],[5, 6.05],[6, 5.61]],
                                            [[1, 5.20],[2, 5.08],[3, 5.54],[4, 5.78],[5, 6.35],[6, 5.89]],
                                            [[1, 5.05],[2, 4.94],[3, 5.39],[4, 5.61],[5, 6.17],[6, 5.72]]
                                        ],
                                        [
                                            [[1, 5.20],[2, 4.94],[3, 5.33],[4, 4.94],[5, 4.81],[6, 5.07]],
                                            [[1, 5.46],[2, 5.19],[3, 5.60],[4, 5.19],[5, 5.05],[6, 5.32]],
                                            [[1, 5.30],[2, 5.04],[3, 5.44],[4, 5.04],[5, 4.91],[6, 5.17]]
                                        ],
                                        [
                                            [[1, 4.94],[2, 5.07],[3, 5.20],[4, 5.33],[5, 5.72],[6, 5.33]],
                                            [[1, 5.19],[2, 5.32],[3, 5.46],[4, 5.60],[5, 6.01],[6, 5.60]],
                                            [[1, 5.04],[2, 5.17],[3, 5.30],[4, 5.44],[5, 5.83],[6, 5.44]]
                                        ],
                                        [
                                            [[1, 4.95],[2, 5.06],[3, 5.39],[4, 5.50],[5, 6.05],[6, 5.83]],
                                            [[1, 5.20],[2, 5.31],[3, 5.66],[4, 5.78],[5, 6.35],[6, 6.12]],
                                            [[1, 5.05],[2, 5.16],[3, 5.50],[4, 5.61],[5, 6.17],[6, 5.95]]
                                        ],
                                        [
                                            [[1, 4.73],[2, 5.15],[3, 5.25],[4, 5.57],[5, 5.78],[6, 6.09]],
                                            [[1, 4.96],[2, 5.40],[3, 5.51],[4, 5.84],[5, 6.06],[6, 6.39]],
                                            [[1, 4.82],[2, 5.25],[3, 5.36],[4, 5.68],[5, 5.89],[6, 6.21]]
                                        ],
                                        [
                                            [[1, 5.43],[2, 5.63],[3, 5.34],[4, 5.72],[5, 5.63],[6, 5.34]],
                                            [[1, 5.70],[2, 5.91],[3, 5.60],[4, 6.01],[5, 5.91],[6, 5.60]],
                                            [[1, 5.54],[2, 5.74],[3, 5.44],[4, 5.84],[5, 5.74],[6, 5.44]]
                                        ],
                                        [
                                            [[1, 6.05],[2, 6.38],[3, 6.49],[4, 6.38],[5, 6.27],[6, 6.16]],
                                            [[1, 6.35],[2, 6.70],[3, 6.81],[4, 6.70],[5, 6.58],[6, 6.47]],
                                            [[1, 6.17],[2, 6.51],[3, 6.62],[4, 6.51],[5, 6.40],[6, 6.28]]
                                        ],
                                        [
                                            [[1, 4.37],[2, 4.72],[3, 4.95],[4, 4.83],[5, 4.03],[6, 4.37]],
                                            [[1, 4.59],[2, 4.95],[3, 5.19],[4, 5.07],[5, 4.23],[6, 4.59]],
                                            [[1, 4.46],[2, 4.81],[3, 5.04],[4, 4.93],[5, 4.11],[6, 4.46]]
                                        ]
                                    ]
                                ],
                                ItemsName = [
                                        [1, "Entrega Script"], [2, "Identificación"], [3, "Montos"], [4, "Argumentos"], [5, "Objeciones"], [6, "Fecha Compromiso"],[7, "Tercero"], [8, "Tono de Voz"], [9, "Lenguaje Formal"], [10, "Acertividad"]
                                    ],
                                Meses = [
                                        [1,"Octubre 2016"],[2,"Noviembre 2016"],[3,"Diciembre 2016"],[4,"Enero 2017"],[5,"Febrero 2017"],[6,"Marzo 2017"]
                                    ],
                                Notas = [
                                        [1],[2],[3],[4],[5],[6],[7]
                                    ];

                            /*var plotLeft = $.plot(".Charts.Comparison .Left > .Chart", [
                                    {
                                        label: 'Calidad',
                                        data: General[0][0],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Ejecutivo',
                                        data: General[0][1],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Empresa',
                                        data: General[0][2],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    }
                                ],{
                                series: {
                                    lines: {
                                        show: true
                                    },
                                    points: {
                                        show: true
                                    },
                                    shadowSize: 0	// Drawing is faster without shadows
                                },
                                colors: ['green', 'black','red' ],
                                legend: {
                                    show: true,
                                    position: 'nw',
                                    margin: [30, 0]
                                },
                                grid: {
                                    borderWidth: 0,
                                    hoverable: true,
                                    clickable: true
                                },
                                yaxis: {
                                    ticks: Notas,
                                    //ticks: 4,
                                    tickColor: '#eeeeee'
                                },
                                xaxis: {
                                    //ticks: 12,
                                    ticks: Meses,
                                    tickColor: '#ffffff'
                                }
                            });
                            var plotRight = $.plot(".Charts.Comparison .Right > .Chart", [
                                    {
                                        label: 'Calidad',
                                        data: General[1][0],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Ejecutivo',
                                        data: General[1][1],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Empresa',
                                        data: General[1][2],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    }
                                ],{
                                series: {
                                    lines: {
                                        show: true
                                    },
                                    points: {
                                        show: true
                                    },
                                    shadowSize: 0	// Drawing is faster without shadows
                                },
                                colors: ['green', 'black','red' ],
                                legend: {
                                    show: true,
                                    position: 'nw',
                                    margin: [30, 0]
                                },
                                grid: {
                                    borderWidth: 0,
                                    hoverable: true,
                                    clickable: true
                                },
                                yaxis: {
                                    ticks: Notas,
                                    //ticks: 4,
                                    tickColor: '#eeeeee'
                                },
                                xaxis: {
                                    //ticks: 12,
                                    ticks: Meses,
                                    tickColor: '#ffffff'
                                }
                            });
                            Morris.Bar({
                                element: 'BarChartResumenLeft',
                                data: Items[0][0],
                                xkey: 'y',
                                ykeys: ['calidad', 'ejecutivo', 'empresa'],
                                labels: ['Calidad', 'Ejecutivo', 'Empresa'],
                                gridEnabled: false,
                                gridLineColor: 'transparent',
                                barColors: ['green', 'black', 'red'],
                                resize:true,
                                hideHover: 'auto'
                            });
                            Morris.Bar({
                                element: 'BarChartResumenRight',
                                data: Items[1][0],
                                xkey: 'y',
                                ykeys: ['calidad', 'ejecutivo', 'empresa'],
                                labels: ['Calidad', 'Ejecutivo', 'Empresa'],
                                gridEnabled: false,
                                gridLineColor: 'transparent',
                                barColors: ['green', 'black', 'red'],
                                resize:true,
                                hideHover: 'auto'
                            });
                            $(".Charts.Comparison .Left .Items .Chart").each(function(){
                                var ObjectMe = $(this);
                                var ID = ObjectMe.attr("id");
                                $.plot(ObjectMe, [
                                    {
                                        label: 'Calidad',
                                        data: Items[0][ID][0],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Ejecutivo',
                                        data: Items[0][ID][1],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Empresa',
                                        data: Items[0][ID][2],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    }
                                    ],{
                                    series: {
                                        lines: {
                                            show: true
                                        },
                                        points: {
                                            show: true
                                        },
                                        shadowSize: 0	// Drawing is faster without shadows
                                    },
                                    colors: ['green', 'black', 'red'],
                                    legend: {
                                        show: true,
                                        position: 'nw',
                                        margin: [30, 0]
                                    },
                                    grid: {
                                        borderWidth: 0,
                                        hoverable: true,
                                        clickable: true
                                    },
                                    yaxis: {
                                        ticks: Notas,
                                        //ticks: 4,
                                        tickColor: '#eeeeee'
                                    },
                                    xaxis: {
                                        //ticks: 12,
                                        ticks: Meses,
                                        tickColor: '#ffffff'
                                    }
                                });
                            });
                            $(".Charts.Comparison .Right .Items .Chart").each(function(){
                                var ObjectMe = $(this);
                                var ID = ObjectMe.attr("id");
                                $.plot(ObjectMe, [
                                    {
                                        label: 'Calidad',
                                        data: Items[1][ID][0],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Ejecutivo',
                                        data: Items[1][ID][1],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    },
                                    {
                                        label: 'Empresa',
                                        data: Items[1][ID][2],
                                        lines: {
                                            show: true,
                                            lineWidth:2,
                                            fill: false,
                                            fillColor: {
                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                            }
                                        },
                                        points: {
                                            show: true,
                                            radius: 4
                                        }
                                    }
                                    ],{
                                    series: {
                                        lines: {
                                            show: true
                                        },
                                        points: {
                                            show: true
                                        },
                                        shadowSize: 0	// Drawing is faster without shadows
                                    },
                                    colors: ['green', 'black','red' ],
                                    legend: {
                                        show: true,
                                        position: 'nw',
                                        margin: [30, 0]
                                    },
                                    grid: {
                                        borderWidth: 0,
                                        hoverable: true,
                                        clickable: true
                                    },
                                    yaxis: {
                                        ticks: Notas,
                                        //ticks: 4,
                                        tickColor: '#eeeeee'
                                    },
                                    xaxis: {
                                        //ticks: 12,
                                        ticks: Meses,
                                        tickColor: '#ffffff'
                                    }
                                });
                            });*/
                            $("#Mostrar").click(function(){
                                var EmpresaLeft = $("select[name='EmpresaLeft']").val();
                                var EmpresaRight = $("select[name='EmpresaRight']").val();
                                if(Comparison){
                                    if((EmpresaLeft != "") && (EmpresaRight != "")){
                                        $("#result").show();
                                    }else{
                                        alert("Debe seleccionar almenos una empresa de cada comparativo");
                                    }
                                }else{
                                    if(EmpresaLeft != ""){
                                        ShowGraphs();
                                        $("#result").show();
                                    }else{
                                        alert("Debe seleccionar una empresa");
                                    }
                                }
                            });
                            $("#Comparar").change(function(){
                                if($(this).is(':checked')){
                                    $(".InputForComparison").prop("disabled", false);
                                    $(".InputForComparison").selectpicker('refresh');
                                    Comparison = true;
                                    $("#result").hide();
                                    $(".Right").show();
                                    $(".Left").removeClass("FullWidth");
                                    $(".HumanComparison").show();
                                    $(".SingleHuman").hide();
                                }else{
                                    $(".InputForComparison").prop("disabled", true);
                                    $(".InputForComparison").selectpicker('refresh');
                                    Comparison = false;
                                    $(".Right").hide();
                                    $(".Left").addClass("FullWidth");
                                    $(".HumanComparison").hide();
                                    $(".SingleHuman").show();
                                }
                            });
                            function ShowGraphs(){
                                $.ajax({
                                    type: "POST",
                                    url: "../includes/calidad/GetComparisonGraphData.php",
                                    dataType: "html",
                                    async: false,
                                    data: {},
                                    success: function(data){
                                        var json = JSON.parse(data);
                                        General[0] = json.General[0];
                                        Items[0] = json.GeneralItems[0];
                                        ItemsName = json.ItemsName;
                                        //console.log(Items[0]);
                                        var plotLeft = $.plot(".Charts.Comparison .Left > .Chart", [
                                                {
                                                    label: 'Calidad',
                                                    data: General[0][0],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Ejecutivo',
                                                    data: General[0][1],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Empresa',
                                                    data: General[0][2],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                }
                                            ],{
                                            series: {
                                                lines: {
                                                    show: true
                                                },
                                                points: {
                                                    show: true
                                                },
                                                shadowSize: 0	// Drawing is faster without shadows
                                            },
                                            colors: ['green', 'black','red' ],
                                            legend: {
                                                show: true,
                                                position: 'nw',
                                                margin: [30, 0]
                                            },
                                            grid: {
                                                borderWidth: 0,
                                                hoverable: true,
                                                clickable: true
                                            },
                                            yaxis: {
                                                ticks: Notas,
                                                //ticks: 4,
                                                tickColor: '#eeeeee'
                                            },
                                            xaxis: {
                                                //ticks: 12,
                                                ticks: Meses,
                                                tickColor: '#ffffff'
                                            }
                                        });
                                        /*var plotRight = $.plot(".Charts.Comparison .Right > .Chart", [
                                                {
                                                    label: 'Calidad',
                                                    data: General[1][0],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Ejecutivo',
                                                    data: General[1][1],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Empresa',
                                                    data: General[1][2],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                }
                                            ],{
                                            series: {
                                                lines: {
                                                    show: true
                                                },
                                                points: {
                                                    show: true
                                                },
                                                shadowSize: 0	// Drawing is faster without shadows
                                            },
                                            colors: ['green', 'black','red' ],
                                            legend: {
                                                show: true,
                                                position: 'nw',
                                                margin: [30, 0]
                                            },
                                            grid: {
                                                borderWidth: 0,
                                                hoverable: true,
                                                clickable: true
                                            },
                                            yaxis: {
                                                ticks: Notas,
                                                //ticks: 4,
                                                tickColor: '#eeeeee'
                                            },
                                            xaxis: {
                                                //ticks: 12,
                                                ticks: Meses,
                                                tickColor: '#ffffff'
                                            }
                                        });*/
                                        Morris.Bar({
                                            element: 'BarChartResumenLeft',
                                            data: Items[0]["General"],
                                            xkey: 'evaluacion',
                                            ykeys: ['calidad', 'ejecutivo', 'empresa'],
                                            labels: ['Calidad', 'Ejecutivo', 'Empresa'],
                                            gridEnabled: false,
                                            gridLineColor: 'transparent',
                                            barColors: ['green', 'black', 'red'],
                                            resize:true,
                                            hideHover: 'auto'
                                        });
                                        /*Morris.Bar({
                                            element: 'BarChartResumenRight',
                                            data: Items[1]["General"],
                                            xkey: 'y',
                                            ykeys: ['calidad', 'ejecutivo', 'empresa'],
                                            labels: ['Calidad', 'Ejecutivo', 'Empresa'],
                                            gridEnabled: false,
                                            gridLineColor: 'transparent',
                                            barColors: ['green', 'black', 'red'],
                                            resize:true,
                                            hideHover: 'auto'
                                        });*/
                                        $(".Charts.Comparison .Left .Items").html("");
                                        for (var i = 0; i < ItemsName.length; i++) {
                                            var ID = ItemsName[i][0];
                                            var Value = ItemsName[i][1];
                                            $(".Charts.Comparison .Left .Items").append("<div style='width:100%;height:250px;'><h4>"+Value+"</h4><div class='Chart' id='Left"+ID+"' style='width:100%;height:250px;'></div></div>");
                                        }
                                        setTimeout(function(){
                                            for (var i = 0; i < ItemsName.length; i++) {
                                                var ID = ItemsName[i][0];
                                                var Value = ItemsName[i][1];
                                                console.log("Inicio de "+Value);
                                                    console.log(Items[0][0][ID][0]);
                                                    console.log(Items[0][0][ID][1]);
                                                    console.log(Items[0][0][ID][2]);
                                                console.log("Fin de "+Value);
                                                $.plot($(".Charts.Comparison .Left .Items").find(".Chart#Left"+ID), [
                                                    {
                                                        label: 'Calidad',
                                                        data: Items[0][0][ID][0],
                                                        lines: {
                                                            show: true,
                                                            lineWidth:2,
                                                            fill: false,
                                                            fillColor: {
                                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                            }
                                                        },
                                                        points: {
                                                            show: true,
                                                            radius: 4
                                                        }
                                                    },
                                                    {
                                                        label: 'Ejecutivo',
                                                        data: Items[0][0][ID][1],
                                                        lines: {
                                                            show: true,
                                                            lineWidth:2,
                                                            fill: false,
                                                            fillColor: {
                                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                            }
                                                        },
                                                        points: {
                                                            show: true,
                                                            radius: 4
                                                        }
                                                    },
                                                    {
                                                        label: 'Empresa',
                                                        data: Items[0][0][ID][2],
                                                        lines: {
                                                            show: true,
                                                            lineWidth:2,
                                                            fill: false,
                                                            fillColor: {
                                                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                            }
                                                        },
                                                        points: {
                                                            show: true,
                                                            radius: 4
                                                        }
                                                    }
                                                    ],
                                                    {
                                                    series: {
                                                        lines: {
                                                            show: true
                                                        },
                                                        points: {
                                                            show: true
                                                        },
                                                        shadowSize: 0	// Drawing is faster without shadows
                                                    },
                                                    colors: ['green', 'black', 'red'],
                                                    legend: {
                                                        show: true,
                                                        position: 'nw',
                                                        margin: [30, 0]
                                                    },
                                                    grid: {
                                                        borderWidth: 0,
                                                        hoverable: true,
                                                        clickable: true
                                                    },
                                                    yaxis: {
                                                        ticks: Notas,
                                                        //ticks: 4,
                                                        tickColor: '#eeeeee'
                                                    },
                                                    xaxis: {
                                                        //ticks: 12,
                                                        ticks: Meses,
                                                        tickColor: '#ffffff'
                                                    }
                                                });
                                            }
                                        },1000);
                                        /*$(".Charts.Comparison .Right .Items .Chart").each(function(){
                                            var ObjectMe = $(this);
                                            var ID = ObjectMe.attr("id");
                                            $.plot(ObjectMe, [
                                                {
                                                    label: 'Calidad',
                                                    data: Items[1][ID][0],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Ejecutivo',
                                                    data: Items[1][ID][1],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                },
                                                {
                                                    label: 'Empresa',
                                                    data: Items[1][ID][2],
                                                    lines: {
                                                        show: true,
                                                        lineWidth:2,
                                                        fill: false,
                                                        fillColor: {
                                                            colors: [{opacity: 0.5}, {opacity: 0.5}]
                                                        }
                                                    },
                                                    points: {
                                                        show: true,
                                                        radius: 4
                                                    }
                                                }
                                                ],{
                                                series: {
                                                    lines: {
                                                        show: true
                                                    },
                                                    points: {
                                                        show: true
                                                    },
                                                    shadowSize: 0	// Drawing is faster without shadows
                                                },
                                                colors: ['green', 'black','red' ],
                                                legend: {
                                                    show: true,
                                                    position: 'nw',
                                                    margin: [30, 0]
                                                },
                                                grid: {
                                                    borderWidth: 0,
                                                    hoverable: true,
                                                    clickable: true
                                                },
                                                yaxis: {
                                                    ticks: Notas,
                                                    //ticks: 4,
                                                    tickColor: '#eeeeee'
                                                },
                                                xaxis: {
                                                    //ticks: 12,
                                                    ticks: Meses,
                                                    tickColor: '#ffffff'
                                                }
                                            });
                                        });*/
                                    },
                                    error: function(){
                                    }
                                });
                            }
                            $("<div id='flot-tooltip'></div>").css({
                                position: "absolute",
                                display: "none",
                                padding: "10px",
                                color: "#fff",
                                "text-align":"right",
                                "background-color": "#1c1e21"
                            }).appendTo("body");
                            $("body").bind("plothover", ".Charts.Comparison .Chart", function (event, pos, item) {

                                if (item) {
                                    var x = item.datapoint[0].toFixed(2),  y = item.datapoint[1];
                                    $("#flot-tooltip").html("<p class='h4'>" + item.series.label + "</p>" + y)
                                        .css({top: item.pageY+5, left: item.pageX+5})
                                        .fadeIn(200);
                                } else {
                                    $("#flot-tooltip").hide();
                                }

                            });
                        });
                    </script>
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
    <script src="../js/usuarios/usuarios.js"></script>
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
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.min.js"></script>    
</body>
</html>
